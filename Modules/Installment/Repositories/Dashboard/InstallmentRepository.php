<?php

namespace Modules\Installment\Repositories\Dashboard;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Installment\Entities\Installment;

class InstallmentRepository extends CrudRepository
{
    private $paymentRepository;
    private $transaction;

    public function __construct()
    {
        parent::__construct(Installment::class);
        $this->paymentRepository = new InstallmentPaymentRepository();
        $this->transaction = new InstallmentTransactionRepository();
        $this->setQueryActionsCols([
            '#' => 'id',
            __('installment::dashboard.installments.datatable.client') => 'client_name',
            __('installment::dashboard.installments.datatable.contract_id') => 'contract_number',
            __('installment::dashboard.installments.datatable.phone') => 'phone',
            __('installment::dashboard.installments.datatable.asked_amount') => 'amount',
            __('installment::dashboard.installments.datatable.paid_amount') => 'paid',
            __('installment::dashboard.installments.datatable.remaining_amount') => 'remaining',
            __('installment::dashboard.installments.datatable.offer') => 'offer_percentage',
            __('installment::dashboard.installments.datatable.due_date') => 'due_date',
            __('installment::dashboard.installments.datatable.transaction_date') => 'transaction_date',
            __('installment::dashboard.installments.datatable.status') => 'status_title',
        ]);
    }


    public function getToDayRemaining($contractId = null)
    {
        $now = Carbon::now()->format('Y-m-d');
        $model = $this->model->Unpaid()->whereHas('contract', function ($query) use ($contractId) {

            if($contractId) {
                $query->where('id', $contractId);
            }

        })->whereDate('due_date', $now)->get();
        return $model;
    }


    public function findValidToPayId($id)
    {
        $model = $this->model->ValidToPay()->findOrFail($id);
        return $model;
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $model = $this->findValidToPayId($id);
        $contract = $model->contract;

        try {
            $model->payments()->create([
                'amount' => $request->pay_now,
                'note' => $request->note,
                'pay_by_type' => 'by_admin',
                'pay_by_id' => auth()->user()->id,
                'transaction_date' => $request->transaction_date,
            ]);

            if ($model->remaining == $request->pay_now) {
                $model->update([
                    'note' => $request->note,
                    'transaction_date' => $request->transaction_date,
                ]);
            }

            $model->decrement('remaining', $request->pay_now);
            $model->increment('paid', $request->pay_now);
            $model->refresh();

            $notPaid = $contract->installments()->where('remaining', '>', 0)->count();

            if ($model->remaining == 0 && !$notPaid) {
                $contract->update(['completed_at' => $request->transaction_date]);
            }

            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function cancel($id)
    {
        $model = $this->findById($id);

        $contract = $model->contract;

        DB::beginTransaction();
        try {
            $model->update([
                'transaction_date' => null,
                'note' => null,
                'paid' => 0,
                'remaining' => $model->amount,
            ]);
            $model->price_before_offer = null;
            $model->offer_percentage = null;

            $model->save();
            $model->offersHistory()->delete();
            $model->payments()->delete();

            if ($contract->last_installment->id == $model->id) {
                $contract->update(['completed_at' => null]);
            }

            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function updateDueDate(Request $request, $id)
    {
        $model = $this->findById($id);

        DB::beginTransaction();
        try {

            $model->update([
                'due_date' => $request->date ? Carbon::parse($request->date)->toDateString() : $model->due_date
            ]);

            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function createPaymentUrl(Request $request, $installment_id = null)
    {
        DB::beginTransaction();
        $client_id = null;

        try {
            $transaction = $this->transaction->createTransaction(array_sum($request->remaining), null, $request->user_id ? $request->user_id : null, $installment_id);

            foreach ((array)$request->ides as $key => $id) {

                $model = $this->findValidToPayId($id);

                if ($client_id && $client_id != optional($model->contract)->client_id) {
                    return [
                        false, __('installment::dashboard.installments.titles.can_not_make_url_to_different_clients')
                    ];
                }

                if ($request->remaining[$key] > $model->remaining) {
                    return [false, __('installment::dashboard.installments.titles.error_max_value')];
                }

                $transactionObj = $transaction->instalments()->where([
                    ['installment_id', $model->id],
                    ['transaction_id', $transaction->id]
                ])->first();

                if(!$transactionObj) {
                    $transaction->instalments()->attach($model->id, [
                        'amount' => $request->remaining[$key],
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                }

                $client_id = $model->contract->client_id;
            }
            $this->transaction->removeOldClientTransactions($client_id, $transaction->id);

            DB::commit();
            return [true, $transaction];
        } catch (\Exception $e) {
            DB::rollback();
            return [false, null];
        }
    }

    public function createPaymentsUrl(Request $request)
    {
        DB::beginTransaction();
        try {
            appLogger("InstallmentRepository::createPaymentsUrl : send for this ids : ". json_encode($request->ids ?? []));
            foreach ((array)$request->ids as $key => $id) {
                $model = $this->findById($id);
                if($model) {
                    $phone = '965'.$model->contract->client->phone->phone;
                    $newRequest =  new \Illuminate\Http\Request();
                    $newRequest->merge([
                        'ides' => [$model->id],
                        'user_id' => 1,
                        'remaining' => [$model->remaining]
                    ]);

                    $transaction = $this->createPaymentUrl($newRequest, $model->id);
                    if ($transaction[0]) {
                        $url = route('frontend.instalment.checkout', $transaction[1]->token);
                        appLogger("InstallmentRepository::createPaymentsUrl : send  message for this id  ". $id, $transaction);
                        $this->sendMessage($url, $phone);
                    }
                }
            }

            DB::commit();
            return [true, $transaction];
        } catch (\Exception $e) {
            DB::rollback();
            return [false, null];
        }
    }
    public function payEmployeeInstalment(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->merge(['transaction_date' => $request->transaction_date ? Carbon::parse($request->transaction_date)->toDateString() : Carbon::now()->toDateString()]);

            foreach ((array)$request->ides as $key => $id) {
                $model = $this->findValidToPayId($id);
                $contract = $model->contract;
                $pay_now = $request->remaining[$key];

                if ($pay_now > $model->remaining) {
                    return [false, __('installment::dashboard.installments.titles.error_max_value')];
                }

                $model->payments()->create([
                    'amount' => $pay_now,
                    'note' => $request->payment_note,
                    'pay_by_type' => 'by_admin',
                    'pay_by_id' => auth()->user()->id,
                    'transaction_date' => $request->transaction_date,
                ]);

                if ($model->remaining == $pay_now) {
                    $model->update([
                        'note' => $request->note,
                        'transaction_date' => $request->transaction_date,
                    ]);
                }

                $model->decrement('remaining', $pay_now);
                $model->increment('paid', $pay_now);
                $model->refresh();

                $notPaid = $contract->installments()->where('remaining', '>', 0)->count();

                if ($model->remaining == 0 && !$notPaid) {
                    $contract->update(['completed_at' => $request->transaction_date]);
                }
            }

            DB::commit();
            return [true];
        } catch (\Exception $e) {
            DB::rollback();
            return [false, null];
        }
    }


    public function multiAddOffer(Request $request)
    {

        DB::beginTransaction();

        try {

            foreach ((array) $request->ides as $key => $id) {

                $model = $this->findValidToPayId($id);

                if($model) {

                    if($model->offersHistory) {
                        return [false, __('installment::dashboard.installments.titles.installment_has_offer_already', ['id' => $model->id])];
                    }

                    $newAmount = number_format($this->calculateOfferAmountByPercentage($model->remaining, $request->offer_percentage), 3);

                    $model->offersHistory()->create([
                        'amount' => $model->amount,
                        'remaining' => $model->remaining,
                        'paid' => $model->paid ?? 0,
                        'offer_percentage' => $request->offer_percentage,
                    ]);

                    $model->price_before_offer = $model->remaining;
                    $model->offer_percentage = $request->offer_percentage;
                    $model->remaining = $newAmount;
                    $model->save();
                }
            }

            DB::commit();
            return [true];
        } catch (\Exception $e) {
            DB::rollback();
            return [false, $e->errorInfo[2]];
        }
    }


    public function multiCancelOffer(Request $request)
    {
        DB::beginTransaction();

        try {

            foreach ((array) $request->ides as $key => $id) {

                $model = $this->findValidToPayId($id);

                if($model && $model->offersHistory) {
                    $offersHistory = $model->offersHistory;
                    $newAmount = $this->calculateOfferAmountByPercentage($offersHistory->remaining, $offersHistory->offer_percentage);
                    $difference = $offersHistory->remaining - $newAmount;

                    $expectedAmount = $offersHistory->amount - $difference;
                    $expectedRemaining = $newAmount;

                    if($expectedRemaining != $model->remaining) {
                        return [false, __('installment::dashboard.installments.titles.can\'t_rollback_offer_for_installment', ['id' => $model->id])];
                    }

                    $model->price_before_offer = null;
                    $model->offer_percentage = null;
                    $model->remaining = $offersHistory->remaining;
                    $model->paid = $offersHistory->paid;
                    $model->save();
                    $model->offersHistory()->delete();
                } else {

                    return [false, __('installment::dashboard.installments.titles.installment_not_has_offer', ['id' => $id])];
                }
            }

            DB::commit();
            return [true];
        } catch (\Exception $e) {
            DB::rollback();
            return [false, $e->errorInfo[2]];
        }
    }

    public function calculateOfferAmountByPercentage($amount, $percentage)
    {
        $percentageResult = (floatval($percentage) * floatval($amount)) / 100;
        return floatval($amount) - $percentageResult;
    }

    public function filterDataTable($query, $request)
    {
        // Search Categories by Created Dates

        if (isset($request['req']['deleted']) && $request['req']['deleted'] == 'only') {

            $query->onlyDeleted();

        } else {

            if (isset($request['req']['status']) && $request['req']['status'] == '1') {
                $query->active();
            }

            if (isset($request['req']['status']) && $request['req']['status'] == '0') {
                $query->unactive();
            }

            // call append filter
            $this->appendFilter($query, $request);
        }

        return $query;
    }

    public function appendFilter(&$query, $request): \Illuminate\Database\Eloquent\Builder
    {
        $routeName = $request->has('route_name') ? $request->route_name : $request->route()->getName();

        if (in_array($routeName, [
            'dashboard.installments.datatable',
            'dashboard.installments.judging.datatable',
            'dashboard.installments.export',
            'dashboard.installments.export.judging'
        ])) {
            $query->whereHas('contract', function ($q) use ($routeName) {
                $q->whereHas('client', function ($q) use ($routeName) {
                    $q->where('is_judging', in_array(
                        $routeName,
                        ['dashboard.installments.datatable', 'dashboard.installments.export']
                    ) ? 0 : 1);
                });
            });
        }

        if (isset($request['req']['transaction_date_from']) && $request['req']['transaction_date_from'] != 'all' && $request['req']['transaction_date_from'] != '') {

            $query->where(function ($query) use ($request) {

                $query->whereDate('transaction_date', '>=', Carbon::parse($request['req']['transaction_date_from'])->toDateString());

                $query->orWhereHas('payments', function ($query) use ($request) {

                    $query->whereDate('transaction_date', '>=', Carbon::parse($request['req']['transaction_date_from'])->toDateString());
                });
            });
        }

        if (isset($request['req']['transaction_date_to']) && $request['req']['transaction_date_to'] != '') {

            $query->where(function ($query) use ($request) {

                $query->whereDate('transaction_date', '>=', Carbon::parse($request['req']['transaction_date_to'])->toDateString());

                $query->orWhereHas('payments', function ($query) use ($request) {

                    $query->whereDate('transaction_date', '>=', Carbon::parse($request['req']['transaction_date_to'])->toDateString());
                });
            });
        }

        if (auth()->user()->can('filter_installment_with_paid_employee') && isset($request['req']['paid_by']) && $request['req']['paid_by']) {

            $query->whereHas('payments', function ($query) use ($request) {

                $query->where('pay_by_id', $request['req']['paid_by']);
            });
        }

        if (isset($request['req']['from']) && $request['req']['from'] != 'all' && $request['req']['from'] != '') {

            $query->whereDate('due_date', '>=', Carbon::parse($request['req']['from'])->toDateString());
        }

        if (isset($request['req']['to']) && $request['req']['to'] != '') {

            $query->whereDate('due_date', '<=', Carbon::parse($request['req']['to'])->toDateString());
        }

        if (isset($request['req']['contract_id']) && $request['req']['contract_id'] != "") {

            $query->where('contract_id', $request['req']['contract_id']);
        }

        if (isset($request['req']['status'])) {

            $query->where(function ($q) use ($request) {
                if (in_array('not_complete', $request['req']['status'])) {

                    $q->where(function ($q) {
                        $q->has('payments')->where('remaining', '>', 0);
                    });
                }

                if (in_array('completed', $request['req']['status'])) {

                    $q->orWhere(function ($q) {
                        $q->whereNotNull('transaction_date')->where('remaining', 0);
                    });
                }

                if (in_array('waiting', $request['req']['status'])) {

                    $q->orWhere(function ($q) {
                        $q->whereNull('transaction_date')->where('paid', 0);
                    });
                }
            });
        }

        if (isset($request['req']['client_id']) && $request['req']['client_id'] != "") {
            $query->whereHas('contract', function ($q) use ($request) {
                $q->where('client_id', $request['req']['client_id']);
            });
        }

        $query->oldest(DB::raw('due_date'));

        return $query;
    }

    public function sendMessage($url, $phone)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.ai-octopus.com/template/sent?Content-Type=application/json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                'template_id'   => 1589,
                'to'        => $phone,
                'link'      => $url,
                'token' => '9398e16db0250bb9f9e6f6e397d0c35d9aae85b69e9d21a55f',
            ]),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 9398e16db0250bb9f9e6f6e397d0c35d9aae85b69e9d21a55f',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    }
}

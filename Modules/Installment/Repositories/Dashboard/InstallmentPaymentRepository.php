<?php

namespace Modules\Installment\Repositories\Dashboard;

use Illuminate\Support\Facades\DB;
use IlluminateAgnostic\Arr\Support\Carbon;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Installment\Entities\InstallmentPayment;

class InstallmentPaymentRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(InstallmentPayment::class);
        $this->printPdfPath = "installment::dashboard.installmentpayments.prints.index";

        $this->setQueryActionsCols([
            
            '#' => 'id',
            __('installment::dashboard.installmentpayments.datatable.instalment_id') => 'installment_id',
            __('installment::dashboard.installments.datatable.paid_amount') => 'paid_amount',
            __('installment::dashboard.installments.datatable.transaction_date') => 'transaction_date',
            __('installment::dashboard.installmentpayments.datatable.payment_method') => 'pay_by_type',
            __('installment::dashboard.installments.btn.paied_by') => 'client_name',
            __('installment::dashboard.installments.datatable.note') => 'note',
        ]);
    }


    public function cancel($id)
    {
        $payment = $this->findById($id);
        $installment = $payment->installment;
        $contract = $installment->contract;

        DB::beginTransaction();
        try {
            if (!$payment)
                return false;

            $installment->update([
                'transaction_date' => null,
                'note' => null
            ]);

            $installment->increment('remaining', $payment->amount);
            $installment->decrement('paid', $payment->amount);

            $payment->delete();

            if ($contract->last_installment->id == $installment->id) {
                $contract->update(['completed_at' => null]);
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    public function QueryTable($request)
    {

        $query = DB::table("installment_payments")
            ->select(
                DB::raw(
                    "
                            installment_payments.id as id   
                            ,installment_payments.installment_id as installment_id 
                            ,installment_payments.amount as paid_amount 
                            ,installment_payments.transaction_date as transaction_date  
                            ,installment_payments.note as note  
                            ,installment_payments.pay_by_type as pay_by_type  
                            ,installment_payments.pay_by_id as pay_by_id  
                            ,users.name as admin_name 
                        "
                ),
            )
            ->leftJoin('users', function($join)
            {
                $join->on('installment_payments.pay_by_id', '=', 'users.id');
            });

            $this->filter($query, $request);

        return $query;
    }

    public function filter(&$query, $request)
    {
        
        if (isset($request['req']['from']) && $request['req']['from'] != 'all' && $request['req']['from'] != '') {

            $query->whereDate("installment_payments.transaction_date", '>=', Carbon::parse($request['req']['from'])->toDateString());
        }

        if (isset($request['req']['to']) && $request['req']['to'] != '') {

            $query->whereDate("installment_payments.transaction_date", '<=', Carbon::parse($request['req']['to'])->toDateString());
        }

        if (isset($request['req']['client_id']) && $request['req']['client_id'] != "") {
            $query->where('clients.id', $request['req']['client_id']);
        }
        
        if (isset($request['req']['paid_by']) && $request['req']['paid_by'] != "") {
            $query->where('installment_payments.pay_by_id', $request['req']['paid_by']);
        }

        $query->latest(DB::raw('transaction_date'));

        return $query;
    }

}

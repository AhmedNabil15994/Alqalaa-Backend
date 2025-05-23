<?php

namespace Modules\Installment\Repositories\Dashboard\V2;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Installment\Entities\Installment;
use PDF;

class InstallmentRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(Installment::class);
        $this->printPdfPath = "installment::dashboard.installments.prints.index";
        $this->setQueryActionsCols([
            '#' => 'id',
            __('installment::dashboard.installments.datatable.client') => 'client_name',
            __('installment::dashboard.installments.datatable.contract_id') => 'contract_number',
            __('installment::dashboard.installments.datatable.phone') => 'phone',
            __('installment::dashboard.installments.datatable.asked_amount') => 'amount',
            __('installment::dashboard.installments.datatable.paid_amount') => 'paid',
            __('installment::dashboard.installments.datatable.remaining_amount') => 'remaining',
            __('installment::dashboard.installments.datatable.offer') => 'percentage',
            __('installment::dashboard.installments.datatable.due_date') => 'due_date',
            __('installment::dashboard.installments.datatable.transaction_date') => 'transaction_date',
            __('installment::dashboard.installments.datatable.status') => 'status',
        ]);

    }


    public function QueryTable($request)
    {

        $query = DB::table("installments")
            ->select(
                DB::raw(
                    "
                            installments.id as id   
                            ,clients.name as client_name 
                            ,contracts.contract_number as contract_number 
                            ,installments.amount as amount  
                            ,installments.paid as paid  
                            ,installments.offer_percentage as offer_percentage  
                            ,installments.remaining as remaining 
                            ,installments.due_date as due_date  
                            ,installments.transaction_date as transaction_date  
                        "
                ),
                DB::raw(
                    " (CASE 

                        WHEN installments.offer_percentage IS NOT NULL 
                        THEN  CONCAT('<span class=\"badge badge-primary\">',installments.offer_percentage,'%</span>')

                        ELSE '<label class=\"label label-danger\">".__('installment::dashboard.installments.datatable.nothasoffer')."</label>'

                    END) AS percentage"
                ),
                DB::raw(
                    " (CASE 

                    WHEN (SELECT count(installment_payments.id) FROM installment_payments
                                WHERE installments.id = installment_payments.installment_id
                                GROUP BY installment_payments.installment_id
                            ) > 0 AND installments.remaining > 0 
                            THEN '<label class=\"label label-warning\">".__('installment::dashboard.installments.datatable.not_complete')."</label>' 

                    WHEN installments.transaction_date IS NOT NULL AND installments.remaining = 0 
                    THEN '<label class=\"label label-success\">".__('installment::dashboard.installments.datatable.completed')."</label>'

                    ELSE '<label class=\"label label-danger\">".__('installment::dashboard.installments.datatable.waiting')."</label>'

                    END) AS status"
                ),
                DB::raw('(select phone from client_phones where client_phones.client_id  =   clients.id order by id asc limit 1) as phone')
            )

            ->join("contracts", "contracts.id", "=", "installments.contract_id")
            ->join("clients","clients.id", "=", "contracts.client_id")
            ->when($request->input('search.value'), function ($query) use ($request) {
                $query->where('instalments.id', 'like', '%'.$request->input('search.value').'%');
                
            });

            $this->filter($query, $request);

        return $query;
    }


    public function filter(&$query, $request)
    {
        $routeName = $request->has('route_name') ? $request->route_name : $request->route()->getName();

        if (in_array($routeName, [
            'dashboard.installments.datatable',
            'dashboard.installments.judging.datatable',
            'dashboard.installments.export',
            'dashboard.installments.export.judging'
        ])) {
            $query->where('clients.is_judging',
             in_array($routeName,['dashboard.installments.datatable', 'dashboard.installments.export']) ? 0 : 1);
        }
        
        if (isset($request['req']['from']) && $request['req']['from'] != 'all' && $request['req']['from'] != '') {

            $query->whereDate("installments.due_date", '>=', Carbon::parse($request['req']['from'])->toDateString());
        }

        if (isset($request['req']['to']) && $request['req']['to'] != '') {

            $query->whereDate("installments.due_date", '<=', Carbon::parse($request['req']['to'])->toDateString());
        }

        if (isset($request['req']['contract_id']) && $request['req']['contract_id'] != "") {

            $query->where('installments.contract_id', $request['req']['contract_id']);
        }

        if (isset($request['req']['client_id']) && $request['req']['client_id'] != "") {
            $query->where('clients.id', $request['req']['client_id']);
        }

        // if (isset($request['req']['status'])) {

        //     $query->get()->map(function ($alquiler) use ($request) {
                
        //         if(in_array($alquiler->status, (array)$request['req']['status'])){
        //             return $alquiler;
        //         }
        //     });
        //     // $query->where(function ($q) use ($request) {
        //     //     if (in_array('not_complete', $request['req']['status'])) {

        //     //         $q->where(function ($q) {
        //     //             $q->has('payments')->where('remaining', '>', 0);
        //     //         });
        //     //     }

        //     //     if (in_array('completed', $request['req']['status'])) {

        //     //         $q->orWhere(function ($q) {
        //     //             $q->whereNotNull('transaction_date')->where('remaining', 0);
        //     //         });
        //     //     }

        //     //     if (in_array('waiting', $request['req']['status'])) {

        //     //         $q->orWhere(function ($q) {
        //     //             $q->whereNull('transaction_date')->where('paid', 0);
        //     //         });
        //     //     }
        //     // });
        // }
        

        $query->oldest(DB::raw('due_date'));

        return $query;
    }
}

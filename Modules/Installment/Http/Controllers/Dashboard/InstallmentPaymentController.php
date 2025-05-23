<?php

namespace Modules\Installment\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Installment\Transformers\Dashboard\InstallmentPaymentExcelExportResource;

class InstallmentPaymentController extends Controller
{
    use CrudDashboardController;

    public function cancel($id){

        try {

            $update = $this->repository->cancel($id);

            if ($update) {
                return Response()->json([true, __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([false, __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function datatable(Request $request)
    { 
        $query = $this->query($request);
        $total = $query;
        $datatable = $query;
        $datatable = DataTable::drawTable($request, $datatable);

        $total = $this->buildWithTotals($total);
        $datatable['data']->push($total);

        return Response()->json($datatable);
    }

    public function query(Request $request)
    {
        return $this->repository->QueryTable($request);
    }

    private function getData(Request $request, $type = "data_table")
    {
        $query = $this->query($request);

        $total = $query;

        if ($type == 'data_table') {

            $datatable = DataTable::drawTable($request, $query);

        } elseif ($type == 'export') {

            $datatable = DataTable::drawPrintWithoutData($request, $query);

        }
        
        $total = $this->buildWithTotals($total);
        $datatable->push($total);

        return $datatable; 
    }
    
    public function buildWithTotals($query)
    {
        $paid_amount = $query->sum('amount');
        return (object)[
            'id' => __('contract::dashboard.contracts.datatable.total'),
            'installment_id' => '',
            'paid_amount' => number_format($paid_amount,3),
            'transaction_date' => '',
            'pay_by_type' => '',
            'client_name' => '',
            'note' => ''
        ];
    }

    //exports

    public function exportTransaction($request, $type, $transaction)
    {
        $this->currentExportTransaction = $transaction;
        
        switch ($type) {
            case 'pdf':
            case 'print':
                $data = $this->getData($request, 'export');
                
                return $this->repository->createPDF($data, $type, $transaction);
            case 'excel':
                $resource = InstallmentPaymentExcelExportResource::class;
                return $this->repository->exportExcel($this->repository->QueryTable($request) , $resource , $transaction);
        }
        return 'field';
    }
}

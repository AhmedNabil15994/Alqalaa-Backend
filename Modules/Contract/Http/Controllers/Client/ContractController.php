<?php

namespace Modules\Contract\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Contract\Entities\Client\Contract;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class ContractController extends Controller
{
    use CrudDashboardController{
        __construct as __crudConstruct;
        createdResponse as CrudCreatedResponse;
        updatedResponse as CrudUpdatedResponse;
    }

    public function __construct()
    {
        $this->folder = 'client';
        $this->__crudConstruct();
        $this->setModel(Contract::class);
    }

    public function refreshTable($id){
        $model = $this->repository->findById($id);
        return response()->json(['table' => $this->view('components.instalment-table',compact('model'))->render()]);
    }

    public function printContract($id)
    {
        $model = $this->repository->findById($id);

        return $this->view('components.print-contract',compact('model'));
    }
}

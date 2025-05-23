<?php

namespace Modules\Contract\Repositories\Client;

use Modules\Contract\Entities\Client\Contract;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class ContractRepository extends CrudRepository
{

    public function __construct()
    {
        parent::__construct(Contract::class);
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $record = $this->model->active()->orderBy($order, $sort)->get();
        return $record;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $record = $this->model->orderBy($order, $sort)->get();
        return $record;
    }

    public function findById($id)
    {
        $model = $this->model->findOrFail($id);
        return $model;
    }

    public function findValidToEditById($id)
    {
        $model = $this->model->ValidToEdit()->findOrFail($id);
        return $model;
    }

    public function filterDataTable($query, $request)
    {
        if (isset($request['req']['from']) && $request['req']['from'] != '') {
            $query->whereDate('transaction_date', '>=', $request['req']['from']);
        }

        if (isset($request['req']['to']) && $request['req']['to'] != '') {
            $query->whereDate('transaction_date', '<=', $request['req']['to']);
        }

        if (isset($request['req']['status']) && $request['req']['status'] == '1') {
            $query->active();
        }

        if (isset($request['req']['status']) && $request['req']['status'] == '0') {
            $query->unactive();
        }

        if (isset($request['req']['client_id']))
            $query->where('client_id', $request['req']['client_id']);


        return $query;
    }
}

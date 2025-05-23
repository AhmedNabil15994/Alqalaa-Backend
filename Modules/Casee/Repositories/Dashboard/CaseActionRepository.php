<?php

namespace Modules\Casee\Repositories\Dashboard;

use Illuminate\Http\Request;
use Modules\Casee\Entities\CaseAction;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Indebtednes\Repositories\Dashboard\IndebtednesRepository;

class CaseActionRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(CaseAction::class);
        $this->setQueryActionsCols([
            '#' => 'id',
            __('casee::dashboard.case-actions.datatable.client') => 'client_id',
            __('casee::dashboard.case-actions.datatable.description') => 'description',
            __('casee::dashboard.case-actions.datatable.indebtednes') => 'indebtednes',
            __('casee::dashboard.case-actions.datatable.created_at') => 'created_at',
        ]);
    }

    public function prepareData(array $data, Request $request, $is_create = true): array
    {
        $data['paid'] = $request->paid == 'on' ? true : false;
        return parent::prepareData($data, $request, $is_create);
    }

    public function appendFilter(&$query, $request): \Illuminate\Database\Eloquent\Builder
    {
        if ($request->client_id) {
            $query->where('client_id', $request->client_id);
        }
        return parent::appendFilter($query, $request);
    }

    public function modelCreated($model, $request, $is_created = true): void
    {
        $client = $model->client;
        $client->is_judging = 1;
        $client->save();
        parent::modelCreated($model, $request, $is_created);
    }
}

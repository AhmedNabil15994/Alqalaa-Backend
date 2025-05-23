<?php

namespace Modules\User\Repositories\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Transaction\Services\SMS\SMS;
use Modules\User\Entities\Client;

class ClientRepository extends CrudRepository
{
    private $sms;
    public function __construct()
    {
        parent::__construct(Client::class);
        $this->fileAttribute = [
            'national_id_photo' => 'national_ids',
            'contract_photo' => 'contract',
            'other_attachments' => 'other',
        ];
        $this->statusAttribute = ['status', 'is_judging'];
        $this->sms = new SMS();

        $this->setQueryActionsCols([
            '#' => 'id',
            __('user::dashboard.clients.datatable.name') => 'name',
            __('user::dashboard.clients.datatable.email') => 'email',
            __('user::dashboard.clients.datatable.phone') => 'phone',
            __('user::dashboard.clients.datatable.national_ID') => 'national_ID',
            __('user::dashboard.clients.datatable.state') => 'state_id',
            __('user::dashboard.clients.datatable.created_at') => 'created_at',
            __('user::dashboard.clients.datatable.is_judging') => 'status_title',
            __('user::dashboard.clients.datatable.status') => 'is_judging_title',
        ]);
    }

    public function prepareData(array $data, Request $request, $is_create = true): array
    {
        if ($is_create) {

            $data['user_name'] = $request->national_ID;
            $mobile = $request->phones[array_key_first($request->phones)];
            $data['password'] = Hash::make($mobile);
        }

        return parent::prepareData($data, $request, $is_create);
    }

    public function modelCreated($model, $request, $is_created = true): void
    {
        if ($is_created) {
            if ($request->state_id) {

                $model->address()->create($request->only('state_id', 'street'));
            }

            foreach ($request->phones as $key => $phone) {
                $model->phones()->create(['phone' => $phone]);
            }
        }

        if($request->labels && count($request->labels)){
            $model->labels()->sync((array)$request->labels);
        }

        parent::modelCreated($model, $request, $is_created);
    }

    public function commitedAction($model, $request, $event_type = "create"): void
    {
        if($event_type == 'create'){
            $message = view('user::dashboard.clients.components.create-sms' , ['client' => $model])->render();
            $this->sms->send(optional($model->phones()->first())->phone,$message);
        }
        parent::commitedAction($model, $request, $event_type);
    }

    public function modelUpdated($model, $request, $is_created = true): void
    {
        if ($is_created) {
            if ($request->state_id) {

                $model->address()->update($request->only('state_id', 'street'));
            }

            $model->phones()->delete();

            foreach ($request->phones as $key => $phone) {
                $model->phones()->create(['phone' => $phone]);
            }
        }

        if($request->labels && count($request->labels)){
            $model->labels()->sync((array)$request->labels);
        }

        parent::modelCreated($model, $request, $is_created);
    }

    public function appendFilter(&$query, $request): \Illuminate\Database\Eloquent\Builder
    {
        if ($request->is_judging) {
            $query->where('is_judging', $request->is_judging);
        }
        return parent::appendFilter($query, $request);
    }

    public function appendSearch(&$query, $request): \Illuminate\Database\Eloquent\Builder
    {
        $query->orWhereHas('phones', function ($q) use ($request) {
            $q->where('phone', 'like', '%' . $request->input('search.value') . '%');
        });
        $query->orWhere('email', 'like', '%' . $request->input('search.value') . '%');
        $query->orWhere('national_ID', 'like', '%' . $request->input('search.value') . '%');
        return parent::appendSearch($query, $request);
    }

}

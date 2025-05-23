<?php

namespace Modules\User\Http\Controllers\Client;

use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\Client\ClientProfileRequest;
use Modules\User\Repositories\Client\ClientRepository;

class ClientController extends Controller
{
    private $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function profileView()
    {
        return view('user::client.profile');
    }

    public function updateProfile(ClientProfileRequest $request)
    {
        try {
            $updated = $this->repository->updateProfile($request);

            if ($updated) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([false  , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}

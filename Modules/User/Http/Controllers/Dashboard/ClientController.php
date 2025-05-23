<?php

namespace Modules\User\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\User\Http\Requests\Dashboard\ClientNotificationRequest;
use Modules\User\Transformers\Dashboard\SelectSearchClientResource;

class ClientController extends Controller
{
    use CrudDashboardController{
        __construct as CrudConstruct;
    }

    public function __construct()
    {
        $this->CrudConstruct();
        $this->select_search_resource = SelectSearchClientResource::class;
    }

    public function notificationView()
    {
        return $this->view('notification');
    }

    public function sendNotification(ClientNotificationRequest $request)
    {
        return Response()->json([true , __('apps::dashboard.messages.sent')]);
    }
}

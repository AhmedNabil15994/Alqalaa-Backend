<?php

namespace Modules\Apps\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        return redirect(route('client.contracts.index'));
    }
}

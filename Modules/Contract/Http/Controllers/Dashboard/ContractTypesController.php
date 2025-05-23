<?php

namespace Modules\Contract\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\DataTable;
use Modules\Contract\Entities\ContractLineTypes;
use Modules\Contract\Transformers\Dashboard\ContractTypesResource;
use Modules\Contract\Http\Requests\Dashboard\ContractLineTypesRequest;
use Modules\Contract\Repositories\Dashboard\ContractLineTypesRepository;

class ContractTypesController extends Controller
{
    public function __construct(public ContractLineTypesRepository $type){}
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('contract::dashboard.contract-types.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->type->QueryTable($request));

        $datatable['data'] = ContractTypesResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $data['model'] = new ContractLineTypes;
        return view('contract::dashboard.contract-types.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ContractLineTypesRequest $request)
    {
        try {
            $create = $this->type->create($request);

            if ($create) {
                return Response()->json([true , __('apps::dashboard.messages.created')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        // return view('contract::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data['model'] = $this->type->findById($id);
        return view('contract::dashboard.contract-types.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ContractLineTypesRequest $request, $id)
    {
        try {
            $update = $this->type->update($request, $id);

            if ($update) {
                return Response()->json([true , __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->type->delete($id);

            if ($delete) {
                return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $deleteSelected = $this->type->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true , __('apps::dashboard.messages.deleted')]);
            }

            return Response()->json([true , __('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}

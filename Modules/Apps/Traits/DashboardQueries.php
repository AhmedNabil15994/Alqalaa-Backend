<?php


namespace Modules\Apps\Traits;


use Illuminate\Http\Request;
use Modules\Contract\Repositories\Dashboard\ContractRepository;

trait DashboardQueries
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ContractRepository;
    }

    public function query(Request $request)
    {
        return $this->repository->QueryTable($request);
    }

    private function getContractCount($request)
    {
        return $this->query($request);
    }

    private function getCompletedContractCount($request)
    {
        return $this->query($request)->Completed()->count();
    }

    private function getUnCompletedContractCount($request)
    {
        return $this->query($request)->UnCompleted()->count();
    }

    private function getLateContractCount($request)
    {
        return $this->query($request)->Late()->count();
    }

    private function getTotalProfit($request)
    {
        return $this->query($request)->get()->sum('profit');
    }

    private function getTotalPaid($request)
    {
        return $this->query($request);
    }

    private function getTotalPrice($request)
    {
        return $this->query($request);
    }
}
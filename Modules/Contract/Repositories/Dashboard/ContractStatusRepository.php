<?php

namespace Modules\Contract\Repositories\Dashboard;

use Modules\Contract\Entities\ContractStatus;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class ContractStatusRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(ContractStatus::class);
        $this->statusAttribute = ['is_pending','is_active'];
    }
}

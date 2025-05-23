<?php

namespace Modules\Contract\Repositories\Dashboard;

use Modules\Contract\Entities\ContractLineTypes;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class ContractLineTypesRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(ContractLineTypes::class);
    }
}

<?php

namespace Modules\DeviceToken\Repositories\Dashboard;

use Modules\Core\Repositories\Dashboard\CrudRepository;

class DeviceTokenRepository extends CrudRepository
{
    public function appendFilter(&$query, $request): \Illuminate\Database\Eloquent\Builder
    {
        if (isset($request['req']['client']) && $request['req']['client'] != '') {
            $query->where('tokenable_type','Like','%Client%')->where('tokenable_id',$request['req']['client']);
        }
        return parent::appendFilter($query, $request);
    }
}

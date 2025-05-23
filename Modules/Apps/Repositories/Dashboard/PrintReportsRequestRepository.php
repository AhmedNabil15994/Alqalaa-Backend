<?php

namespace Modules\Apps\Repositories\Dashboard;

use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Core\Traits\Attachment\Attachment;

class PrintReportsRequestRepository extends CrudRepository
{


    protected function getModel()
    {
        return $this->model->where('user_id',auth()->user()->id);
    }
    
    /**
     * @param $model
     */
    protected function deleting($model)
    {
        Attachment::deleteAttachment($model->file_path);
    }
}

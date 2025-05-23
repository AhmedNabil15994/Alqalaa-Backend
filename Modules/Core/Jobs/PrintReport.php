<?php

namespace Modules\Core\Jobs;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Core\Events\FileRequestEvent;
use PDF;

class PrintReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $controller;
    public $request;
    public $type;
    public $transaction;
    public $locale;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($controllerNameSpace,$request,$type,$transaction,$locale = 'en')
    {
        $this->controller = $controllerNameSpace;
        $this->request = $request;
        $this->type = $type;
        $this->transaction = $transaction;
        $this->locale = $locale;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            app()->setLocale($this->locale);
            request()->merge($this->request);
            $file_path = (new $this->controller)->exportTransaction(request(), $this->type, $this->transaction);

            $this->transaction->status = 1;
            $this->transaction->type = $this->type;
            $this->transaction->file_path = $file_path;
            $this->transaction->save();
            $this->transaction->refresh();
            
            event(new FileRequestEvent(asset($this->transaction->file_path),(string)$this->transaction->user_id));
        }catch (\Exception $e) {
            info($e);
        }
    }
}

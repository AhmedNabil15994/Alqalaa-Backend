<?php

namespace Modules\Apps\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Modules\Apps\Entities\PrintReportsRequest;
use Modules\Core\Traits\Attachment\Attachment;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ClearDownloadsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'clear:downloads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach(PrintReportsRequest::all() as $download){
            Attachment::deleteAttachment($download->file_path);
            $download->delete();
        }
    }
}

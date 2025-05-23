<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Modules\Contract\Entities\Contract;
use Modules\Installment\Entities\Installment;
use Modules\Installment\Repositories\Dashboard\InstallmentRepository;

class SendWhatsapp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:WAMsgs {--count=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Whatsapp Message To Clients with installments payment url';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->repository = new InstallmentRepository();
        $this->model = new Contract();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sent_count = $this->option('count');
        $whereArr = [
            ['remaining','>',0] ,
        ];
        if($sent_count) {
            $whereArr[] = ['sent_count','<',3];
            $whereArr[] = ['sent_count','>=',1];
        } else {
            $whereArr[] = ['sent_count','=',0];
        }

        $data = $this->model
        ->whereHas("lateInstallments", function ($q) use ($whereArr) {
            $q->where($whereArr)->whereBetween('due_date', [date('Y-m-d', strtotime('-2 days')),date('Y-m-d')])->orderBy('id', 'desc');
        })
        ->with(['lateInstallments' => function ($q) use ($whereArr) {
            $q->where($whereArr)->whereBetween('due_date', [date('Y-m-d', strtotime('-2 days')),date('Y-m-d')])->orderBy('id', 'desc');
        }])->orderBy('id', 'asc')->get();

        appLogger("SendWhatsapp : count is  " . $data->count());

        foreach ($data as $contract) {
            $phone = '965'.$contract->client->phone->phone;
            if(isset($contract->lateInstallments[0])) {
                appLogger("SendWhatsapp : lateInstallments id is " . $contract->lateInstallments[0]->id);
                $request =  new \Illuminate\Http\Request();
                $request->merge([
                    'ides' => [$contract->lateInstallments[0]->id],
                    'user_id' => 1,
                    'remaining' => [$contract->lateInstallments[0]->remaining],
                ]);

                $transaction = $this->repository->createPaymentUrl($request, $contract->lateInstallments[0]->id);
                if ($transaction[0]) {
                    appLogger("SendWhatsapp : lateInstallments id is " . $contract->lateInstallments[0]->id . " , phone :" . $phone . " , transaction : ". json_encode($transaction));
                    $url = route('frontend.instalment.checkout', $transaction[1]->token);
                    $this->repository->sendMessage($url, $phone);
                    $contract->lateInstallments[0]->increment('sent_count', 1);
                }
            }
        }

        return 1;
    }


}

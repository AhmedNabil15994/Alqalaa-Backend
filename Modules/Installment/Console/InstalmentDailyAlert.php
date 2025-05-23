<?php
namespace Modules\Installment\Console;

use Illuminate\Console\Command;
use Modules\Installment\Repositories\Dashboard\InstallmentRepository;
use Modules\Installment\Repositories\Dashboard\InstallmentTransactionRepository;
use Modules\Transaction\Services\CbkPaymentService;
use Modules\Transaction\Services\SMS\SMS;
use Modules\Transaction\Services\UPaymentService;
use Symfony\Component\Console\Input\InputArgument;

class InstalmentDailyAlert extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'instalment:daily-alert {contract?}';
    protected $signature = 'instalment:daily-alert {contract?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'setup app by migrate tables ,seeding seeders , install passport and clear cache';

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
        $repository = new InstallmentRepository();
        $transactionRepository = new InstallmentTransactionRepository();
        $sms = new SMS();
        $records = $repository->getToDayRemaining($this->argument('contract'));

        if (count($records)) {
            foreach ($records as $installment) {
                $transaction = $transactionRepository->createTransaction($installment->remaining);
                
                $transaction->instalments()->attach($installment->id, [
                    'amount' => $installment->remaining
                ]);

                $payment_url = route('frontend.instalment.checkout', $transaction->token);

                $client = optional($installment->contract)->client;
                $transactionRepository->removeOldClientTransactions($client->id,$transaction->id);
                $message = (string)view('installment::dashboard.installments.components.daily-alert-sms', compact('client', 'payment_url'))->render();
                
                $sms->send(optional($client->phones()->first())->phone, $message);
            }
        }
    }
}

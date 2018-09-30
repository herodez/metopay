<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Transaction;

class GetResultTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'placetopay:getresulttransaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the result of all pending transactions';

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
        Transaction::where('state', '3')->chunk(100, function ($transactions){
            foreach ($transactions as $transaction) {
                $response = getTransactionResult($transaction->transaction_id);
                $transactionInformation = $response->getTransactionInformationResult();
                $transaction->state = $transactionInformation->responseCode;
                $transaction->save();            
            }
        });

        $this->info('Transactions state consulted.');
    }
}

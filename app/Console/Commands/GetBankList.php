<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Soap\Request\GetBankList as BankList;
use App\Soap\Data\Authentication;
use Cache;

use Carbon\Carbon;

class GetBankList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'placetopay:getbanklist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to get the list of all banks register in placeToPay soap service.';

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
        $this->info('Consulting bankList soap service...');
        
        $soap = resolve(SoapWrapper::class);

        try{
            $response = $soap->call('placeToPay.getBankList', array(
                new BankList(resolve(Authentication::class))
            ));
            $banks = $response->getBankListResult();
            $this->info('Cache for banks list generate.');
        }catch( \Exception $e){
            $banks = array(); 
            $this->error('Error consulting soap service.');
        }

        $expiresAt = Carbon::now()->endOfDay(); 
        Cache::put('placetopay_banklist', $banks, $expiresAt);
    }
}

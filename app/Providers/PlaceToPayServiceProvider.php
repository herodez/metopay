<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Soap\Request\GetBankList as BankList;
use App\Soap\Response\GetBankListResponse as BankResponse;
use App\Soap\Request\CreateTransaction as Transaction;
use App\Soap\Response\CreateTransactionResponse as TransactionResponse;
use App\Soap\Data\Authentication;


// To define classmap
class getBankListResponse extends BankResponse{};
class getBankList extends BankList{};
class createTransaction extends Transaction{};
class createTransactionResponse extends TransactionResponse{};

class PlaceToPayServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Create a singleton binding for SoapWraper class 
        $this->app->singleton(SoapWrapper::class, function ($app) {
            $soap = new SoapWrapper();

            $soap->add('placeToPay', function($service){
                $service
                    ->wsdl(config('placetopay.wsdl'))
                    ->trace(true)
                    ->classmap([
                        getBankList::class,
                        getBankListResponse::class,
                        createTransaction::class,
                        createTransactionResponse::class
                    ]);
            });

            return $soap; 
        });

        // Create a binding for Soap data Auth
        $this->app->bind(Authentication::class, function ($app) {
            $seed = date('c');
            
            return new Authentication(
                array(
                    'login' => config('placetopay.identificator'),
                    'tranKey' => sha1($seed. config('placetopay.trankey') ),
                    'seed' => $seed
                )
            );
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [SoapWrapper::class, Authentication::class];
    }
}

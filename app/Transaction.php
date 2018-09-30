<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id', 'session_id', 'authorization',
    ];

    /**
     * Get strate of transactions
     *
     * @param  string  $value
     * @return string
     */
    public function getStateAttribute($value)
    {
        $states = [
            0 => 'FAILED',
            1 => 'APPROVED',
            2 => 'DECLINED',
            3 => 'PENDING'
        ];

        return $states[$value];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'metopay_id';
    }
}

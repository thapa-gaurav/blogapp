<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['username','price','status','user_id','productid','form_data','status_data'];
    protected  function casts()
    {
        return [
            'form_data'=> 'array',
            'status_data'=> 'array',
        ];
    }
}

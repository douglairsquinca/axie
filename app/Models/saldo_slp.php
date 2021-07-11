<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saldo_slp extends Model
{
    protected $table = 'saldo_slps';
    protected $fillable =['user_id','time_id','qtdSlp'];
}

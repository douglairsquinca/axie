<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pagamento extends Model
{
    protected $fillable = ['user_id', 'time_id', 'player_id','qtd_slp', 'data'];
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jogadores extends Model
{
    protected $fillable = ['user_id', 'time_id', 'nome', 'ronin', 'telegram', 'meta_mensal'];
}

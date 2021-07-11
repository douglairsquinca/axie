<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class financeiro extends Model
{
    protected $fillable = ['user_id', 'time_id', 'qtd_slp', 'data'];
}

<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projetos extends Model
{
    use HasFactory;
    protected $table = 'projetos';
    protected $fillable =['nome','saldo','tipo','total_desp'];
}

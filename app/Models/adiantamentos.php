<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adiantamentos extends Model
{
    use HasFactory;

    protected $table = 'adiantamentos';
    protected $fillable =['user_id','valor','data','obs'];

}

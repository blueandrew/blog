<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class works extends Model
{
    use HasFactory;

    protected $table = 'works';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'user_id',
        'title',
        'url',
        'status',
    ];
}

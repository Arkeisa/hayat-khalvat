<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class COFE extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'detail',
        'price',
        'type',
        'image'
    ];

}

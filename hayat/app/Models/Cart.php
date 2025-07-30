<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'title',
        'details',
        'price',
        'image',
        'quantity'
    ];

    public function food()
    {
        return $this->belongsTo(Food::class, 'title', 'title');
    }

    public function coffee()
    {
        return $this->belongsTo(COFE::class, 'title', 'title');
    }
}

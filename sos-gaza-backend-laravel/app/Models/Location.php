<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    // الحقول المسموح إدخالها جماعياً
    protected $fillable = [
        'name',
        'type',
        'latitude',
        'longitude',
        'description',
    ];
}

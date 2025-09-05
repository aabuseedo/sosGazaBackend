<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartAssistant extends Model
{
    use HasFactory;

    // الحقول المسموح إدخالها جماعياً
    protected $fillable = [
        'title',
        'description',
    ];
}

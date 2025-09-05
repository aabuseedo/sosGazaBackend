<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // بدل Model
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // الحقول المسموح إدخالها جماعياً
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // إذا حاب تخفي كلمة المرور عند الإرجاع
    protected $hidden = [
        'password',
    ];
}

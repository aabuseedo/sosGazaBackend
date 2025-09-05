<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    use HasFactory;

    // الحقول المسموح إدخالها جماعياً
    protected $fillable = [
        'phone',
        'code',
        'expires_at',
    ];

    // العلاقة مع المستخدم عن طريق رقم الهاتف
    public function user()
    {
        return $this->belongsTo(User::class, 'phone', 'phone');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosRequest extends Model
{
    use HasFactory;

    // الحقول المسموح إدخالها جماعياً
    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'status',
        'sent_via',
    ];

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

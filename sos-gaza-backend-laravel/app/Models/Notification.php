<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image',
        'sender',
        'start_at',
        'end_at',
    ];

    protected $dates = ['start_at', 'end_at', 'created_at', 'updated_at'];

    // الحالة المحسوبة تلقائياً
    public function getStatusAttribute()
    {
        $now = now();

        if ($now->lt($this->start_at)) {
            return 'inactive'; // لم يبدأ بعد
        } elseif ($now->between($this->start_at, $this->end_at)) {
            return 'active';   // جاري
        } else {
            return 'expired';  // انتهى
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    // الحقول المسموح إدخالها جماعياً
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'video_url',
        'order',
    ];

    // العلاقة مع الكورس
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

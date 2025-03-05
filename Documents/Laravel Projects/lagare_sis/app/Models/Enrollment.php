<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 
        'subject_id',
        'course',
        'semester',
        'year_level'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function grade()
    {
        return $this->hasOne(Grade::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($enrollment) {
            // Delete associated grade when enrollment is deleted
            if ($enrollment->grade) {
                $enrollment->grade->delete();
            }
        });
    }
}

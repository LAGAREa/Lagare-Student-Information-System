<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 
        'student_name', 
        'subject_id', 
        'subject_name', 
        'grade', 
        'remark', 
        'curriculum_evaluation'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function isPassing()
    {
        return floatval($this->grade) >= 1.0 && floatval($this->grade) <= 2.75;
    }

    public function getStatus()
    {
        return $this->isPassing() ? 'Passed' : 'Failed';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function options()
    {
        return $this->hasMany(ExamOption::class);
    }

    public function answers()
    {
        return $this->hasMany(ExamAnswer::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}


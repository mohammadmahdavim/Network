<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\Console\Question\Question;

class ExamOption extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded=[];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

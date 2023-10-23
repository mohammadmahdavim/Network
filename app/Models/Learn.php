<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Learn extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function user()
    {
        return  $this->belongsTo(User::class,'user_id')->withDefault();
    }

    public function level()
    {
        return  $this->belongsTo(Level::class,'level_id')->withDefault();
    }
    /**
     * Get all of the post's comments.
     */
    public function files()
    {
        return $this->morphMany(File::class, 'fileable')->orderBy('type','desc');
    }
}

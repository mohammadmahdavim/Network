<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function inviter()
    {
        return $this->belongsTo(User::class, 'inviter_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function identification()
    {
        return $this->belongsTo(IdentificationCode::class)->withDefault();
    }
}

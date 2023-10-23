<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InviteDetail extends Model
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
}

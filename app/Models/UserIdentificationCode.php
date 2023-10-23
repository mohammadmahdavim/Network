<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIdentificationCode extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function identification()
    {
        return $this->belongsTo(IdentificationCode::class,'identification_code_id')->withDefault();
    }
}

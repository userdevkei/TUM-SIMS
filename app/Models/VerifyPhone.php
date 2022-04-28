<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyPhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'verificationCode'
    ];

    public function user(){

        return $this->belongsTo('App\Models\User');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'email',
        'confirm_code',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}

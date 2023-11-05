<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\GenerateUuidModelTrait;

class Role extends Model
{
    use HasFactory, GenerateUuidModelTrait;

    public static $ROLE_CODE_ADMIN = 'admin';
    public static $ROLE_CODE_PARTNER  = 'partner';

    protected $fillable = [
        'uuid',
        'code',
        'name',
        'is_default',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}

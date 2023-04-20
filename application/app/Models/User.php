<?php

namespace App\Models;

use App\Traits\GenerateUserTokenTrait;
use App\Traits\GenerateUuidModelTrait;
use App\Traits\PasswordEncryptTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Model implements HasMedia
{
    use HasFactory,
    InteractsWithMedia,
    GenerateUuidModelTrait,
    GenerateUserTokenTrait,
        PasswordEncryptTrait;

    public const MEDIA_PREFIX_AVATAR = 'user_avatar/';

    protected $fillable = [
        'uuid',
        'user_role_id',
        'first_name',
        'second_name',
        'third_name',
        'gender',
        'birthday',
        'email',
        'password',
        'token',
        'phone',
        'invite_code',
        'individual_code',
        'promo_code',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'user_role_id',
        'password',
    ];

    public static function createNew(array $data)
    {
        $user = self::create([
            'user_role_id'    => $data['user_role_uuid'] ?? UserRole::whereIsDefault(true)->first()->id,
            'first_name'      => $data['user_first_name'],
            'second_name'     => $data['user_second_name'],
            'third_name'      => $data['user_third_name'],
            'gender'          => $data['user_gender'],
            'birthday'        => Carbon::parse($data['user_birthday']),
            'email'           => $data['user_email'],
            'password'        => self::passwordEncrypt($data['user_password']),
            'token'           => self::generateUserToken(),
            'phone'           => $data['user_phone'],
            'invite_code'     => $data['user_invite_code'],
            'individual_code' => $data['user_individual_code'],
            'promo_code'      => $data['user_promo_code'],
        ]);

        $user->addMediaFromRequest('user_avatar')
            ->sanitizingFileName(function ($fileName) {
                return strtolower($fileName);
            })
            ->toMediaCollection(self::MEDIA_PREFIX_AVATAR . $user->uuid);

        return $user;
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(UserRole::class);
    }
}

<?php

namespace App\Models;

use App\Traits\GenerateUuidModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmocrmLead extends Model
{
    use HasFactory, GenerateUuidModelTrait;

    protected $fillable = [
        'uuid',
        'amo_id',
        'last_modified',
        'data',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public static function createLead(string $amo_id, int $last_modified, array $data): void
    {
        self::create([
            'amo_id'        => $amo_id,
            'last_modified' => (int) $last_modified,
            'data'          => json_encode($data),
        ]);
    }
    public static function updateLead(string $amo_id, int $last_modified, array $data): void
    {
        $lead = AmocrmLead::whereAmoId($amo_id);

        if ($lead) {
            $lead->update([
                'last_modified' => (int) $last_modified,
                'data'          => json_encode($data),
            ]);
        }
    }
    public static function getLeadByAmoId(string $amo_id):  ? AmocrmLead
    {
        $lead = AmocrmLead::whereAmoId($amo_id);
        return $lead ? $lead->first() : null;
    }
}

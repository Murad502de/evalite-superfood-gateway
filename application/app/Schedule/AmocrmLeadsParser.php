<?php

namespace App\Schedule;

use App\Models\Amocrm;
use App\Models\AmocrmLead;
use App\Models\Configuration;
use App\Models\Lead;
use App\Models\Sale;
use App\Models\User;
use App\Services\amoAPI\amoAPIHub;
use App\Traits\ServicesAmocrmTokenTrait;
use Illuminate\Support\Facades\Log;

class AmocrmLeadsParser
{
    use ServicesAmocrmTokenTrait;

    private const PARSE_COUNT = 20;

    public function __construct()
    {
        self::checkAmocrmToken();
    }

    public function __invoke()
    {
        Log::info(__METHOD__, ['AmocrmLeadsParser/start']); //DELETE

        $amocrm_leads  = self::getLeads();
        $AMO_API       = new amoAPIHub(Amocrm::getAuthData());
        $configuration = Configuration::first();

        if (!$configuration) {
            return;
        }

        Log::info(__METHOD__, ['AmocrmLeadsParser/test']); //DELETE

        $percentage        = $configuration->percentage;
        $percentage_levels = [];

        foreach ($configuration->configurationPercentageLevels as $configurationPercentageLevel) {
            $percentage_levels[] = [
                'level'      => $configurationPercentageLevel['id'],
                'percentage' => $configurationPercentageLevel['percentage'],
            ];
        }

        foreach ($amocrm_leads as $amocrm_lead) {
            Log::info(__METHOD__, ['amocrm_lead->amo_id: ' . $amocrm_lead->amo_id]); //DELETE

            $find_lead_by_id_response = $AMO_API->findLeadById($amocrm_lead->amo_id);
            $found_lead               = $find_lead_by_id_response['body'];

            // Log::info(__METHOD__, ['$find_lead_by_id_response[body]: ' . $find_lead_by_id_response['body']]); //DELETE

            if ($found_lead) {
                $found_lead_id       = (int) $find_lead_by_id_response['body']['id'];
                $found_lead_name     = $find_lead_by_id_response['body']['name'];
                $found_lead_price    = $find_lead_by_id_response['body']['price'];
                $utm_source_id       = $configuration->amocrm_utm_source_id;
                $product_price_id    = $configuration->amocrm_utm_product_price_id;
                $utm_source_value    = $AMO_API->getLeadCustomFieldValueById($found_lead, $utm_source_id);
                $product_price_value = $AMO_API->getLeadCustomFieldValueById($found_lead, $product_price_id) ?? 0;

                // Log::info(__METHOD__, ['product_price_id: ' . $product_price_id]); //DELETE
                // Log::info(__METHOD__, ['product_price_value: ' . $product_price_value]); //DELETE
                // Log::info(__METHOD__, [$product_price_value]); //DELETE

                if ($utm_source_value) {
                    $user = self::getUserByIndividualCode($utm_source_value);

                    if ($user) {
                        $user_promo_code_tmp = $user->promo_code;

                        $lead = Lead::create([
                            'amo_id'     => $found_lead_id,
                            'name'       => $found_lead_name,
                            'price'      => $product_price_value,
                            'utm_source' => $utm_source_value,
                            'user_id'    => $user->id,
                        ]);

                        Sale::create([
                            'percent'   => $percentage,
                            'lead_id'   => $lead->id,
                            'user_id'   => $user->id,
                            'is_direct' => true,
                        ]);

                        foreach ($percentage_levels as $percentage_level) {
                            $user_parent_tmp = self::getUserByInviteCode($user_promo_code_tmp);

                            if (!$user_parent_tmp || $user_parent_tmp->role->code === 'admin') {
                                break;
                            }

                            $user_promo_code_tmp = $user_parent_tmp->promo_code;

                            Sale::create([
                                'percent' => $percentage_level['percentage'],
                                'lead_id' => $lead->id,
                                'user_id' => $user_parent_tmp->id,
                                'level'   => $percentage_level['level'],
                            ]);
                        }
                    }
                }
            }

            $amocrm_lead->delete();
        }
    }

    private static function getLeads()
    {
        return AmocrmLead::orderBy('id', 'asc')
            ->take(self::PARSE_COUNT)
            ->get();
    }
    private static function getUserByIndividualCode($code): ?User
    {
        return User::whereIndividualCode($code)->first();
    }
    private static function getUserByInviteCode($code): ?User
    {
        return User::whereInviteCode($code)->first();
    }
}

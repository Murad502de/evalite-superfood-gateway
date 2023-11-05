<?php
return [
    'months'  => [
        'ru' => [
            'ordinals' => [
                1  => 'января',
                2  => 'февраля',
                3  => 'марта',
                4  => 'апреля',
                5  => 'мая',
                6  => 'июня',
                7  => 'июля',
                8  => 'августа',
                9  => 'сентября',
                10 => 'октября',
                11 => 'ноября',
                12 => 'декабря',
            ],
        ],
    ],

    'payouts' => [ //FIXME move to model Payout
        'statuses' => [
            'processing' => 'processing',
            'completed'  => 'completed',
        ],
    ],
    'sales'   => [ //FIXME move to model Sale
        'statuses' => [
            'waiting'    => 'waiting',
            'processing' => 'processing',
            'closed'     => 'closed',
        ],
    ],
    'user'    => [
        'verification_statuses' => [ //FIXME move to model User
            'waiting'    => 'waiting',
            'processing' => 'processing',
            'completed'  => 'completed',
        ],
        'roles'                 => [ //FIXME move to model Role
            'admin'    => 'admin',
            'referral' => 'referral',
        ],
    ],
];

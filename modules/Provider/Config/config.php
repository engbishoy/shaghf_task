<?php

use Illuminate\Support\Facades\Lang;

return [
    'name' => 'Provider',
    'menus' => [
        'back_menus' => [ // support many menus per module
            'provider' => [
                'title' => Lang::get('provider::menus.main_title'),
                'icon' => 'fas fa-user-shield',
                'order' => 2,
                'sub_menu' => [
                    'item_1' => [
                        'title' => Lang::get('provider::menus.sub_title_1'),
                        'route' => 'provider.index',
                    ]
                ]
            ]
        ]
    ],

];
<?php

namespace App\Http\Controllers\Helpers;

use App\Models\Contact;
use App\Models\FeaturedBrand;
use App\Models\Message;
use App\Models\MissionAndValue;
use App\Models\Portfolio;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Social;
use App\Models\Talent;
use App\Models\TalentDescription;
use App\Models\WhatWeDo;

class PermissionModule
{

    public static function modules()
    {

        $module_and_permissions = [
            [
                'name' => 'slider',
                'permissions' => Slider::PERMISSION, // it is array
            ],
            [
                'name' => 'welcome', // portfolio
                'permissions' => Portfolio::PERMISSION,
            ],
            [
                'name' => 'what_we_do',
                'permissions' => WhatWeDo::PERMISSION,
            ],
            [
                'name' => 'featured_brand',
                'permissions' => FeaturedBrand::PERMISSION,
            ],
            [
                'name' => 'mission_and_value',
                'permissions' => MissionAndValue::PERMISSION,
            ],
            [
                'name' => 'talent',
                'permissions' => Talent::PERMISSION,
            ],
            [
                'name' => 'talent_description',
                'permissions' => TalentDescription::PERMISSION,
            ],
            [
                'name' => 'message',
                'permissions' => Message::PERMISSION,
            ],
            [
                'name' => 'site_setting',
                'permissions' => Setting::PERMISSION,
            ],
            [
                'name' => 'social',
                'permissions' => Social::PERMISSION,
            ],
            [
                'name' => 'contact',
                'permissions' => Contact::PERMISSION,
            ],
        ];

        return $module_and_permissions;

    }


}

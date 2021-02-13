<?php

namespace App\Providers;

use App\Http\Controllers\Helpers\CategoryHelper;
use App\Models\Brand;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\SliderBg;
use App\Models\Social;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // social icon all data get here
        View::composer(['includes.header'], function ($view) {
            $globalSocialInfo = Social::status()->get();
            $view->with('globalSocialInfo', $globalSocialInfo);
        });

        // setting all data get here
        View::composer(
            [
                'includes.header', 'admin.auth.login', 'admin.auth.reset',
                'admin.auth.email', 'admin.auth.register', 'admin.pages.messages.reply_message',
                'pages.messages.message', 'emails.talent-message'
            ],
            function ($view) {
                $globalSettingInfo = Setting::first();
                $bg_image = SliderBg::first();
                $view->with(compact('globalSettingInfo', 'bg_image'));
            });

        // Contact Information all data get here
        View::composer(['includes.footer', 'includes.contact-modal'], function ($view) {
            $globalContactInfo = Contact::first();
            $view->with('globalContactInfo', $globalContactInfo);
        });
    }
}

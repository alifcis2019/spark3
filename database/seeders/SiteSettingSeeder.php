<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'company_name', 'value' => 'أدوات الأمان', 'type' => 'text', 'group' => 'general'],
            ['key' => 'company_description', 'value' => 'نحن شركة رائدة في توفير أحدث أدوات وأجهزة السلامة والأمان للمصانع والشركات مع خدمات التدريب والصيانة المتخصصة', 'type' => 'textarea', 'group' => 'general'],

            // Contact Information
            ['key' => 'phone', 'value' => '+20123456789', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'info@safetytools.com', 'type' => 'email', 'group' => 'contact'],
            ['key' => 'address', 'value' => 'شارع التحرير، وسط البلد، القاهرة، مصر', 'type' => 'textarea', 'group' => 'contact'],

            // Social Media
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/safetytools', 'type' => 'url', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/safetytools', 'type' => 'url', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/safetytools', 'type' => 'url', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/safetytools', 'type' => 'url', 'group' => 'social'],

            // SEO Settings
            ['key' => 'meta_title', 'value' => 'أدوات الأمان - حماية شاملة للمصانع والشركات', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'نوفر أحدث أدوات وأجهزة السلامة والأمان للمصانع والشركات مع خدمات التدريب والصيانة المتخصصة', 'type' => 'textarea', 'group' => 'seo'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}

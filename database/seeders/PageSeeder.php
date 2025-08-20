<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'سياسة الخصوصية',
                'slug' => 'privacy-policy',
                'content' => '<h2>سياسة الخصوصية</h2><p>نحن في شركة أدوات الأمان نحترم خصوصيتكم ونلتزم بحماية معلوماتكم الشخصية...</p>',
                'meta_title' => 'سياسة الخصوصية - أدوات الأمان',
                'meta_description' => 'اطلع على سياسة الخصوصية الخاصة بشركة أدوات الأمان',
                'is_active' => true,
            ],
            [
                'title' => 'شروط الاستخدام',
                'slug' => 'terms-of-use',
                'content' => '<h2>شروط الاستخدام</h2><p>مرحباً بكم في موقع شركة أدوات الأمان. باستخدامكم لهذا الموقع فإنكم توافقون على الشروط التالية...</p>',
                'meta_title' => 'شروط الاستخدام - أدوات الأمان',
                'meta_description' => 'اطلع على شروط الاستخدام الخاصة بموقع شركة أدوات الأمان',
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}

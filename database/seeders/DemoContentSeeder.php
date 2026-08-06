<?php

namespace Database\Seeders;

use App\Models\ClientLogo;
use App\Models\HeroSlide;
use App\Models\Sector;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Stat;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class DemoContentSeeder extends Seeder
{
    /**
     * محتوى تجريبي بس عشان تشوف الموقع شغال من أول تشغيل.
     * استبدل كل ده من لوحة التحكم (/admin) بمحتواك الحقيقي.
     */
    public function run(): void
    {
        SiteSetting::query()->firstOrCreate([], [
            'site_name_ar' => 'شركتك للحلول الرقمية',
            'site_name_en' => 'YourCompany Digital Solutions',
            'tagline_ar' => 'نمكّن أعمالك من خلال الابتكار الرقمي',
            'tagline_en' => 'Empowering your business through digital innovation',
            'footer_about_ar' => 'شركة متخصصة في تطوير الحلول البرمجية والتحول الرقمي للمؤسسات.',
            'footer_about_en' => 'A company specialized in software solutions and digital transformation for enterprises.',
            'phone' => '+20 100 000 0000',
            'whatsapp' => '+20 100 000 0000',
            'email' => 'info@example.com',
            'address_ar' => 'القاهرة، مصر',
            'address_en' => 'Cairo, Egypt',
        ]);

        HeroSlide::create([
            'eyebrow_ar' => 'شريك التحول الرقمي',
            'eyebrow_en' => 'YOUR DIGITAL TRANSFORMATION PARTNER',
            'title_ar' => 'نبني حلولك الرقمية بثقة',
            'title_en' => 'We build your digital solutions with confidence',
            'subtitle_ar' => 'من الفكرة إلى الإطلاق، نصمم وننفذ أنظمة برمجية تدفع أعمالك للأمام.',
            'subtitle_en' => 'From idea to launch, we design and build software that drives your business forward.',
            'button_text_ar' => 'ابدأ مشروعك',
            'button_text_en' => 'Start your project',
            'order' => 1,
        ]);

        $services = [
            ['title_ar' => 'تطوير المواقع والتطبيقات', 'title_en' => 'Web & App Development', 'icon' => 'heroicon-o-code-bracket'],
            ['title_ar' => 'حلول تخطيط موارد المؤسسات', 'title_en' => 'ERP Solutions', 'icon' => 'heroicon-o-building-office'],
            ['title_ar' => 'الاستشارات الرقمية', 'title_en' => 'Digital Consulting', 'icon' => 'heroicon-o-light-bulb'],
            ['title_ar' => 'الحوسبة السحابية', 'title_en' => 'Cloud Solutions', 'icon' => 'heroicon-o-cloud'],
            ['title_ar' => 'الأمن السيبراني', 'title_en' => 'Cybersecurity', 'icon' => 'heroicon-o-shield-check'],
            ['title_ar' => 'دعم فني متكامل', 'title_en' => 'Managed IT Support', 'icon' => 'heroicon-o-wrench-screwdriver'],
        ];
        foreach ($services as $i => $s) {
            Service::create($s + [
                'slug' => str($s['title_en'])->slug(),
                'summary_ar' => 'وصف قصير للخدمة يوضح القيمة المقدمة للعميل.',
                'summary_en' => 'A short summary describing the value delivered to the client.',
                'content_ar' => '<p>تفاصيل كاملة عن الخدمة تُكتب من لوحة التحكم.</p>',
                'content_en' => '<p>Full service details, editable from the admin panel.</p>',
                'order' => $i + 1,
            ]);
        }

        $sectors = [
            ['title_ar' => 'التجزئة', 'title_en' => 'Retail'],
            ['title_ar' => 'الصحة', 'title_en' => 'Healthcare'],
            ['title_ar' => 'التعليم', 'title_en' => 'Education'],
            ['title_ar' => 'الخدمات المالية', 'title_en' => 'Financial Services'],
            ['title_ar' => 'الحكومة', 'title_en' => 'Government'],
        ];
        foreach ($sectors as $i => $s) {
            Sector::create($s + ['order' => $i + 1]);
        }

        $stats = [
            ['number' => 120, 'suffix' => '+', 'label_ar' => 'مشروع مكتمل', 'label_en' => 'Completed projects'],
            ['number' => 60, 'suffix' => '+', 'label_ar' => 'عميل راضٍ', 'label_en' => 'Happy clients'],
            ['number' => 8, 'suffix' => '', 'label_ar' => 'سنوات خبرة', 'label_en' => 'Years of experience'],
            ['number' => 25, 'suffix' => '+', 'label_ar' => 'خبير تقني', 'label_en' => 'Technical experts'],
        ];
        foreach ($stats as $i => $s) {
            Stat::create($s + ['order' => $i + 1]);
        }

        Testimonial::create([
            'client_name' => 'أحمد محمود',
            'client_position_ar' => 'المدير التنفيذي',
            'client_position_en' => 'CEO',
            'client_company' => 'شركة مثال',
            'content_ar' => 'فريق محترف جدًا وسلّم المشروع في الوقت المحدد بجودة عالية.',
            'content_en' => 'A very professional team that delivered the project on time with high quality.',
            'order' => 1,
        ]);
    }
}

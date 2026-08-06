<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Project;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        $category = ServiceCategory::firstOrCreate(
            ['name_ar' => 'تطوير وبرمجة'],
            [
                'name_en' => 'Development & Programming',
                'slug' => 'development-programming',
                'order' => 1,
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'steel-structures'],
            [
                'service_category_id' => $category->id,

                'title_ar' => 'الهياكل الفولاذية',
                'title_en' => 'Steel Structures',

                'summary_ar' => 'تصميم وتصنيع الهياكل الفولاذية للمشاريع الصناعية والتجارية.',
                'summary_en' => 'Design and fabrication of steel structures for industrial and commercial projects.',

                'content_ar' => '
            <h2>الهياكل الفولاذية</h2>

            <p>
                نقدم خدمات متكاملة في تصميم وتصنيع وتركيب الهياكل الفولاذية
                للمصانع والمستودعات والمشاريع الصناعية الكبرى.
            </p>

            <h3>الخدمات المقدمة</h3>

            <ul>
                <li>تصميم هياكل فولاذية.</li>
                <li>تصنيع وتركيب الهناجر.</li>
                <li>المستودعات والمباني الصناعية.</li>
                <li>الصيانة والتوسعات المستقبلية.</li>
            </ul>

            <h3>المميزات</h3>

            <ul>
                <li>مواد عالية الجودة.</li>
                <li>تصميمات هندسية دقيقة.</li>
                <li>سرعة في التنفيذ.</li>
                <li>عمر افتراضي طويل.</li>
            </ul>
        ',

                'icon' => 'heroicon-o-home',
                'is_active' => true,
                'order' => 1,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'industrial-trailers'],
            [
                'service_category_id' => $category->id,

                'title_ar' => 'المقطورات الصناعية',
                'title_en' => 'Industrial Trailers',

                'summary_ar' => 'تصنيع مقطورات صناعية عالية التحمل للنقل والخدمات اللوجستية.',
                'summary_en' => 'Heavy-duty industrial trailers for transportation and logistics.',

                'content_ar' => '
            <h2>المقطورات الصناعية</h2>

            <p>
                نوفر حلولاً متقدمة لتصنيع المقطورات الصناعية المخصصة
                لنقل المعدات والمواد الثقيلة.
            </p>

            <h3>أنواع المقطورات</h3>

            <ul>
                <li>مقطورات منخفضة.</li>
                <li>مقطورات مسطحة.</li>
                <li>مقطورات نقل المعدات الثقيلة.</li>
                <li>مقطورات حسب الطلب.</li>
            </ul>

            <h3>المزايا</h3>

            <ul>
                <li>قدرة تحمل عالية.</li>
                <li>أنظمة فرامل متطورة.</li>
                <li>تشطيبات مقاومة للصدأ.</li>
                <li>مطابقة للمواصفات القياسية.</li>
            </ul>
        ',

                'icon' => 'heroicon-o-truck',
                'is_active' => true,
                'order' => 2,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'portable-camps'],
            [
                'service_category_id' => $category->id,

                'title_ar' => 'المخيمات المتنقلة',
                'title_en' => 'Portable Camps',

                'summary_ar' => 'وحدات ومخيمات متنقلة للمشاريع والمواقع الصناعية.',
                'summary_en' => 'Portable camps and modular units for industrial sites.',

                'content_ar' => '
            <h2>المخيمات المتنقلة</h2>

            <p>
                نقوم بتصميم وتصنيع وحدات متنقلة متكاملة للمشاريع
                والمواقع البعيدة.
            </p>

            <h3>تشمل الحلول</h3>

            <ul>
                <li>مكاتب متنقلة.</li>
                <li>سكن عمال ومهندسين.</li>
                <li>مطابخ ووحدات خدمية.</li>
                <li>غرف اجتماعات.</li>
            </ul>

            <h3>مميزات المنتج</h3>

            <ul>
                <li>سهولة النقل والتركيب.</li>
                <li>عزل حراري ممتاز.</li>
                <li>تصميمات حسب الطلب.</li>
                <li>تشطيبات عالية الجودة.</li>
            </ul>
        ',

                'icon' => 'heroicon-o-puzzle-piece',
                'is_active' => true,
                'order' => 3,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'ebs-systems'],
            [
                'service_category_id' => $category->id,

                'title_ar' => 'أنظمة EBS',
                'title_en' => 'EBS Systems',

                'summary_ar' => 'أنظمة كبح إلكترونية متقدمة للمقطورات والمركبات الثقيلة.',
                'summary_en' => 'Advanced Electronic Braking Systems for heavy vehicles.',

                'content_ar' => '
            <h2>أنظمة EBS</h2>

            <p>
                نوفر حلول أنظمة الفرامل الإلكترونية للمقطورات
                والشاحنات الثقيلة بما يحقق أعلى مستويات الأمان.
            </p>

            <h3>المميزات</h3>

            <ul>
                <li>تحسين فعالية الكبح.</li>
                <li>زيادة ثبات المركبة.</li>
                <li>تقليل مسافة التوقف.</li>
                <li>تحسين مستوى السلامة.</li>
            </ul>

            <h3>الخدمات</h3>

            <ul>
                <li>توريد الأنظمة.</li>
                <li>التركيب والبرمجة.</li>
                <li>الصيانة الدورية.</li>
                <li>الدعم الفني.</li>
            </ul>
        ',

                'icon' => 'heroicon-o-fire',
                'is_active' => true,
                'order' => 4,
            ]
        );

        $webCategory = PostCategory::firstOrCreate(
            ['slug' => 'web-development'],
            [
                'name_ar' => 'تطوير المواقع',
                'name_en' => 'Web Development',
            ]
        );




        Project::create([

            'slug' => 'mining-camp-complex',

            'title_ar' => 'مجمع مخيم التعدين',
            'title_en' => 'Mining Camp Complex',

            'summary_ar' => 'تنفيذ مجمع سكني متكامل للمشاريع التعدينية يضم وحدات سكنية وخدمية.',

            'summary_en' => 'A complete modular camp for mining operations and remote sites.',

            'content_ar' => '
        <h2>مجمع مخيم التعدين</h2>

        <p>
        تصميم وتصنيع وتركيب مخيم متكامل يحتوي على الوحدات السكنية
        والمكاتب والمطابخ والخدمات المساندة.
        </p>

        <ul>
            <li>سكن العمال.</li>
            <li>مكاتب الإدارة.</li>
            <li>مطابخ ومرافق خدمية.</li>
            <li>وحدات صحية.</li>
        </ul>
    ',

            'client_name' => 'شركة تعدين',

            'project_type' => 'Portable Camps',

            'technologies' => 'Modular Buildings',

            'project_year' => 2025,

            'color' => '#2563eb',

            'cover_image' => 'projects/covers/mining-camp.jpg',

            'is_featured' => true,
            'is_active' => true,
            'order' => 2,
        ]);
        Project::create([

            'slug' => 'petrochemical-facility',

            'title_ar' => 'منشأة بتروكيماوية',
            'title_en' => 'Petrochemical Facility',

            'summary_ar' => 'تنفيذ هياكل فولاذية وأعمال تصنيع وتركيب لمنشأة بتروكيماوية بمساحة تتجاوز 50,000 متر مربع.',

            'summary_en' => 'Steel structures fabrication and installation for a large-scale petrochemical facility.',

            'content_ar' => '
        <h2>نبذة عن المشروع</h2>

        <p>
        تنفيذ مشروع متكامل للهياكل الفولاذية الخاصة بمنشأة بتروكيماوية
        تشمل المباني الإنتاجية ومنصات التشغيل وخطوط الخدمة.
        </p>

        <h3>نطاق الأعمال</h3>

        <ul>
            <li>تصنيع الهياكل الفولاذية.</li>
            <li>التركيب بالموقع.</li>
            <li>أنظمة الحماية والطلاء الصناعي.</li>
            <li>منصات التشغيل والسلالم.</li>
        </ul>
    ',

            'client_name' => 'شركة صناعات بتروكيماوية',

            'project_type' => 'Industrial Facility',

            'technologies' => 'Steel Structures, Fabrication, Installation',

            'project_year' => 2025,

            'color' => '#ea580c',

            'cover_image' => 'projects/covers/petrochemical.jpg',

            'is_featured' => true,
            'is_active' => true,
            'order' => 1,
        ]);
        Project::create([

            'slug' => 'logistics-center',

            'title_ar' => 'مركز لوجستي',
            'title_en' => 'Logistics Center',

            'summary_ar' => 'تنفيذ مستودعات وهياكل معدنية لمجمع لوجستي حديث لخدمات النقل والتخزين.',

            'summary_en' => 'Modern logistics warehouses and steel structures for transportation services.',

            'content_ar' => '
        <h2>المركز اللوجستي</h2>

        <p>
        مشروع متكامل يشمل المستودعات والهياكل الفولاذية
        ومناطق التحميل والتفريغ.
        </p>

        <ul>
            <li>مستودعات صناعية.</li>
            <li>مناطق شحن وتحميل.</li>
            <li>هياكل معدنية ثقيلة.</li>
            <li>مباني إدارية.</li>
        </ul>
    ',

            'client_name' => 'شركة نقل ولوجستيات',

            'project_type' => 'Logistics Facility',

            'technologies' => 'Steel Structures',

            'project_year' => 2025,

            'color' => '#16a34a',

            'cover_image' => 'projects/covers/logistics-center.jpg',

            'is_featured' => true,
            'is_active' => true,
            'order' => 3,
        ]);

    }

}

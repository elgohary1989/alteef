<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'إعدادات الموقع';
    protected static ?string $title = 'إعدادات الموقع العامة';
    protected static string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(SiteSetting::instance()->toArray());
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Section::make('عربي')->schema([
                    Forms\Components\TextInput::make('site_name_ar')->label('اسم الموقع'),
                    Forms\Components\Textarea::make('tagline_ar')->label('الشعار / الجملة التعريفية'),
                    Forms\Components\Textarea::make('footer_about_ar')->label('نبذة الفوتر'),
                    Forms\Components\TextInput::make('address_ar')->label('العنوان'),
                ]),
                Forms\Components\Section::make('English')->schema([
                    Forms\Components\TextInput::make('site_name_en')->label('Site name'),
                    Forms\Components\Textarea::make('tagline_en')->label('Tagline'),
                    Forms\Components\Textarea::make('footer_about_en')->label('Footer about text'),
                    Forms\Components\TextInput::make('address_en')->label('Address'),
                ]),
            ]),
            Forms\Components\Section::make('الشعار وبيانات التواصل')->schema([
                Forms\Components\FileUpload::make('logo')->label('الشعار')->image()->directory('settings'),
                Forms\Components\FileUpload::make('favicon')->label('أيقونة المتصفح')->image()->directory('settings'),
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\TextInput::make('phone')->label('الهاتف'),
                    Forms\Components\TextInput::make('whatsapp')->label('واتساب'),
                    Forms\Components\TextInput::make('email')->label('البريد الإلكتروني')->email(),
                ]),
            ]),
            Forms\Components\Section::make('روابط التواصل الاجتماعي')->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('facebook_url')->label('فيسبوك')->url(),
                    Forms\Components\TextInput::make('linkedin_url')->label('لينكدإن')->url(),
                    Forms\Components\TextInput::make('twitter_url')->label('إكس / تويتر')->url(),
                    Forms\Components\TextInput::make('instagram_url')->label('إنستجرام')->url(),
                    Forms\Components\TextInput::make('youtube_url')->label('يوتيوب')->url(),
                ]),
            ]),
        ])->statePath('data');
    }

    public function save(): void
    {
        SiteSetting::instance()->update($this->form->getState());

        Notification::make()->title('تم حفظ الإعدادات بنجاح')->success()->send();
    }
}

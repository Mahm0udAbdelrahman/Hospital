<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $setting=   Setting::create([
            'language'=> 'English',
            'logo'=> 'logo.png',
            'favicon'=> 'favicon.png',
            'phone' => '+012681412' ,
            'email'=>'setting@gmail.com',
            'location'=>'location',
            'whatsapp' => '+02565432454',
            'facebook' => 'facebook',
            'twitter' => 'twitter',
            'instagram' =>'Instagram',
            'linkedin'=>'linkedin',
            'youtube'=>'youtube',
            'video'=>'video',
            'number_of_consultants' => '1000',
            'number_of_medical_team' => '2000',
            'number_of_beds' => '3000',
            'number_of_patients' => '4000',
            'sustainability_report' => 'sustainability_report',
            'whistleblowing_policy' => 'whistleblowing_policy',
            'internal_rules_of_conduct' => 'internal_rules_of_conduct',
            'supplier_code_of_conduct' => 'supplier_code_of_conduct',
            
        ]);

        DB::table('setting_translations')->insert([
            [
                'setting_id' => $setting->id,
                'locale' => 'en',
                'name' => 'My First setting',
                'address' => 'faysel',
                'description' => 'This is the content of my first setting.',
                'words_guide' => 'website settings',
                'about' => 'about',
                'privacy' => 'privacy',
                'terms' => 'terms',
                'why_hospital' => 'Gool hospital',
                'path_to_success' => 'Success Hospital',
                'sustainability' =>  'sustainability',
                'hospital_policies' =>  'Hospital Policies',
                'management_team' => 'Management Team ',
            ],

            [
                'setting_id' => $setting->id,
                'locale' => 'ar',
                'name' => 'منشوري الأول',
                'address' => 'فيصل',
                'description' => 'هذا هو محتوى منشوري الأول.',
                'words_guide' => 'إعدادات الموقع.',
                'about' => 'عن',
                'privacy' => 'الخصوصية',
                'terms' => 'شروط',
                'why_hospital' => 'هدف المستشفي',
                'path_to_success' => 'نحاح مستشفي',
                'sustainability' =>  'الاستدامة',
                'hospital_policies' => 'سياسات المستشفى',
                'management_team' => 'فريق الإدارة',
            ],
        ]);
    }
}
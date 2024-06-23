<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::create([
            'site_name' => "Laravel's Blog",
            'address' => 'Playa del Carmen, Quintana Roo, México',
            'contact_number' => '984 123 4567',
            'contact_email' => 'info@laravel_blog.com'
        ]);
    }
}

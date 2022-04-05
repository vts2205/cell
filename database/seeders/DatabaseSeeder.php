<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use Carbon\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $profileInsert=Profile::insert([
         'name' => "Admin",
         'phone' => '9876543210',
         'created_at' =>Carbon::now(),
         'updated_at' =>Carbon::now(),
        ]);
        if($profileInsert){

        $lastRow =Profile::latest()->first();
        User::insert([
            'name' => 'Admin',
            'profile_id'=>$lastRow->id,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' =>'1',
            'status'=>'1',
            'created_at' =>Carbon::now(),
            'updated_at' =>Carbon::now(),
        ]);
        }
    }
}

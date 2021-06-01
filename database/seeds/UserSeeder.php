<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'id'            => 1,
                'email'         => 'admin@gmail.com',
                'name'          => 'admin',
                'role_id'       => 1,
                'password'      =>  bcrypt('12345'),
                'email_verified_at' => Carbon::now(),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'id'            => 2,
                'email'      => 'contoh@gmail.com',
                'name'          => 'Contoh',
                'role_id'       => 2,
                'password'      =>  bcrypt('12345'),
                'email_verified_at' => Carbon::now(),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ]);
    }
}

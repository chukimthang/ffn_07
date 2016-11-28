<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            [
                'name' => 'MU',
                'introduction' => 'La doi bong noi tieng',
                'logo' => '',
                'country_id' => 1,
                'created_at' => Carbon::createFromFormat('Y-m-d', '1989-05-21')
            ],
            [
                'name' => 'Hai Duong',
                'introduction' => 'La doi bong noi tieng',
                'logo' => '',
                'country_id' => 2,
                'created_at' => Carbon::createFromFormat('Y-m-d', '1989-05-21')
            ],
            [
                'name' => 'Hai Phong',
                'introduction' => 'La doi bong noi tieng',
                'logo' => '',
                'country_id' => 2,
                'created_at' => Carbon::createFromFormat('Y-m-d', '1989-05-21')
            ]
        ]);
    }
}

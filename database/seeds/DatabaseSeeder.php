<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(LeaguesTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(PlayersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(NewsTableSeeder::class);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InstallSeeder::class);
        $this->call(NavigationsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(ConfigsTableSeeder::class);
    }
}

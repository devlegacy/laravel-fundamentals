<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MuseumsTableSeeder::class);
        factory(App\User::class, 20)->create();
        factory(App\Entities\Message::class, 100)->create();

        factory(App\Entities\Product::class, 50)->create();
        factory(App\Entities\Review::class, 300)->create();
    }
}

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
        // $this->call(UsersTableSeeder::class);
        
        factory(App\User::class)->create([
            'name' => 'Shuhei Kagaya',
            'email' => 'test@example.com',
        ]);
        
        factory(App\User::class, 9)->create();
    }
}

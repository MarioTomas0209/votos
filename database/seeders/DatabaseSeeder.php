<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::makeDirectory('items');

        // $this->call(ItemSeeder::class);

        // $this->call(ComparisonSeeder::class);

        // User::factory(1)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'tmario291@gmail.com',
        //     'password' => bcrypt('12344321'),
        //      'is_admin' => 1,
        // ]);
    }
}

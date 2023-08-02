<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Donation;
use App\Models\Follower;
use App\Models\MerchSale;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Denys',
            'email' => 'denysaw@gmail.com',
        ]);

        Follower::factory(500)->create(['user_id' => $user->id]);
        Subscriber::factory(500)->create(['user_id' => $user->id]);
        Donation::factory(500)->create(['user_id' => $user->id]);
        MerchSale::factory(500)->create(['user_id' => $user->id]);
    }
}

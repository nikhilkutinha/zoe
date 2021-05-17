<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Link;
use App\Models\Visitor;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)
            ->create();

        Link::factory(100)
            ->has(Visitor::factory()->count(100))
            ->create();
    }
}

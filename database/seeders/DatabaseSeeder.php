<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Department::create([
            'name' => 'Finance',
        ]);

        \App\Models\Department::create([
            'name' => 'Sales',
        ]);

        \App\Models\Department::create([
            'name' => 'QC',
        ]);

        \App\Models\Department::create([
            'name' => 'Purchasing',
        ]);

        \App\Models\Department::create([
            'name' => 'Produksi',
        ]);

        \App\Models\Department::create([
            'name' => 'QA',
        ]);

        \App\Models\Department::create([
            'name' => 'Product Development',
        ]);

        \App\Models\Department::create([
            'name' => 'HRD',
        ]);

        \App\Models\Department::create([
            'name' => 'PPIC & Warehouse',
        ]);

        \App\Models\Issue::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('coba1234'),
            'is_admin' => true,
            'is_verified' => true,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('coba1234'),
            'department_id' => 1,
            'is_verified' => true,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'user2',
            'email' => 'user2@user.com',
            'password' => bcrypt('coba1234'),
            'department_id' => 1,
            'is_verified' => true,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'user3',
            'email' => 'user3@user.com',
            'password' => bcrypt('coba1234'),
            'department_id' => 2,
            'is_verified' => true,
        ]);
    }
}

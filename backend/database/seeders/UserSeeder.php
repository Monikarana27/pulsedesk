<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = Tenant::where('domain', 'acme.com')->first();

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@acme.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'tenant_id' => $tenant->id,
        ]);

        User::create([
            'name' => 'Agent One',
            'email' => 'agent1@acme.com',
            'password' => Hash::make('password123'),
            'role' => 'agent',
            'tenant_id' => $tenant->id,
        ]);

        User::create([
            'name' => 'Agent Two',
            'email' => 'agent2@acme.com',
            'password' => Hash::make('password123'),
            'role' => 'agent',
            'tenant_id' => $tenant->id,
        ]);

        User::create([
            'name' => 'Customer One',
            'email' => 'customer1@acme.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'tenant_id' => $tenant->id,
        ]);

        User::create([
            'name' => 'Customer Two',
            'email' => 'customer2@acme.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'tenant_id' => $tenant->id,
        ]);
    }
}
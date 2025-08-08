<?php

namespace Database\Seeders;

use App\Models\StatusModel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UsersModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // UsersModel::factory()->create([
        //     'username' => 'superadmin',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('flyingfish321'),
        //     'role' => '1',
        // ]);

        DB::table('users')->insert([
            [
                'username' => 'superadmin',
                'email' => 'flyingfishsuperadmin@gmail.com',
                'password' => bcrypt('flyingfish321'),
                'role' => '1',
            ]
        ]);

        DB::table('status')->insert([
            [
                'status_type' => 'Open'
            ],
            [
                'status_type' => 'On Progress'
            ],
            [
                'status_type' => 'Pending'
            ],
            [
                'status_type' => 'RMA to Vendor'
            ],
            [
                'status_type' => 'On-QC'
            ],
            [
                'status_type' => 'Completed'
            ],
            [
                'status_type' => 'Canceled'
            ],
            [
                'status_type' => 'Returned to Client'
            ]
        ]);

        DB::table('service_type')->insert([
            [
                'service_type_name' => 'On-Site'
            ],
            [
                'service_type_name' => 'Carry-In'
            ],
        ]);

        DB::table('warranty')->insert([
            [
                'warranty_status' => 'Active'
            ],
            [
                'warranty_status' => 'Expired'
            ],
            [
                'warranty_status' => 'Void'
            ],
        ]);
        
    }
}

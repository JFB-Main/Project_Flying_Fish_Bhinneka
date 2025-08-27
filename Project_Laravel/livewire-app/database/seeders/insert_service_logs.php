<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service_logsModel;
use App\Models\Service_typeModel;
use App\Models\WarrantyModel;
use App\Models\UsersModel;
use App\Models\StatusModel;
use Faker\Factory as Faker;
// use Carbon\Carbon;

class insert_service_logs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get valid IDs for foreign keys
        $serviceTypes = Service_typeModel::pluck('id')->toArray();
        $warrantyStatuses = WarrantyModel::pluck('id')->toArray();
        $users = UsersModel::pluck('id')->toArray();
        $statuses = StatusModel::pluck('id')->toArray();

        // Generate 1000 records
        for ($i = 0; $i < 1000; $i++) {
            Service_logsModel::create([
                'date_in'            => $faker->date(),
                'received_from'      => $faker->name(),
                'alamat'             => $faker->address(),
                'mobile_number'      => $faker->phoneNumber(),
                'email'              => $faker->safeEmail(),
                'contact_person'     => $faker->name(),

                // 15+ random alphanumeric characters
                'serial_number'      => strtoupper($faker->bothify(str_repeat('#', 15))),
                'part_number'        => strtoupper($faker->bothify(str_repeat('#', 15))),
                'SKU'                => strtoupper($faker->bothify(str_repeat('#', 15))),
                'brand_type'         => $faker->randomElement(['Sony', 'Samsung', 'LG', 'Panasonic', 'HP', 'Dell']),

                // Sentences with >= 22 words
                'description_product'=> $faker->sentence(22),
                'problem'            => $faker->sentence(22),
                'pre_diagnostic'     => $faker->sentence(22),
                'add_on'             => $faker->sentence(22),

                // Sales Order with >= 15 #
                'sales_order'        => strtoupper($faker->bothify('SO' . str_repeat('#', 15))),
                'invoice_date'       => $faker->optional()->date(),
                'warranty_status'    => $faker->randomElement($warrantyStatuses),
                'create_by'          => $faker->randomElement($users),
                'service_type'       => $faker->randomElement($serviceTypes),
                'status_id'          => $faker->randomElement($statuses),

                // Datetime instead of boolean
                'part_ready'         => $faker->dateTimeBetween('-1 years', 'now'),
                'completed_date'     => $faker->optional()->date(),
                'return_date'        => $faker->optional()->date(),
            ]);
        }
    }
}

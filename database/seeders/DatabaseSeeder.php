<?php

namespace Database\Seeders;

use App\Enums\EmployeeType;
use App\Models\Employee;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => Hash::make('secret'),
        ]);


        $faker = Faker::create();

        $i = 0;
        while ($i < 5) {
            $manager = Employee::create([
                'name' => $faker->name,
                'position_type' => EmployeeType::MANAGER,
                'start_date' => Carbon::now(),
            ]);
            $j = 0;

            while ($j < 5) {
                Employee::create([
                    'name' => $faker->name,
                    'position_type' => EmployeeType::WORKER,
                    'start_date' => Carbon::now(),
                    'superior_id' => $manager->id
                ]);

                $j++;
            }

            $i++;
        }
    }
}

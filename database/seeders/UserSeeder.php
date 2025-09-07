<?php

namespace Database\Seeders;

use App\Models\Factory;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \echoCLI('Seed Users Data...');

        $userConfigs = [
            ['Chris', 'Chris', 'dev@example.com', 'dev@example.com', ['developer', 'admin']],
            ['Brook Wang', 'Brook', 'brook@cgsports.com.au', 'brook@cgsports.com.au', ['admin']],
            ['Joyce Yang', 'Joyce', 'admin@cgsports.com.au', 'admin@cgsports.com.au', ['bookkeeper']],
            ['Alan Zhu', 'Alan', 'alan@imagecell.biz', 'alan@imagecell.biz', ['account_manager']],
            ['Apple Tang', 'Apple', 'apple@imagecell.biz', 'apple@imagecell.biz', ['account_manager']],
            ['Linda ', 'Linda', 'linda@imagecell.biz', 'linda@imagecell.biz', ['account_manager']],
            ['Rex', 'Rex', 'rex@imagecell.biz', 'rex@imagecell.biz', ['account_manager']],
            ['Sophia Wang', 'Sophia', 'sophia@hzspider.com', 'sophia@hzspider.com', ['account_manager', 'factory']],
            ['Amber ZHnag', 'Amber', 'amber@hzspider.com', 'amber@hzspider.com', ['account_manager', 'factory']],
            ['Betty', 'Betty', 'betty@hzspider.com', 'betty@hzspider.com', ['account_manager', 'factory']],
            ['Mooree', 'Mooree', 'mooree@hzspider.com', 'mooree@hzspider.com', ['factory']],
            ['Jiao Zhang', 'Jiao', 'jiao@hzspider.com', 'jiao@hzspider.com', ['factory']],
        ];

        foreach($userConfigs as $i => $userConfig)
        {
            // Create User
            $user = new User([
                                 'name'              => $userConfig[1],
                                 'email'             => $userConfig[2],
                                 'email_verified_at' => now(),
                                 'password'          => bcrypt($userConfig[3]),
                                 // Brook, Joyce in Australia
                                 'timezone'          => ($i < 2 ? 'Australia/Sydney' : 'Asia/Shanghai'),
                             ]);
            $user->save();

            // Attach Staff record
            $staff = new Staff(['user_id' => $user->id, 'full_name_english' => $userConfig[0]]);

            // Assign Factory
            if($i > 1)
            {
                $staff->factory_id = Factory::inRandomOrder()->first()?->id;
            }

            $staff->user_id = $user->id;
            $staff->save();

            // Assign Roles
            $user->assignRole($userConfig[4]);
        }
    }
}

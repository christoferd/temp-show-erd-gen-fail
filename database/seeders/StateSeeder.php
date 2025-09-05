<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \echoCLI('Seed States Data...');

        $items = 'VIC,NSW,QLD,SA,WA,TAS,ACT,NT,'.
                 'Anhui,Beijing,Chongqing,Fujian,Gansu,Guangdong,Guangxi,Guizhou,Hainan,Hebei,Heilongjiang,Henan,Hubei,Hunan,Jiangsu,Jiangxi,'.
                 'Jilin,Liaoning,Nei Mongol,Ningxia Hui,Shaanxi,Shandong,Shanghai,Shanxi,Sichuan,Tianjin,Xinjiang Uygur,Xizang,Yunnan,Zhejiang';

        $items = explode(',', $items);
        foreach($items as $state)
        {
            (new State(['name' => $state]))->save();
        }
    }
}

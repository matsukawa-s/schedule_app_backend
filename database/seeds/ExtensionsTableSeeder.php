<?php

use Illuminate\Database\Seeder;

class ExtensionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('extensions')->insert([
            'ex_name' => '日記',
            'explanation' => '日々の出来事を記録できます。',
        ]);

        DB::table('extensions')->insert([
            'ex_name' => 'ToDo',
            'explanation' => '手軽にタスクの管理ができます。',
        ]);
    }
}

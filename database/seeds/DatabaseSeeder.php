<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=array(
            array(
                'name'=>'user',
            )
        );
        
        DB::table('roles')->insert($users);
    }
}

<?php
/**
 * Created by IntelliJ IDEA.
 * User: yuanc
 * Date: 2018/4/8
 * Time: 16:39
 */

namespace Admin\Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin_users')->insert([
            'name'=>'Administrator',
            'username'=>'admin',
            'email'=>'admin@email.com',
            'password'=>bcrypt('admin'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}
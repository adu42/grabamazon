<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('roles')->delete();
        DB::table('role_user')->delete();
        $users = [
            ['id'=>1,
                'name'=>'ado',
            'email'=>'1303457961@qq.com',
             'password'=>bcrypt('1303457961@qq.com'),
              'is_active'=>1,
            ],
            ['id'=>2,
                'name'=>'dobing',
                'email'=>'114458573@qq.com',
                'password'=>bcrypt('114458573@qq.com'),
                'is_active'=>1,
            ],
        ];
        $roles=[
            ['id'=>1,
                'name'=>'admin',
            'description'=>'administrator',],
            ['id'=>2,
                'name'=>'customer',
                'description'=>'customer',],
            ['id'=>3,
                'name'=>'new customer',
                'description'=>'无权限用户',],
        ];
        $user_roles = [
            [
                'role_id'=>1,
                'user_id'=>1,
            ],
            [
                'role_id'=>1,
                'user_id'=>2,
            ],
        ];
        foreach ($users as $user){
            DB::table('users')->insert($user);
        }
        foreach ($roles as $role){
            DB::table('roles')->insert($role);
        }
        foreach ($user_roles as $user_role){
            DB::table('role_user')->insert($user_role);
        }

    }
}

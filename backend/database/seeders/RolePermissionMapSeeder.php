<?php

namespace Database\Seeders;

use App\Models\RolePermissionMap;
use Illuminate\Database\Seeder;

class RolePermissionMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userPermissions = [
            // admin
            [
                "sub_menu_id" => 1,
                "role_id" => 1,
                "view" => 1,
                "add" => 1,
                "edit" => 1,
                "delete" => 1,
            ],
            [
                "sub_menu_id" => 2,
                "role_id" => 1,
                "view" => 1,
                "add" => 1,
                "edit" => 1,
                "delete" => 1,
            ],
            [
                "sub_menu_id" => 3,
                "role_id" => 1,
                "view" => 1,
                "add" => 1,
                "edit" => 1,
                "delete" => 1,
            ],
            [
                "sub_menu_id" => 4,
                "role_id" => 1,
                "view" => 1,
                "add" => 1,
                "edit" => 1,
                "delete" => 1,
            ],
            [
                "sub_menu_id" => 5,
                "role_id" => 1,
                "view" => 1,
                "add" => 1,
                "edit" => 1,
                "delete" => 1,
            ],
            [
                "sub_menu_id" => 6,
                "role_id" => 1,
                "view" => 1,
                "add" => 1,
                "edit" => 1,
                "delete" => 1,
            ],
            [
                "sub_menu_id" => 7,
                "role_id" => 1,
                "view" => 1,
                "add" => 1,
                "edit" => 1,
                "delete" => 1,
            ],
            [
                "sub_menu_id" => 8,
                "role_id" => 1,
                "view" => 1,
                "add" => 1,
                "edit" => 1,
                "delete" => 1,
            ],
            [
                "sub_menu_id" => 10,
                "role_id" => 1,
                "view" => 1,
                "add" => 1,
                "edit" => 1,
                "delete" => 1,
            ],
            [
                "sub_menu_id" => 11,
                "role_id" => 1,
                "view" => 1,
                "add" => 1,
                "edit" => 1,
                "delete" => 1,
            ],
            
        ];

        foreach ($userPermissions as $permission) {
            RolePermissionMap::updateOrCreate(['sub_menu_id'=>$permission['sub_menu_id'],'role_id'=>$permission['role_id']],
            $permission
            );
          }
    }
}

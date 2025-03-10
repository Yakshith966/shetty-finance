<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Database\Seeder;

class SideBarMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuList = [[
            'name'=>'Dashboard',
            'component'=>'CNavItem',
            'slug'=>'dashboard',
            'path'=>'/dashboard',
            'icon'=>'cil-speedometer',
        ],
        [
            'name'=>'Asset Management',
            'component'=>'CNavTitle',
            'slug'=>'asset-management',
            'path'=>null,
            'icon'=>null,
        ],
        [
            'name'=>'Service Details',
            'component'=>'CNavItem',
            'slug'=>'service-details',
            'path'=>'/service-details',
            'icon'=>'cil-laptop',
        ],
        [
            'name'=>'Payment Details',
            'component'=>'CNavItem',
            'slug'=>'payment-details',
            'path'=>'/payment-details',
            'icon'=>'cil-dollar',
        ],
        [
            'name'=>'Customer Details',
            'component'=>'CNavItem',
            'slug'=>'customer-details',
            'path'=>'/customer-details',
            'icon'=>'cil-people',
        ],
        [
            'name'=>'Dealers Payment Details',
            'component'=>'CNavItem',
            'slug'=>'dealers-payment-details',
            'path'=>'/dealers-payment-details',
            'icon'=>'cil-dollar',
        ],
        [
            'name'=>'Reports',
            'component'=>'CNavTitle',
            'slug'=>'reports',
            'path'=>null,
            'icon'=>null,
        ],
        [
            'name'=>'Masters',
            'component'=>'CNavTitle',
            'slug'=>'masters',
            'path'=>null,
            'icon'=>null,
        ],
        [
            'name'=>'Dealers',
            'component'=>'CNavItem',
            'slug'=>'dealers',
            'path'=>'/dealers',
            'icon'=>'cil-contact',
        ],
        [
            'name'=>'User Management',
            'component'=>'CNavItem',
            'slug'=>'user-management',
            'path'=>'/user-management',
            'icon'=>'cil-contact',
        ],
        [
            'name'=>'Settings',
            'component'=>'CNavTitle',
            'slug'=>'settings',
            'path'=>null,
            'icon'=>null,
        ],
        [
            'name'=>'User Profile',
            'component'=>'CNavItem',
            'slug'=>'user-profile',
            'path'=>'/user-profile',
            'icon'=>'cil-user',
        ],
        ];

        $menuIndex = 1;
        // insert menu
        foreach ($menuList as $menu) {
            $menu['sort_order'] = $menuIndex++;
            Menu::updateOrCreate(['slug'=>$menu['slug']],$menu);
        }


        $subMenuList = [[
            'name'=>'Dashboard',
            'component'=>'CNavItem',
            'slug'=>'dashboard',
            'view_path'=>'dashboard/Dashboard.vue',
            'icon'=>'cil-speedometer',
        ],
        [
            'name'=>'Asset Management',
            'component'=>'CNavTitle',
            'slug'=>'asset-management',
            'view_path'=>null,
            'icon'=>null,
        ],
        [
            'name'=>'Service Details',
            'component'=>'CNavItem',
            'slug'=>'service-details',
            'view_path'=>'pages/ServicePageDetails.vue',
            'icon'=>'cil-laptop',
        ],
        [
            'name'=>'Payment Details',
            'component'=>'CNavItem',
            'slug'=>'payment-details',
            'view_path'=>'pages/PaymentDetails.vue',
            'icon'=>'cil-dollar',
        ],
        [
            'name'=>'Customer Details',
            'component'=>'CNavItem',
            'slug'=>'customer-details',
            'view_path'=>'pages/CustomerDetails.vue',
            'icon'=>'cil-people',
        ],
        [
            'name'=>'Dealers Payment Details',
            'component'=>'CNavItem',
            'slug'=>'dealers-payment-details',
            'view_path'=>'pages/DealersPayment.vue',
            'icon'=>'cil-dollar',
        ],
        [
            'name'=>'Reports    ',
            'component'=>'CNavTitle',
            'slug'=>'reports',
            'path'=>null,
            'icon'=>null,
        ],
        [
            'name'=>'Masters',
            'component'=>'CNavTitle',
            'slug'=>'masters',
            'view_path'=>null,
            'icon'=>null,
        ],
        [
            'name'=>'Dealers',
            'component'=>'CNavItem',
            'slug'=>'dealers',
            'view_path'=>'pages/Dealers.vue',
            'icon'=>'cil-contact',
        ],
        [
            'name'=>'User Management',
            'component'=>'CNavItem',
            'slug'=>'user-management',
            'view_path'=>'pages/UserManagement.vue',
            'icon'=>'cil-contact',
        ],
        [
            'name'=>'Settings',
            'component'=>'CNavTitle',
            'slug'=>'settings',
            'view_path'=>null,
            'icon'=>null,
        ],
        [
            'name'=>'User Profile',
            'component'=>'CNavItem',
            'slug'=>'user-profile',
            'view_path'=>'pages/UserProfile.vue',
            'icon'=>'cil-user',
        ],
        ];

        $subMenuIndex = 1;
        foreach ($subMenuList as &$submenu) {
            $menuId = Menu::where('slug',$submenu['slug'])->value('id');
            $submenu['menu_id'] = $menuId;
            $submenu['sort_order'] = $subMenuIndex++;
            
            SubMenu::updateOrcreate(['slug'=>$submenu['slug']],$submenu);
            
        }


    }
    
}

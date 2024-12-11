<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubMenu extends Model
{
    use HasFactory;

    protected $hidden = ['created_at','updated_at'];
    protected $guarded = [];
    public function menu()
    {
        return $this->belongsTo(Menu::class,'menu_id');
    }

    public function permissions()
    {
        return $this->hasMany(RolePermissionMap::class,'sub_menu_id');
    }

    public function getSideBarMenus()
    {
        $roleId = Auth::user()->role_id;

        return self::query()->with(['permissions'=>function($query) use($roleId){
            $query->where('role_id',$roleId);
        }])->whereHas('permissions', function ($query) use($roleId) {
            $query->where([['role_id',$roleId],['view',1]]);
        })->orderBy('sort_order')->get();
    }
}

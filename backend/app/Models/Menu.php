<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['id','name','component','slug','path','icon','sort_order','created_at','updated_at'];
    protected $guarded = [];
    public function submenu()
    {
        return $this->hasMany(SubMenu::class,'menu_id');
    }
}

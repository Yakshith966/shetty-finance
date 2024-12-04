<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermissionMap extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'role_id','sub_menu_id', 'view', 'add', 'edit', 'delete', 'created_at', 'updated_at'];
}

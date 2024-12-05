<?php

namespace App\Http\Controllers;

use App\Models\RolePermissionMap;
use App\Models\SubMenu;
use Illuminate\Http\Request;

class RolePermissionMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getPermissions()
    {
        $model = new RolePermissionMap();
        $data = $model->getSubMenuWithPermission(request('userId'));
        return response()->json(['subMenus'=>$data]);
    }

    public function getSubMenuWithPermission(Request $request)
    {
        $roleId = $request->roleId;
        $subMenus =  SubMenu::with(['permissions'=>function($query)use($roleId){
            $query->where('role_id',$roleId);
        }])->get();

        foreach ($subMenus as &$subMenu) {
            // Check if 'permissions' is an array and if it has elements
            if (empty($subMenu['permissions']) || !isset($subMenu['permissions'][0])) {
                // If 'permissions' is empty or index 0 does not exist, initialize it
                $subMenu['permissions'][0] = [
                    'view' => false,
                    'add' => false,
                    'edit' => false,
                    'delete' => false,
                ];
            } else {
                // If 'permissions' exists and has elements, ensure the values are set correctly
                $subMenu['permissions'][0]['view'] = $subMenu['permissions'][0]['view'] ? true : false;
                $subMenu['permissions'][0]['add'] = $subMenu['permissions'][0]['add'] ? true : false;
                $subMenu['permissions'][0]['edit'] = $subMenu['permissions'][0]['edit'] ? true : false;
                $subMenu['permissions'][0]['delete'] = $subMenu['permissions'][0]['delete'] ? true : false;
            }
        }
        
        return response()->json(['subMenus' => $subMenus]);
    }
}

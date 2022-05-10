<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Hash;

class RoleController extends Controller
{
    //show all role 
    public function Allrole()
    {
        $data = DB::table('users')->where('is_admin', 1)->where('role_admin', 1)->get();
        return view('admin.role.index', compact('data'));
    }

    //page load 
    public function roleCreate()
    {
        return view('admin.role.create');
    }

    //user role store method
    public function rolestore(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users',
        ]);
        $data = [];
        $data ['is_admin'] = 1;
        $data ['role_admin'] = 1;
        $data ['name'] = $request->name;
        $data ['email'] = $request->email;
        $data ['password'] = Hash::make($request->password);
        $data ['category'] = $request->category;
        $data ['product'] = $request->product;
        $data ['order'] = $request->order;
        $data ['offer'] = $request->offer;
        $data ['pickup'] = $request->pickup;
        $data ['tricket'] = $request->tricket;
        $data ['setting'] = $request->setting;
        $data ['blog'] = $request->blog;
        $data ['contact'] = $request->contact;
        $data ['report'] = $request->report;
        $data ['role'] = $request->role;
        $data ['status'] = $request->status;
        $data ['created_at'] = Carbon::now();
        $data ['updated_at'] = Carbon::now();
        DB::table('users')->insert($data);
        return response()->json('User Role Create Sucessfull !!');
    }

    //role edit page load
    public function edit($id)
    {
        $data = DB::table('users')->where('id', $id)->first();
        return view('admin.role.edit', compact('data'));
    }

    //role update
    public function update(Request $request)
    {
        $id = $request->id;
        $data = [];
        $data ['name'] = $request->name;
        $data ['email'] = $request->email;
        $data ['category'] = $request->category;
        $data ['product'] = $request->product;
        $data ['order'] = $request->order;
        $data ['offer'] = $request->offer;
        $data ['pickup'] = $request->pickup;
        $data ['tricket'] = $request->tricket;
        $data ['setting'] = $request->setting;
        $data ['blog'] = $request->blog;
        $data ['contact'] = $request->contact;
        $data ['report'] = $request->report;
        $data ['role'] = $request->role;
        $data ['status'] = $request->status;
        $data ['updated_at'] = Carbon::now();
        DB::table('users')->where('id', $id)->update($data);
        $notify = array('messege' => 'User Role Update Sucessfull !', 'alert-type' => 'success');
        return redirect()->route('manage.role')->with($notify);
    }

    //user role delete
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        $notify = array('messege' => 'User Role Delete Sucessfull !', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Estate;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
     /**
     * Display the specified resource.
     *
     * @param  \App\User $product
     * @return \Illuminate\Http\Response
     */
   
    public function registered(){        
    return View ('admin.dashboard');
        /*Do muốn hiển thị 2 con số từ $users và $total ra dashboard, nên ta tạo các biến đó và compact nó
        , nếu ta muốn cả hai số hiện trên cùng một view (in this case is dashboard blade) mà lại tạo
        chúng ở hai functions thì khi gọi nó sẽ báo lỗi*/

    }
    //here we create fuction for edit users
    public function registeredit(Request $request, $id)
    {
    	$users = User::findOrFail($id);
    	return view('admin.register-edit',compact('users'));
    }

    // here we create function for update button
    public function registerupdate(Request $request, $id)
    {
    	$users = User::find($id);
    	$users->name = $request->input('username');
    	$users->usertype = $request->input('usertype');
    	$users->update();

    	return redirect('/role-register')->with('status','data is updated'); 
    }
    //delete function
    public function registerdelete($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect('/role-register')->with('status','data deleted');

    }
    public function Dashboard1 (){
        $users = User::all();
        $TotalUser = User::count();
        return view('admin.dashboardv1',compact('users','TotalUser'))
        ;}
    
    public function Dashboard2 (){
        return view('admin.dashboardv2')
        ;}
    
    public function Dashboard3(){
     return view('admin.dashboardv3')
     ;}
    
 
 
}

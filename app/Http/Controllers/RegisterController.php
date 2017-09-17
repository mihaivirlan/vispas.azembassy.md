<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Auth;
use App\Admin;

class RegisterController extends Controller
{
    protected function AdminLogin(Request $request){

        $input=$request->all();
        $rules=[
            'email'=>'required',
            'password'=>'required',
        ];

        $v=Validator::make($input,$rules);

        if($v->fails()){
            return back()->withErrors($v);
        }

        if(Auth::guard('admin')->attempt(['email'=>$input['email'],'password'=>$input['password'],'status'=>1])){
            return redirect()->route('admin');
        }else {
            return back()->withErrors(trans('register.admin_not_exist'));
        }
    }

    protected  function AdminLogout(){
            Auth::guard('admin')->logout();
            return redirect()->route('/');
    }

    protected function EditPassword(Request $request){
        $input=$request->all();
        $rules=[
            'current_password'=>'required|min:6|max:50|string',
            'password' => 'required|min:6|confirmed|max:50|string',
            'password_confirmation' => 'required|min:6|max:50|string',
        ];
        $messages = [
            'password.required' => trans('register.password_required'),
            'password_confirmation.required' => trans('register.password_confirmation_required'),
            'password.min'              =>trans('register.password_min'),
            'password.confirmed'        =>trans('register.password_confirmation'),
            'password_confirmation.min' =>trans('register.password_confirmation_min'),
            'password_confirmation.max' =>trans('register.password_confirmation_max'),

        ];
        $validator=Validator::make($input,$rules,$messages);
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        if(!Hash::check($input['current_password'],Auth::user()->password))
        {
            return back()->withErrors(trans('register.error_password'));
        }

        $model= User::find(Auth::user()->id);
        $model->password=bcrypt($input['password']);
        if($model->save()){
            Auth::logout();
            return redirect()->route('/')->with('success',trans('register.password_edit_success'));
        }else {
            return back()->withErrors(trans('register.error'));
        }
    }



    protected  function PostRegisterAdmin(Request $request){
        $input=$request->all();
        $rules=[
            'email'     => 'required|unique:admins,email|max:150|email|min:6',
            'password'  => 'required|min:6|confirmed|max:50|string',
            'password_confirmation' => 'required|min:6|max:50',
            'name'      => 'required|min:3|string|max:50',
        ];

        $messages=[

            'email.required' => trans('register.email_required'),
            'password.required' => trans('register.password_required'),
            'password_confirmation.register' => trans('register.password_confirmation_required'),
            'name.required' => trans('register.name_required'),
            'adress.required' => trans('register.address_required'),

            'email.unique'          =>trans('register.email_unique'),
            'email.max'          =>trans('register.email_max'),
            'email.email'          =>trans('register.email_email'),
            'email.min'          =>trans('register.email_min'),

            'password.min'              =>trans('register.password_min'),
            'password.confirmed'        =>trans('register.password_confirmation'),
            'password.max' =>trans('register.password_max'),
            'password_confirmation.min' =>trans('register.password_confirmation_min'),
            'password_confirmation.max' =>trans('register.password_confirmation_max'),

            'name.min'                  =>trans('register.name_min'),
            'name.max'                  =>trans('register.name_max'),


        ];

        $v=Validator::make($input,$rules,$messages);
        if($v->fails()){
            return back()->withErrors($v);
        }


        $user= new Admin();
        $user->name=$input['name'];
        $user->email=$input['email'];
        $user->password=bcrypt($input['password']);
        $user->type=0;
        $user->remember_token=str_random(32);
        if($user->save()){
            return redirect()->route('admin/user_admin')->with('success',trans('register.register_success'));
        }else {
            return back()->withErrors($user->save());
        }

    }

    protected function DeleteAdmin(Request $request){
        $input=$request->all();
        $rules=[
            'id' =>'required|exists:admins,id,type,0'
        ];

        $v=Validator::make($input,$rules);
        if($v->fails()){
            return back()->withErrors($v);
        }

        $admin=Admin::find($input['id']);
        if($admin->delete()){
            return back()->with('success',trans('trans.data_delete'));
        }else {
            return back()->withErrors($admin->delete());
        }
    }

    protected function GetUserAdmin()
    {
        if(!Auth::guard('admin')->user()->type){
            return redirect()->route('admin')->withErrors(trans('trans.access_denied'));
        }
        $admins=Admin::orderBy('id','desc')->get();

        return view('admin.user.user_admin',compact('admins'));

    }

    protected function PostUserAdmin(Request $request){
        if(Auth::guard('admin')->user()->type==0){
            return back()->withErrors(trans('trans.access_denied'));
        }
        $input=$request->all();
        $rules=[
            'id'                =>'required|numeric|exists:admins,id',
        ];
        $validator=Validator::make($input,$rules);
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $user=Admin::find($input['id']);
        $rules=[
            'password'  => 'required|min:6|confirmed|max:50|string',
            'password_confirmation' => 'required|min:6|max:50'
        ];
        $v=Validator::make($input,$rules);
        if($v->fails()) {
            return back()->withErrors($v);

        }

        $user->password=bcrypt($input['password']);

        if($user->save())
        {
            return back()->with('success',trans('trans.data_save'));
        }else {
            return back()->withErrors(trans('trans.data_not_save'));
        }
    }

    function GetRegister(){
        return view('admin.user.register');
    }


}

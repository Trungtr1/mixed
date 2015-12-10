<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Session;
use Hash;

	class RegisterController extends Controller {
		
		public function index()
		{
			return view('pages.register');
		}
		
		public function creat_account(Request $request)
		{
			$user=Session::get('user');
			
			$validator = Validator::make($request->all(), [
				'email' 		=>	'required|unique:users',
				'fullname' 		=>	'required',
				'password'		=>  'required',
				'confirm_psw'	=>  'required',
			]);
			
			if ($validator->fails()) {
			
				return \Redirect::back()
							->withErrors($validator)
							->withInput();
							
			} else {
				
				$inputData = $request->only('email','fullname','phone','address');
				
				$inputData['password'] = Hash::make($request['password']);
				
				$inputData['role'] = 1;
				
				if (DB::table('users')->insert($inputData)) {
		
				return \Redirect('/login')->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
			
				} else {
				
					return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
				
				}
				
			}
		}
	}
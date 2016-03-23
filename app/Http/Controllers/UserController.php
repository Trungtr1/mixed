<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Session;
use File;
use Hash;

	class UserController extends Controller {
		
		public function index(Request $request)
		{
			
		}
	
		public function account()
		{
			$user_ss = Session::get('user');

			$get_user = DB::table('users')->where('id',$user_ss['id'])->get();
			
			$viewData['user'] = $get_user[0];
			
			return view('pages/register')->with('data',$viewData);
		}
		
		public function editaccount(Request $request)
		{
			$validator = Validator::make($request->all(), [
				'email' 		=>	'required',
				'fullname' 		=>	'required',
				'password_old'	=>  'required',
			]);
			
			if ($validator->fails()) {
			
				return \Redirect::back()
							->withErrors($validator)
							->withInput();
							
			} else {
				
				$get_account = DB::table('users')->where('id',$request['id'])->get();
				
				if(Hash::check($request['password_old'],$get_account[0]['password']))
				{
					$inputData = $request->only('email','fullname','phone','address');
					
					if(isset($request['password']))
					{
						$inputData['password'] = Hash::make($request['password']);
					}					
					
					$inputData['role'] = 1;
					
					if(isset($request['avata'])){
				
						$move=$request['avata']->move(		
								
						base_path() . '/public/img/avata/',$request['id'].'.jpg'
						
						);		
					}
					
					if (DB::table('users')->where('id',$request['id'])->update($inputData)) {
			
					return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Cập nhật thành công'));
				
					} else {
					
						return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
					
					}
				}else{
					return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Mật khẩu cũ không chính xác'));
				}
			}
		}
	}
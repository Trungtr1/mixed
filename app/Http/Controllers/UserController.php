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
			/*$user = Session::get('user');
			
			if(Session::has('objects_cut')){
				$objects_cut = Session::get('objects_cut');
				$viewData['objects_cut'] = $objects_cut;
			}
			
			$viewData['user']=$user;
			
			$action = $request->get('action');
			
			if($action=='delete')
			{
				$this->delete_folder($request->get('id'));
			}
			
			$viewData['folders'] = DB::table('groups')
										->join('folders','folders.id','=','groups.folder_id')
										->where('groups.user_id',$user['id'])
										->where('folders.level','1')
										->where('categories','0')
										->get();

			//$viewData['tests'] = DB::table('tests')->where('status',1)->where('user_id',$user['id'])->get();
			
			$viewData['files'] = DB::table('groups')
										->select(DB::raw('count(questions.id) as count, folders.id, folders.name, folders.date, folders.share'))
										->join('folders','folders.id','=','groups.folder_id')
										->join('questions','folders.id','=','questions.folder_id','LEFT')
										->where('groups.user_id',$user['id'])
										->where('folders.level','1')
										->where('categories','1')
										->groupBy('folders.id','folders.name','folders.date','folders.share')
										->get();
			
			$get_messages = DB::table('messages')->where('user_id',$user['id'])->where('status','0')->get();
			
			if($get_messages)
			{
				$viewData['statusCode'] = 1;
			
				$viewData['message'] = $get_messages[0]['content'];
				
				DB::table('messages')->where('id',$get_messages[0]['id'])->update(array('status'=>1));
			}
			
			return view('user')->with('data',$viewData);*/
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
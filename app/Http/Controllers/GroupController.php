<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Session;
use File;
use Mail;


	class GroupController extends Controller {
		
		public function index(Request $request)		
		{
			
		}
		
		public function invite(Request $request)
		{			
			$validator = Validator::make($request->all(), [
				'email' 		=>	'required',
				'group_id' 			=>	'required',
				'group_name' 			=>	'required',
			]);
			
			if ($validator->fails()) {
			
				return \Redirect::back()
							->withErrors($validator)
							->withInput();
							
			}else{
				$get_email = DB::table('users')->where('email',$request['email'])->get();
			
				if($get_email){
					
					$inputData = array(
									'user_id' 	=> $get_email[0]['id'],
									'folder_id' => $request['group_id'],
									'role'		=> 1,
								);
					
					if(DB::table('groups')->insert($inputData))
					{
						$inputData = array(
											'content' => 'Bạn đã được thêm vào nhóm '.$request['group_name'],
											'user_id' => $get_email[0]['id'],
											'status'  => 0,
										);
						if(DB::table('messages')->insert($inputData))
						{				
							$email = $request['email'];
							if(Mail::send('mail2', array('group_name'=>$request['group_name']), function($message) use($email)
								{
									$message->to($email, null)->subject('Thư mời tham gia');
								}))
							{
								return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thư đã được gửi đến địa chỉ mail vừa nhập'));
							}else{
								return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Không gửi được mail'));
							}
						}else{
							return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Gửi thông báo không thành công'));
						}					
					}else{
						return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
					}				
				}else{
					//return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Không tìm thấy email trên hệ thống'));
					$email = $request['email'];
					if(Mail::send('mail', array('group_name'=>$request['group_name']), function($message) use($email)
						{
							$message->to($email, null)->subject('Thư mời tham gia');
						}))
					{
						return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thư đã được gửi đến địa chỉ mail vừa nhập, bạn hãy mời lại sau nhé.'));
					}else{
						return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Không gửi được mail'));
					}
				}
			}
		}
		
		public function out_group(Request $request)
		{
			$id = $request->get('id');
			
			$user = Session::get('user');
			
			if(DB::table('groups')->where('folder_id',$id)->where('user_id',$user['id'])->delete())
			{
				return \Redirect('user')->with('responseData', array('statusCode' => 1, 'message' => 'Rời khỏi nhóm thành công'));
			}else{
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Rời khỏi nhóm không thành công'));
			}
		}
		
		public function setting(Request $request)
		{
			$validator = Validator::make($request->all(), [
				'name' 			=>	'required',
				'id' 			=>	'required',
			]);
			
			if ($validator->fails()) {
			
				return \Redirect::back()
							->withErrors($validator)
							->withInput();
							
			}else{
			
				$inputData = array(
									'name' => $request['name'],
								);
				
				if(DB::table('folders')->where('id',$request['id'])->update($inputData))
				{
					return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Chỉnh sửa thành công'));
				}else{
					return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Chỉnh sửa thất bại'));
				}	
			}
		}
		
		public function member(Request $request)
		{
			$id = $request->get('id');
			
			$user = Session::get('user');
			
			$viewData['user'] = DB::table('groups')
											->select('users.id','users.fullname','users.avata','groups.folder_id','groups.role as role_group')
											->join('users','users.id','=','groups.user_id')
											->where('groups.folder_id',$id)
											->where('groups.user_id',$user['id'])
											->get();
			
			$viewData['user_group'] = DB::table('groups')
											->select('users.id','users.fullname','users.avata','users.email','users.phone','users.address','groups.folder_id','groups.role as role_group')
											->join('users','users.id','=','groups.user_id')
											->where('groups.folder_id',$id)
											->get();
											
			$viewData['folder'] = DB::table('folders')->where('id',$id)->get();		
			
			$viewData['count'] = count($viewData['user_group']);
			
			return view('groupmember')->with('data',$viewData);
		}
		
		public function kick_member(Request $request)
		{
			if(DB::table('groups')->where('folder_id',$request['group'])->where('user_id',$request['id'])->delete())
			{
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Loại bỏ thành công'));
			}else{
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Loại bỏ thất bại'));
			}
		}
		
		public function changerole(Request $request)
		{
			if(DB::table('groups')->where('folder_id',$request['group'])->where('user_id',$request['id'])->update(array('role'=>'3')))
			{
				return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Loại bỏ thành công'));
			}else{
				return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Loại bỏ thất bại'));
			}
		}
	}
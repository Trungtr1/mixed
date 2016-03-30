<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Session;
use File;


	class FolderController extends Controller {
		
		public function index(Request $request)				
		{

			$id = $request->get('id');

			$user = Session::get('user');
			
			$viewData['user'] = DB::table('groups')
											->select('users.id','users.fullname','users.avata','groups.folder_id','groups.role as role_group')
											->join('users','users.id','=','groups.user_id')
											->where('groups.folder_id',$id)
											->where('groups.user_id',$user['id'])
											->get();

			if(Session::has('objects_cut')){
				$objects_cut = Session::get('objects_cut');
				$viewData['objects_cut'] = $objects_cut;
			}

			$action = $request->get('action');												

			if($action=='delete')
			{
				$this->delete_folder($request->get('folder_id'));
			}
			
			if(isset($id)){

				$viewData['folder'] = DB::table('folders')
													->select('folders.id','folders.name','folders.parent','folders.level','folders.categories','folders.date','folders.share','groups.user_id','groups.folder_id')
													->join('groups','folders.id','=','groups.folder_id')
													->where('folders.id',$id)
													->get();

				$auth = array(							
							'share'	=>	$viewData['folder'][0]['share']
				);

				foreach($viewData['folder'] as $value){
					$auth['user'][]=$value['user_id'];
				}		

				if(in_array($user['id'],$auth['user'])){

						$viewData['subfolder'] = DB::table('folders')->where('parent',$id)->where('categories',0)->get();

						$viewData['subfile'] = DB::table('folders')
														->select(DB::raw('count(questions.id) as count, folders.id, folders.name, folders.date, folders.share'))
														->join('questions','folders.id','=','questions.folder_id','LEFT')
														->where('parent',$id)
														->where('categories',1)
														->groupBy('folders.id','folders.name','folders.date','folders.share')
														->get();
						
						$viewData['user_group'] = DB::table('groups')
														->select('users.id','users.fullname','users.avata','groups.folder_id','groups.role as role_group')
														->join('users','users.id','=','groups.user_id')
														->where('groups.folder_id',$id)
														->get();
						
						return view('folder')->with('data',$viewData);
			
				}else{
					
					if($auth['share']==0){	
						
						echo "Bạn không có quyền truy cập thư mục này";
						
					}else{
						
						$viewData['subfolder'] = DB::table('folders')->where('parent',$id)->where('categories',0)->get();
			
						$viewData['subfile'] = DB::table('folders')
														->select(DB::raw('count(questions.id) as count, folders.id, folders.name, folders.date, folders.share'))
														->join('questions','folders.id','=','questions.folder_id','LEFT')
														->where('parent',$id)
														->where('categories',1)
														->groupBy('folders.id','folders.name','folders.date','folders.share')
														->get();

						$viewData['user_group'] = DB::table('groups')
														->select('users.id','users.fullname','users.avata','groups.folder_id','groups.role as role_group')
														->join('users','users.id','=','groups.user_id')
														->where('groups.folder_id',$id)
														->get();										
														
						return view('view_folder')->with('data',$viewData);

					}
					
				}
				
			}else{

				$viewData['folders'] = DB::table('groups')
										->join('folders','folders.id','=','groups.folder_id')
										->where('groups.user_id',$user['id'])
										->where('folders.level','1')
										->where('categories','0')
										->get();

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
				
				return view('user')->with('data',$viewData);
				
			}
		}
		
		public function delete_folder($id)
		{
			
			$user = Session::get('user');
			
			if (DB::table('groups')->where('folder_id', $id)->where('user_id',$user['id'])->where('role',3)->delete()) {
				
				if (DB::table('folders')->where('id', $id)->delete()){
					
					return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Đã xóa thành công'));
					
				}else{
					
					return \Redirect::back()->with('responseData', array('statusCode' => 2, 'message' => 'Chưa xóa hết dữ liệu trong hệ thống'));
					
				}
				
			} else {
			
				return \Redirect::back()->with('responseData', array('statusCode' => 2, 'message' => 'Bạn không có đủ quyền để thực hiện xóa'));
			
			}
		}
	}
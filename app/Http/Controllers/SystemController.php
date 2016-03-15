<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Session;
use File;

	class SystemController extends Controller {
		
		public function cut(Request $request)
		{
			Session::put('objects_cut',$request['objects']);
			
			return \Redirect::back();
		}
		
		public function paste(Request $request)
		{			
			$objects = explode(' ',trim($request['objects']));
			
			if(isset($request['id_folder']))
			{					
				foreach($objects as $obj)
				{
					$inputData = array(
									'parent' => $request['id_folder'],
									'level'	 => $request['level_folder']+1,
								);
					DB::table('folders')->where('id',$obj)->update($inputData);
				}
			}else{
				foreach($objects as $obj)
				{
					$inputData = array(
									'parent' => null,
									'level'	 => '1',
								);
					DB::table('folders')->where('id',$obj)->update($inputData);
				}
			}
			
			
			Session::forget('objects_cut');
			
			return \Redirect::back();
		}
		
		public function create_folder(Request $request)
		{	

			$validator = Validator::make($request->all(), [
				'name' 			=>	'required',
				'level' 		=>	'required',
				'categories' 	=>	'required',
				'share' 		=>	'required',
			]);
			
			if ($validator->fails()) {
			
				return \Redirect::back()
							->withErrors($validator)
							->withInput();
							
			}else{
				$user=Session::get('user');

				$folder = DB::table('folders');
				
				$inputData = array(
									'name' 		=> $request['name'],
									'parent'	=> $request['parent'],
									'level'		=> $request['level']+1,
									'date'		=> date('Y-m-d'),
									'categories'=> $request['categories'],
									'share'		=> $request['share']
								);
				
				if ($folder->insert($inputData)) {
					
					$folder_id = DB::getPdo()->lastInsertId();
					
					$inputData = array(
										'user_id' 	=> $user['id'],
										'folder_id'	=> $folder_id,
										'role'		=> 3
									);
									
					if(DB::table('groups')->insert($inputData))
					{
						return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
					}else{
						return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
					}
					
				} else {
				
					return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
				
				}
			}
		}

		public function create_folder_group(Request $request)
		{			
			$validator = Validator::make($request->all(), [
				'name' 			=>	'required',
				'level' 		=>	'required',
				'categories' 	=>	'required',
				'share' 		=>	'required',
			]);
			
			if ($validator->fails()) {
			
				return \Redirect::back()
							->withErrors($validator)
							->withInput();
							
			}else{
				$user=Session::get('user');
					
				$user_parent = DB::table('groups')->where('folder_id',$request['parent'])->where('user_id','!=',$user['id'])->get();

				$folder = DB::table('folders');
				
				$inputData = array(
									'name' 		=> $request['name'],
									'parent'	=> $request['parent'],
									'level'		=> $request['level']+1,
									'date'		=> date('Y-m-d'),
									'categories'=> $request['categories'],
									'share'		=> $request['share']
								);
				
				if ($folder->insert($inputData)) {
					
					$folder_id = DB::getPdo()->lastInsertId();

					$inputData = array();

					$inputData[] = array(
										'user_id' 	=> $user['id'],
										'folder_id'	=> $folder_id,
										'role'		=> 3
									);
					
					foreach($user_parent as $value){
					
						$inputData[] = array(
										'user_id' 	=> $value['user_id'],
										'folder_id'	=> $folder_id,
										'role'		=> 1
									);						
					}
	
					if(DB::table('groups')->insert($inputData))
					{
						return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thêm mới thành công'));
					}else{
						return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
					}									
					
				} else {
				
					return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra, vui lòng thử lại'));
				
				}
			}
		}
		
		public function mixQuestion(Request $request)
		{
			
			$validator = Validator::make($request->all(), [
				'number_tests' 		=>	'required',
				'school'			=>  'required',
				'title'				=>  'required',
				'subject'			=>	'required',
				'time'				=>	'required',
			]);
			
			if ($validator->fails()) {
			
				return \Redirect::back()
							->withErrors($validator)
							->withInput();
							
			}else{
				if($request['file']){
					$questions = array();
					
					$data_questions = array();

					foreach($request['file'] as $key=>$cht)
					{
						$get_questions = DB::table('questions')->where('folder_id',$cht)->get();
						
						foreach($get_questions as $ge)
						{
							$questions[] = $ge['id'];							
						}
						
						$random_questions = array_rand($questions,$request['number_questions'][$key]);
						
						foreach($random_questions as $value)
						{
							$data_questions[] = $questions[$value];
						}
					}
					
					$total_questions=0;
					
					foreach($request['number_questions'] as $value)
					{
						$total_questions=$total_questions+$value;
					}
					
					if(count($data_questions)>=$total_questions)
					{
						$user = Session::get('user');
						
						$tests = array();
						
						/*$random_questions = array_rand($questions,$request['number_questions']);
						
						$data_questions = array();										
						
						foreach($random_questions as $value)
						{
							$data_questions[] = $questions[$value];
						}*/									
						
						for($i=0;$i<$request['number_tests'];$i++)
						{
							$tests[] = $this->troncauhoi($data_questions);
						}
						
						DB::table('tests')->where('user_id', $user['id'])->update(array('status' => 0));
						
						foreach($tests as $key1=>$value1)
						{
							$number_test = $key1+1;
							
							$inputData1 = array(
									'name' 		=> "Đề ".$number_test,
									'school'	=> $request['school'],
									'title'		=> $request['title'],
									'subject'	=> $request['subject'],
									'time'		=> $request['time'],
									'date'		=> date('Y-m-d'),
									'status'	=> 1,
									'code'		=> rand(101,999),
									'user_id'	=> $user['id'],
								);
							
							if(DB::table('tests')->insert($inputData1))							
							{
								$test_id = DB::getPdo()->lastInsertId();
							
								foreach($value1 as $value2)
								{
									$get_answers = DB::table('answers')->where('question_id',$value2)->get();
									
									$answers = array();
									
									foreach($get_answers as $value3)
									{
										$answers[] = $value3['id'];
									}
									
									$data_answers = $this->troncauhoi($answers);
									
									if($get_answers)
									{
										$inputData2 = array(
														'question_id' 		=> $value2,
														'test_id'		=> $test_id,
														);
									
										if(DB::table('test_questions')->insert($inputData2))
										{
											$test_question_id = DB::getPdo()->lastInsertId();
											
											foreach($data_answers as $key2=>$value4)
											{
												$inputData3 = array(
															'test_question_id' 	=> $test_question_id,
															'answer_id'			=> $value4,
															'order'				=> $key2,
															'test_id'			=> $test_id,
														);
												DB::table('test_answers')->insert($inputData3);									
											}
										}
									}																
								}
							}						
						}
						return \Redirect('/test')->with('responseData', array('statusCode' => 1, 'message' => 'Tạo đề thành công'));
					}else{
						return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Số lượng câu hỏi không đủ theo yêu cầu.'));
					}
				}else{
					return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Chọn file muốn trộn.'));
				}
			}
		}
		
		public function testQuestion(Request $request)
		{

			$validator = Validator::make($request->all(), [
				'file' 					=>	'required',
				'number_questions'		=>  'required',
				'ipt_total_question'	=>  'required',
			]);
			
			if ($validator->fails()) {
			
				return \Redirect::back()
							->withErrors($validator)
							->withInput();
							
			}else{
				if($request['file']){
					$questions = array();
					
					$data_questions = array();

					foreach($request['file'] as $key=>$cht)
					{
						$get_questions = DB::table('questions')->where('folder_id',$cht)->get();
						
						foreach($get_questions as $ge)
						{
							$questions[] = $ge['id'];							
						}
						
						$random_questions = array_rand($questions,$request['number_questions'][$key]);
						
						foreach($random_questions as $value)
						{
							$data_questions[] = $questions[$value];
						}
					}
					
					$total_questions=0;
					
					foreach($request['number_questions'] as $value)
					{
						$total_questions=$total_questions+$value;
					}
					
					if(count($data_questions)>=$total_questions)
					{
						$user = Session::get('user');
						
						$tests= array();

						$tests[] = $this->troncauhoi($data_questions);

						DB::table('tests')->where('user_id', $user['id'])->update(array('status' => 0));

						foreach($tests as $key1=>$value1)
						{
							$number_test = $key1+1;
							
							$inputData1 = array(
									'name' 		=> "Đề ".$number_test,
									'school'	=> '',
									'title'		=> '',
									'subject'	=> '',
									'time'		=> '',
									'date'		=> date('Y-m-d'),
									'status'	=> 1,
									'code'		=> rand(101,999),
									'user_id'	=> $user['id'],
									'number_questions' => count($data_questions),
								);
							
							if(DB::table('tests')->insert($inputData1))							
							{
								$test_id = DB::getPdo()->lastInsertId();
							
								foreach($value1 as $value2)
								{
									$get_answers = DB::table('answers')->where('question_id',$value2)->get();
									
									$answers = array();
									
									foreach($get_answers as $value3)
									{
										$answers[] = $value3['id'];
									}
									
									$data_answers = $this->troncauhoi($answers);
									
									if($get_answers)
									{
										$inputData2 = array(
														'question_id' 		=> $value2,
														'test_id'		=> $test_id,
														);
									
										if(DB::table('test_questions')->insert($inputData2))
										{
											$test_question_id = DB::getPdo()->lastInsertId();
											
											foreach($data_answers as $key2=>$value4)
											{
												$inputData3 = array(
															'test_question_id' 	=> $test_question_id,
															'answer_id'			=> $value4,
															'order'				=> $key2,
															'test_id'			=> $test_id,
														);
												DB::table('test_answers')->insert($inputData3);									
											}
										}
									}																
								}
							}						
						}
						return \Redirect('/testing')->with('responseData', array('statusCode' => 1, 'message' => 'Tạo bài kiểm tra thành công thành công'));
					}else{
						return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Số lượng câu hỏi không đủ theo yêu cầu.'));
					}
				}else{
					return \Redirect::back()->withInput()->with('responseData', array('statusCode' => 2, 'message' => 'Chọn file muốn trộn.'));
				}
			}
		}
		
		public function troncauhoi($data)				
		{			
			shuffle($data);
			
			return $data;
		}
		
	}
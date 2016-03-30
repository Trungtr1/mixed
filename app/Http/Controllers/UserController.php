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
use Mail;


	class UserController extends Controller {

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
		
		public function baikiemtra(){
			
			$user = Session::get('user');
			
			$viewData['user']=$user;
			
			$get_test = DB::table('tests')->where('user_id',$user['id'])->orderBy('id', 'desc')->get();
			
			$viewData['tests']=$get_test;
			
			return view('folder_test')->with('data',$viewData);
		}
		
		public function storage_test(){
			
			$user = Session::get('user');
			
			$viewData['user']=$user;
			
			$get_test = DB::table('tests')->where('user_id',$user['id'])->orderBy('id', 'desc')->get();
			
			$viewData['tests']=$get_test;
			
			return view('storage_test')->with('data',$viewData);
		}
		
		public function bainop(Request $request){			

			$get_test = DB::table('people_submit')->where('test_id',$request['id'])->get();
			
			$viewData['tests']=$get_test;
			
			return view('submit_test')->with('data',$viewData);
		}
		
		public function sendtest(Request $request)
		{
			
			$error = array();
			
			if ( $request->hasFile('list_email') ) {
				$file = $request->file('list_email');
				if ($file->getClientOriginalExtension() == 'docx' ) {
					$user=Session::get('user');
					
					$fileName = $user['id'].'_'.time().'.docx';
					$file->move(storage_path('docx'), $fileName);

					$emailData = $this->getDataFromText($fileName);

					
										
					foreach($emailData as $email){
						try{
							Mail::send('mail3', array('test_id'=>$request['test_id']), function($message) use($email)
								{
									$message->to($email, null)->subject('Bài kiểm tra gửi qua tronde.vn');
								});
						}catch(\Illuminate\Database\QueryException $e){
							$error[]=$email;
						}
						
					}

					return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thư đã được gửi đến địa chỉ mail vừa nhập'));
					
				} else {
				
					return \Redirect::back()->with('responseData', array('statusCode' => 2, 'message' => 'File tải lên phải là DOCX'));
				
				}
			}else{
				$email = $request['email'];
				
				if(Mail::send('mail3', array('test_id'=>$request['test_id']), function($message) use($email)
						{
							$message->to($email, null)->subject('Bài kiểm tra gửi qua tronde.vn');
						})){
							return \Redirect::back()->with('responseData', array('statusCode' => 1, 'message' => 'Thư đã được gửi đến địa chỉ mail vừa nhập'));
						}else{
							return \Redirect::back()->with('responseData', array('statusCode' => 2, 'message' => 'Có lỗi xảy ra khi gửi bài kiểm tra'));
						}
			}	

		}
		
		function extractText($filename) {
			//Check for extension
			$ext = end((explode('.', $filename)));
		 
			//if its docx file
			if($ext == 'docx')
			$dataFile = "word/document.xml";
			//else it must be odt file
			else
			$dataFile = "content.xml";     
			
			// $image = 'images'
			//Create a new ZIP archive object
			$zip = new \ZipArchive;
		 
			// Open the archive file
			if (true === $zip->open(storage_path('docx/'.$filename))) {
				// If successful, search for the data file in the archive
				if (($index = $zip->locateName($dataFile)) !== false) {
					// Index found! Now read it to a string
					$text = $zip->getFromIndex($index);
					// Load XML from a string
					// Ignore errors and warnings
					$DDCM = new \DOMDocument();
					$DDCM->loadXML($text, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
					// echo $xml;exit();
					// Remove XML formatting tags and return the text
					$xmlContent = strip_tags($DDCM->saveXML(), '<w:p><wp:docPr>');
					
					//Add line break tag
					$xmlContent = str_replace('</w:p>', '<br/></w:p>', $xmlContent);
					return strip_tags($xmlContent, '<br>');
					// return $xmlContent;
				}
				//Close the archive file
				$zip->close();
			}
		 
			// In case of failure return a message
			return "File not found";
		}
		
		function getDataFromText($document) {
			$cleanData = preg_split('/<br\/>/', trim($this->extractText($document)), -1, PREG_SPLIT_NO_EMPTY);

			$strData = str_replace(" ","",trim(implode(' ',$cleanData)));

			$emailData=explode(";",rtrim($strData,';'));

			//Get clean data from docx file			
			
			if( !empty($emailData) ) {
			
				return $emailData;
			
			}
		
			return false;
			
		}
	}
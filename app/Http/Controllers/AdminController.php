<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Session;

	class AdminController extends Controller {
		
		public function index()
		{
			$user = Session::get('user');
			
			$viewData['ql_nguoidung'] = DB::table('users')->get();
			
			$get_question = DB::table('users')
								->select('users.id','questions.id as question_id')
								->join('groups','groups.user_id','=','users.id')
								->join('folders','folders.id','=','groups.folder_id')
								->join('questions','questions.folder_id','=','folders.id')
								->get();
			
			$count_question = array();
			
			foreach($viewData['ql_nguoidung'] as $value1)
			{
				$n=0;
				foreach($get_question as $value2)
				{					
					if($value1['id']==$value2['id'])
					{
						$n++;
						$count_question[$value1['id']]['count'] = $n;
					}
				}			
			}
			
			$viewData['count_question'] = $count_question;

			return view('admin')->with('data',$viewData);
		}
		
	}
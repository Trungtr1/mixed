<?php namespace App\Http\Controllers;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Session;
use File;

	class TestController extends Controller {
		
		public function index(Request $request)
		{
			$user = Session::get('user');
			
			$viewData['user']=$user;
			
			$get_test = DB::table('tests')->where('user_id',$user['id'])->where('status','1')->get();

			foreach($get_test as $gt)
			{
				$viewData['questions'][$gt['id']] = DB::table('test_questions')
										->join('questions','questions.id','=','test_questions.question_id')
										->select('test_questions.id','test_questions.question_id','questions.content')
										->where('test_questions.test_id',$gt['id'])
										->orderBy('id', 'asc')
										->get();
										
				$get_answers = DB::table('test_answers')
											->join('answers','test_answers.answer_id','=','answers.id')
											->select('test_answers.id','test_answers.answer_id','test_answers.order','test_answers.test_question_id','answers.content','answers.correctness')
											->where('test_answers.test_id',$gt['id'])
											->orderBy('id', 'asc')
											->get();
				
				foreach($get_answers as $value)
				{
					$viewData['answers'][$gt['id']][$value['test_question_id']][] = $value;
				}			
											
				foreach($get_answers as $value)
				{
					if($value['correctness']==1)
					{
						$viewData['correct'][$gt['id']][] = $value['order'];
					}
				}
			}
			
			$viewData['tests'] = $get_test;
			
			return view('test')->with('data',$viewData);
		}
		
		public function testing(Request $request)
		{
			$get_test= DB::table('tests')->where('id',$request['id'])->get();

			$viewData['questions'][$request['id']] = DB::table('test_questions')
									->join('questions','questions.id','=','test_questions.question_id')
									->select('test_questions.id','test_questions.question_id','questions.content')
									->where('test_questions.test_id',$request['id'])
									->orderBy('id', 'asc')
									->get();
									
			$get_answers = DB::table('test_answers')
										->join('answers','test_answers.answer_id','=','answers.id')
										->select('test_answers.id','test_answers.answer_id','test_answers.order','test_answers.test_question_id','answers.content','answers.correctness')
										->where('test_answers.test_id',$request['id'])
										->orderBy('id', 'asc')
										->get();
			
			foreach($get_answers as $value)
			{
				$viewData['answers'][$request['id']][$value['test_question_id']][] = $value;
			}			
			
			$viewData['tests'] = $get_test;

			
			return view('testing')->with('data',$viewData);
		}
		
		public function nopbai(Request $request)
		{

			DB::transaction(function ($request) use($request) {	

				$people_submit = array(
								'people_info'=>$request['people_info'],
								'number_questions'=>$request['number_questions'],
								'date'=>date('Y-m-d H:i:s'),
								'test_id'=>$request['test_id'],
				);
				
				DB::table('people_submit')->insert($people_submit);								
				
				$people_id = DB::getPdo()->lastInsertId();
				
				$answers_submit = array();
				
				for($i=0;$i<$request['number_questions'];$i++)
				{
					if(isset($request["question_$i"])){
						
						$answers_submit[] = array(
												'sentence'	=>	$i,
												'choose'	=>	$request["question_$i"],
												'people_id'	=>	$people_id,
											);
					}
				}	

				DB::table('answers_submit')->insert($answers_submit);
			});

			$correct=0;

			$get_test = DB::table('tests')->where('id',$request['test_id'])->get();

			foreach($get_test as $gt)
			{
				$viewData['questions'][$gt['id']] = DB::table('test_questions')
										->join('questions','questions.id','=','test_questions.question_id')
										->select('test_questions.id','test_questions.question_id','questions.content')
										->where('test_questions.test_id',$gt['id'])
										->orderBy('id', 'asc')
										->get();
										
				$get_answers = DB::table('test_answers')
											->join('answers','test_answers.answer_id','=','answers.id')
											->select('test_answers.id','test_answers.answer_id','test_answers.order','test_answers.test_question_id','answers.content','answers.correctness')
											->where('test_answers.test_id',$gt['id'])
											->orderBy('id', 'asc')
											->get();

				foreach($get_answers as $value)
				{
					$viewData['answers'][$gt['id']][$value['test_question_id']][] = $value;
				}	
											
				foreach($get_answers as $value)
				{
					if($value['correctness']==1)
					{
						$viewData['answers_correct'][] = $value['order'];
					}
				}
				
				$viewData['tests'] = $get_test;
				
				for($i=0;$i<$request['number_questions'];$i++){
					
					if($request['question_'.$i]!=''){
						$choose=$request['question_'.$i];
					}else{
						$choose=999;
					}
					
					$viewData['choose'][]=$choose;
					
					if($choose==$viewData['answers_correct'][$i]){
						$correct=$correct+1;					
					}
				}
				
				$viewData['correct']=$correct;
			}

			$viewData['tests'] = $get_test;	
			
			return view('answer')->with('data',$viewData);
		}
		
		public function chambai(Request $request)
		{
			
			
			
			$stored = DB::table('people_submit')
										->join('answers_submit','people_submit.id','=','answers_submit.people_id')
										->where('people_submit.id',$request['id'])
										->get();
										
			$sentence = array();
			
			foreach($stored as $value)
			{
				$sentence[$value['sentence']]=$value['choose'];
			}

			$correct=0;

			$get_test = DB::table('tests')->where('id',$stored[0]['test_id'])->get();

			foreach($get_test as $gt)
			{
				$viewData['questions'][$gt['id']] = DB::table('test_questions')
										->join('questions','questions.id','=','test_questions.question_id')
										->select('test_questions.id','test_questions.question_id','questions.content')
										->where('test_questions.test_id',$gt['id'])
										->orderBy('id', 'asc')
										->get();
										
				$get_answers = DB::table('test_answers')
											->join('answers','test_answers.answer_id','=','answers.id')
											->select('test_answers.id','test_answers.answer_id','test_answers.order','test_answers.test_question_id','answers.content','answers.correctness')
											->where('test_answers.test_id',$gt['id'])
											->orderBy('id', 'asc')
											->get();
				
				foreach($get_answers as $value)
				{
					$viewData['answers'][$gt['id']][$value['test_question_id']][] = $value;
				}			
											
				foreach($get_answers as $value)
				{
					if($value['correctness']==1)
					{
						$viewData['answers_correct'][] = $value['order'];
					}
				}
				
				$viewData['tests'] = $get_test;
				
				for($i=0;$i<$stored[0]['number_questions'];$i++){
					
					if(isset($sentence[$i]) && $sentence[$i]!=''){
						$choose=$sentence[$i];
					}else{
						$choose=999;
					}
					
					$viewData['choose'][]=$choose;
					
					if($choose==$viewData['answers_correct'][$i]){
						$correct=$correct+1;					
					}
				}
				
				$viewData['correct']=$correct;
			}

			$viewData['tests'] = $get_test;	
			
			return view('mark')->with('data',$viewData);
		}
		
		public function download_test(Request $request)
		{
			$user = Session::get('user');
			
			$viewData['user']=$user;
			
			$get_test = DB::table('tests')->where('user_id',$user['id'])->where('status','1')->get();

			foreach($get_test as $gt)
			{
				$viewData['questions'][$gt['id']] = DB::table('test_questions')
										->join('questions','questions.id','=','test_questions.question_id')
										->select('test_questions.id','test_questions.question_id','questions.content')
										->where('test_questions.test_id',$gt['id'])
										->orderBy('id', 'asc')
										->get();
										
				$get_answers = DB::table('test_answers')
											->join('answers','test_answers.answer_id','=','answers.id')
											->select('test_answers.id','test_answers.answer_id','test_answers.order','test_answers.test_question_id','answers.content','answers.correctness')
											->where('test_answers.test_id',$gt['id'])
											->orderBy('id', 'asc')
											->get();
				
				foreach($get_answers as $value)
				{
					$viewData['answers'][$gt['id']][$value['test_question_id']][] = $value;
				}			
											
				foreach($get_answers as $value)
				{
					if($value['correctness']==1)
					{
						$viewData['correct'][$gt['id']][] = $value['order'];
					}
				}
			}
			
			$viewData['tests'] = $get_test;

			return view('download_test')->with('data',$viewData);
		}
	}
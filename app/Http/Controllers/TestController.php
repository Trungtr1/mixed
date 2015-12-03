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
			/*
			echo "<pre>";
			print_r($viewData);
			echo "</pre>";
			exit();*/
			
			return view('test')->with('data',$viewData);
		}
		/*
		public function export_test(Request $request)
		{
			$user = Session::get('user');
			
			$viewData['user']=$user;
			
			$testID =  $request->get('id');
			
			$viewData['tests'] = DB::table('tests')->where('id',$testID)->get();
			
			$viewData['questions'] = DB::table('test_questions')
										->join('questions','questions.id','=','test_questions.question_id')
										->select('test_questions.id','test_questions.question_id','questions.content')
										->where('test_questions.test_id',$testID)
										->orderBy('id', 'asc')
										->get();
										
			$get_answers = DB::table('test_answers')
										->join('answers','test_answers.answer_id','=','answers.id')
										->select('test_answers.id','test_answers.answer_id','test_answers.order','test_answers.test_question_id','answers.content','answers.correctness')
										->where('test_answers.test_id',$testID)
										->orderBy('id', 'asc')
										->get();
			
			foreach($get_answers as $value)
			{
				$viewData['answers'][$value['test_question_id']][] = $value;
			}			
										
			foreach($get_answers as $value)
			{
				if($value['correctness']==1)
				{
					$viewData['correct'][] = $value['order'];
				}
			}
			
			return view('test')->with('data',$viewData);
		}*/
		
		public function answers(Request $request)
		{
			$user = Session::get('user');
			
			$viewData['user']=$user;
			
			$testID =  $request->get('id');
			
			$viewData['tests'] = DB::table('tests')->where('id',$testID)->get();
			
			$viewData['questions'] = DB::table('test_questions')
										->join('questions','questions.id','=','test_questions.question_id')
										->select('test_questions.id','test_questions.question_id','questions.content')
										->where('test_questions.test_id',$testID)
										->orderBy('id', 'asc')
										->get();
										
			$get_answers = DB::table('test_answers')
										->join('answers','test_answers.answer_id','=','answers.id')
										->select('test_answers.id','test_answers.answer_id','test_answers.order','test_answers.test_question_id','answers.content','answers.correctness')
										->where('test_answers.test_id',$testID)
										->orderBy('id', 'asc')
										->get();
			
			foreach($get_answers as $value)
			{
				$viewData['answers'][$value['test_question_id']][] = $value;
			}			
										
			foreach($get_answers as $value)
			{
				if($value['correctness']==1)
				{
					$viewData['correct'][] = $value['order'];
				}
			}
			
			return view('answer')->with('data',$viewData);
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
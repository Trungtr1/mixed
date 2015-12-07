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
		
	}
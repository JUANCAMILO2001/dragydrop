<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index(){
        return view('index');
    }
    public function uploadFile(Request $request){
        $data = array();
        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:png,jpg,jpeg,pdf|max:2048'
        ]);
        if ($validator->fails()){
            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('file');// Error response

        }else{
            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();

            //file upload location
            $location = 'files';

            //upload file
            $file->move($location,$filename);

            //response
            $data['success'] = 1;
            $data['massage'] = 'Uploaded SuccessFully';
        }
        return response()->json($data);

    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class DepartmentController extends Controller
{
    public function index (Request $request) { 
        $result = DB::table('tbldepartments')->get();
        $resultArray = json_decode(json_encode($result), true);
        return response(['status'=>200,'msg'=>['Data successfully'],'data'=>$resultArray]);
    }

    public function view (Request $request) { 
        

        $result = DB::table('user')->limit(1)->get();
        $resultArray = json_decode(json_encode($result), true);
        
        dd($resultArray);
    }
}

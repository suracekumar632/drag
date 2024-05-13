<?php

namespace App\Http\Controllers;

use App\Models\menu;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    public function index(Request $request){
        $data['name'] = Menu::all();
        $data['record'] = Menu::orderBy('sort_id','asc')->get();
        return view('menu',$data);
    }

    public function updateOrder(Request $request){
        if($request->has('ids')){
            $arr = explode(',',$request->input('ids'));
          
            foreach($arr as $sortOrder => $id){
                $menu = Menu::find($id);
                $menu->sort_id = $sortOrder;
                $menu->save();
            }
            return ['success'=>true,'message'=>'Updated'];
        }
    }
}

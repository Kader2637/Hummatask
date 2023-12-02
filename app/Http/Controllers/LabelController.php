<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{

    protected function getLabels($tim_id)
    {
        $label = Label::where('tim_id',$tim_id)->get();
        return response()->json($label);
    }

    protected function deleteLabel($label_id)
    {
        // dd($label_id);
        $label = Label::where('id',$label_id)->delete();
        return response()->json(["message"=>"Berhasil menghapus label"]);
    }

    protected function editLabel(Request $request){

        $validate = $request->validate(
            [
                "text"=> "string|max:15"
            ],
            [

            ]
        );

        $label = Label::where("id",$request->label_id)->first();
        $label->text = $request->text;
        $label->warna_bg = $request->warna_bg;   
        $label->warna_text = $request->warna_text; 
        $label->save();

        return response()->json();  
    }

    protected function createLabel(Request $request)
    {
        $validate = $request->validate(
            [
                "text" => "string|required|max:15",
                "warna_bg"=> "required",
                "warna_text"=> "required",
            ],
            [

            ]
        );


        $label = new Label;
        $label->text = $request->text;
        $label->warna_bg = $request->warna_bg;
        $label->warna_text = $request->warna_text;
        $label->tim_id = $request->tim_id;
        $label->save();   

        return response()->json(["success"=>"Berhasil membuat label"]);
    }
}

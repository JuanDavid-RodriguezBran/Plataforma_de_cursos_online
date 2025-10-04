<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionsController extends Controller
{
    public function index(){
        $sections=Section::all();

        return view('sections.index',['sections'=>$sections]);
    }
    public function create(){
        return view('sections.create');
    }
    public function store(Request $request){
        try{
            $section=new Section();
            $section->name=$request->name;
            $section->description=$request->description;

            $section->save();

            return redirect()->route('sections.index');
        }
       catch(\Exception $ex){
            \Log::error($ex);
       }
       return redirect()->route('sections.index');

    }
}

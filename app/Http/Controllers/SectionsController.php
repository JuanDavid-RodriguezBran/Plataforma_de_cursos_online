<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Support\Facades\Log;

class SectionsController extends Controller
{
    public function index(){
        $sections=Section::all();

        return view('sections.index',['sections'=>$sections]);
    }
    public function create(){
        return view('sections.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:64',
            'description' => 'nullable|max:128',
        ]);

        try{
            $section=new Section();
            $section->name=$validatedData['name'];
            $section->description=$request['description']?? null;

            $section->save();

            return redirect()->route('sections.index');
        }
       catch(\Exception $ex){
            \Log::error($ex);
       }
       return redirect()->route('sections.index');

    }

    public function show(Section $section){
        return view('sections.show', ['section'=>$section]);
    }


    public function edit(Section $section){
        return view('sections.edit',['section'=>$section]);
    }


    public function update(Request $request, Section $section){
        $validatedData=$request->validate([
            'name'=>'required',
            'description'=>'nullable',
        ]);
        try{
            $section->name=$validatedData['name'];
            $section->description=$validatedData['description']?? null;
            $section->save();

            return redirect()->route('sections.index')->with('success','Section updated successfully.');
        }catch (\Exception $ex){
            Log::error($ex);
        }
        return redirect()->route('sections.index')->with('error','Error Updating the section');
    }


    public function destroy(Section $section){
        try{
            $section->delete();
            return redirect()->route('sections.index')->with('success','Section deleted seccesfully');
        }catch(\Exception $ex){
            Log::error($ex);
        }
        return redirect()->route('sections.index')->with('error','Error deleting the section');

    }
}

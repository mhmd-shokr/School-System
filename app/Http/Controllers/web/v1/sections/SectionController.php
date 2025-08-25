<?php

namespace App\Http\Controllers\Web\V1\sections;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(){
        $Grades=Grade::with('sections')->get();
        $list_Grades=Grade::all();
        return view('pages.sections.section',compact('list_Grades','Grades'));
    }

    public function getClasses($id){
        $listClasses=Classroom::where('Grade_id',$id)->pluck('Name_class','id');
        return $listClasses;
    }

    public function store( StoreSectionRequest  $request){
        try{
            $validated= $request->validated();
            $section=new Section();
            $section->Name_section=["ar" => $request->Name_Section_Ar , "en"=>$request->Name_Section_En];
            $section->Grade_id=$request->Grade_id;
            $section->Class_id=$request->Class_id;
            $section->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Sections.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(["errors"=>$e->getMessage()]);
        }
        
    }

    public function update(UpdateSectionRequest $request, $id ){
        try {
        $validated=$request->validated();
        $section=Section::findOrFail($id);
        $section->Name_section=["ar" => $request->Name_Section_Ar , "en"=>$request->Name_Section_En];
        $section->Grade_id=$request->Grade_id;
            $section->Class_id=$request->Class_id;
            if(isset($request->Status)){
                $section->status=1;//active
            }else{
                $section->status =2; //inactive
            }
            $section->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Sections.index');
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(request $request)
    {
    
        Section::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Sections.index');
    }
}

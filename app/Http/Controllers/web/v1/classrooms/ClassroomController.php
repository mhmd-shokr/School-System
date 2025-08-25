<?php 

namespace App\Http\Controllers\Web\V1\classrooms;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassesromRequest;
use App\Http\Requests\UpdateClassesromRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller 
{

  public function index()
  {
    $myClasses=Classroom::all();
    $Grades=Grade::all();
    return view('pages.clssrooms.myClasses',compact('myClasses','Grades'));
  }

  
  public function create()
  {
    
  }

  
  public function store(StoreClassesromRequest $request)
  {
    $listClasses=$request->List_Classes;
    try{
      $validated=$request->validated();
      foreach( $listClasses as  $listClass){
        $myClasses=new Classroom();
        $myClasses->Name_class = ['en' => $listClass['Name_class_en'], 'ar' => $listClass['Name']];        $myClasses->Grade_id=$listClass['Grade_id'];
        $myClasses->save();
      }
      toastr()->success(trans('messages.success'));
      return redirect()->route('classrooms.index');
    }catch(\Exception $e){
      return redirect()->back()->withErrors(["errors"=>$e->getMessage()]);

    }
  }

 
  public function show($id)
  {
    
  }

  public function edit($id)
  {
    
  }

    public function update(UpdateClassesromRequest $request,Classroom $classroom)
  {
    try{
      $validated=$request->validated();
      $classroom->update([
        'Name_class' => [
            'en' => $request->input('Name_class_en'),
            'ar' => $request->input('Name'),
        ],
        'Grade_id' => $request->input('Grade_id'),
    ]);
      toastr()->success(trans('messages.update'));
      return redirect()->route('classrooms.index');
    }catch(\Exception $e){
      return redirect()->back()->withErrors(["errors"=>$e->getMessage()]);
    }
  }

  
  public function destroy($id)
  {
    try{
    $classroom=Classroom::findOrFail($id);
    $classroom->delete();
    toastr()->error(trans('messages.delete'));
    return redirect()->route('classrooms.index');
    }
  catch(\Exception $e){
    return redirect()->back()->withErrors(["errors"=>$e->getMessage()]);
    
  }
}

public function delete_all(Request $request){
  try{
    $deleteAllId=explode(',',$request->delete_all_id);
    Classroom::whereIn('id', $deleteAllId)->delete();
    toastr()->error(trans('messages.delete'));
    return redirect()->route('classrooms.index');
  }
  catch(\Exception $e){
    return redirect()->back()->withErrors(["errors"=>$e->getMessage()]);
    
  }
}

public function filterClassRoom(Request $request){
  $Grades = Grade::all();
  if($request->Grade_id == 'all'){
    $search = Classroom::all();
  }else{
    $search = Classroom::where('Grade_id', $request->Grade_id)->get();

  }
  
  return view('pages.clssrooms.myClasses', compact('Grades'))
        ->with('details', $search);
}

}




<?php 
namespace App\Http\Controllers\Web\V1\Grades;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Exception;
use Illuminate\Http\Request;

class GradeController extends Controller 
{

  
  public function index()
  {
    $grades=Grade::all();
    return view('pages.grades.grades',compact('grades'));
  }

  
  public function create()
  {
    
  }
  public function store(StoreGradeRequest $request)
  {
      try
      {
          $validated= $request->validated();
          $grade= new Grade();
          $grade->Name=["en"=>$request->Name_en,"ar"=>$request->Name_ar];
          $grade->Notes=$request->Notes;
          $grade->save();
          toastr()->success(trans('messages.success'));
          return redirect()->route('grade.index');
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
  public function update( UpdateGradeRequest $request ,Grade $grade)
  {
    try
    {
        $validated= $request->validated();
        $grade->Name=["en"=>$request->Name_en,"ar"=>$request->Name_ar];
        $grade->Notes=$request->Notes;
        $grade->save();
        toastr()->success(trans('messages.update'));
      return redirect()->route('grade.index');
    }catch(\Exception $e) {
      return redirect()->back()->withErrors(["errors"=>$e->getMessage()]);
    }
  }
 
  public function destroy(Request $request,Grade $grade)
  {
    try{
      $myClassesId=Classroom::where('Grade_id',$request->id)->pluck('Grade_id');
      if($myClassesId -> count() == 0){
        $grade->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('grade.index');
      }
      else{
        toastr()->error(trans(key: 'grades_trans.delete_grade_error'));
        return redirect()->route('grade.index');
      }
    }
    catch( \Exception $e){
      return redirect()->back()->withErrors(["errors"=>$e->getMessage()]);
    }
  }
  
}  


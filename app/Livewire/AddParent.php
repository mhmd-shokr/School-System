<?php

namespace App\Livewire;

use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\TypeBlood;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddParent extends Component
{
    public $currentStep= 1;
    public $successMessage = '' ;
    public $catchError = '';

    //father
    public $Email, $Password;
    public $Name_Father, $Name_Father_en;
    public $Job_Father, $Job_Father_en;
    public $National_ID_Father, $Passport_ID_Father, $Phone_Father;
    public $Nationality_Father_id, $Blood_Type_Father_id, $Religion_Father_id;
    public $Address_Father;

//mother
        public  $Name_Mother;           public  $Name_Mother_en;
        public  $Job_Mother;            public  $Job_Mother_en;
        public  $National_ID_Mother;    public  $Passport_ID_Mother;
        public  $Phone_Mother;          public  $Nationality_Mother_id;
        public  $Blood_Type_Mother_id;  public  $Religion_Mother_id;
        public $Address_Mother;

        public function updated($propertyName){
            $this->validateOnly($propertyName,[
                "Email"=>'required|email|unique:my_parents,Email',
                
                "National_ID_Father"=>'required|digits:14',
                "Passport_ID_Father"=>'digits:10',
                "Phone_Father" => ['required','regex:/^01[0-9]{9}$/'],
                "National_ID_Mother"=>'required|digits:14',
                "Passport_ID_Mother"=>'digits:10',
                "Phone_Mother" => ['required','regex:/^01[0-9]{9}$/']
            ]);
        }
    public function firstStepSubmit(){
        $validated = $this->validate([ 
            "Email" => 'required|email|unique:my_parents,Email', 
            "Password" => 'required|min:6', 
            "Name_Father" => 'required|string|min:3', 
            "Name_Father_en" => 'required|string|min:3', 
            "Job_Father" => 'required|string|min:3', 
            "Job_Father_en" => 'required|string|min:3', 
            "National_ID_Father" => 'required|digits:14|unique:my_parents,National_id_father',
            "Passport_ID_Father" => 'nullable|digits:10|unique:my_parents,Passport_id_father', 
            "Phone_Father" => 'required|regex:/^([0-9\s\-\+\(\)]+)$/|min:10', 
            "Nationality_Father_id"=> 'required|integer', 
            "Blood_Type_Father_id" => 'required|integer', 
            "Religion_Father_id" => 'required|integer', 
            "Address_Father" => 'required|string|min:10',
        ]);
        $this->currentStep=2;
    }
    
    public function secondStepSubmit (){
        $validated = $this->validate([ 
            "Name_Mother" => 'required|string|min:3', 
            "Name_Mother_en" => 'required|string|min:3', 
            "Job_Mother" => 'required|string|min:3', 
            "Job_Mother_en" => 'required|string|min:3', 
            "National_ID_Mother" => 'required|digits:14|unique:my_parents,National_id_mother',
            "Passport_ID_Mother" => 'nullable|digits:10|unique:my_parents,Passport_id_mother', 
            "Phone_Mother" => 'required|regex:/^([0-9\s\-\+\(\)]+)$/|min:10', 
            "Nationality_Mother_id"=> 'required|integer', 
            "Blood_Type_Mother_id" => 'required|integer', 
            "Religion_Mother_id" => 'required|integer', 
            "Address_Mother" => 'required|string|min:10',
        ]);
    
        $this->currentStep = 3;
    }
    

    public function back ($step){
        $this->currentStep=$step;
    }

  
    
    public function submitForm(){
        try{
            $myParent = new MyParent();
    
            // father
            $myParent->Email = $this->Email;
            $myParent->Password = Hash::make($this->Password);
            $myParent->Name_father = ['en'=>$this->Name_Father_en,'ar'=>$this->Name_Father];
            $myParent->Job_father  = ['en'=>$this->Job_Father_en,'ar'=>$this->Job_Father];
            $myParent->National_id_father = $this->National_ID_Father;
            $myParent->Passport_id_father = $this->Passport_ID_Father;
            $myParent->Phone_father = $this->Phone_Father;
            $myParent->Nationalities_id_father = $this->Nationality_Father_id;
            $myParent->TypeBlood_id_father = $this->Blood_Type_Father_id;
            $myParent->Religion_id_father = $this->Religion_Father_id;
            $myParent->Address_father = $this->Address_Father;
    
            // mother
            $myParent->Name_mother = ['en'=>$this->Name_Mother_en,'ar'=>$this->Name_Mother];
            $myParent->Job_mother  = ['en'=>$this->Job_Mother_en,'ar'=>$this->Job_Mother];
            $myParent->National_id_mother = $this->National_ID_Mother;
            $myParent->Passport_id_mother = $this->Passport_ID_Mother;
            $myParent->Phone_mother = $this->Phone_Mother;
            $myParent->Nationalities_id_mother = $this->Nationality_Mother_id;
            $myParent->TypeBlood_id_mother = $this->Blood_Type_Mother_id;
            $myParent->Religion_id_mother = $this->Religion_Mother_id;
            $myParent->Address_mother = $this->Address_Mother;
    
            $myParent->save();
    
            $this->successMessage = trans('messages.success');
            $this->clearForm();
            $this->currentStep = 1;
    
        }catch(\Exception $e){
            $this->catchError = $e->getMessage();
        }
    }
    
    public function clearForm()
    {
        $this->Name_Father = '';
        $this->Name_Father_en = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->National_ID_Father = '';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Religion_Father_id = '';
        $this->Address_Father = '';
    
        $this->Name_Mother = '';
        $this->Name_Mother_en = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->National_ID_Mother = '';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Religion_Mother_id = '';
        $this->Address_Mother = '';
    }
    
    public function render()
    {
        
        return view('livewire.add-parent',[
            "Nationalities"=>Nationality::all(),
            "Type_Bloods"=>TypeBlood::all(),
            "Religions"=>Religion::all(),
        ]);
    }

}

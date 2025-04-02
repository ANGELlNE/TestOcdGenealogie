<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonController extends Controller
{

    public function index(){
        $people=Person::with('creator')->get(); 

        return view('people.index', compact('people'));
    }   
    
    public function show($id){
        $person=Person::findOrFail($id);
        $children=$person->children;
        $parents=$person->parents;
        
        return view('people.show', compact('person', 'children', 'parents'));
    }


    public function create(){
        return view('people.create');
    }

    public function store(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_name' => 'nullable',
            'middle_names' => 'nullable',
            'date_of_birth' => 'nullable',
        ]);

        $person=new Person();
        $person->first_name=$request->input('first_name');
        $person->last_name=$request->input('last_name');
        $person->birth_name=$request->input('birth_name');
        $person->middle_names=$request->input('middle_names');
        $person->date_of_birth=$request->input('date_of_birth');
        $person->save();

        return redirect()->route('people.index')->with('success', 'La personne a été créée avec succès.')->with('error', 'La personne n a pas pu être créée.');
    }

}

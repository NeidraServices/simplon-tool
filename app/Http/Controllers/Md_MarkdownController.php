<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Markdown_Markdown;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Md_MarkdownController extends Controller
{
    //
    public function show(){
        $markdowns=Markdown_Markdown::get();
        return $markdowns;
    }
    public function create(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'file'     => 'required',
                'category' => 'required',
                'active'   => 'required',
                
            ],
            [
                'required' => 'Le champ :attribute est requis',
            ]
        );
        if ($validator->fails()) {          
            return response()->json(['error'=>$validator->errors()], 401);                        
        }
        
             
            //store file into document folder
            if($request->hasFile('file')) {
                $fileUploaded  = $validator->validated()['file'];
                $extension     = $fileUploaded->getClientOriginalExtension();
                $file          = time().rand().'.'.$extension;
                $fileUploaded->move(public_path('markdowns'), $file);

                //store your file into database
                $markdown = new Markdown_Markdown();
                $markdown->url = $file;
                $markdown->user_id =Auth::id();
                $markdown->md_category_id= $validator->validated()['category'];
                $markdown->active=$validator->validated()['active'];;
                $markdown->save();  
            }
            
            
              
            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $file
            ]);
  
        
    }

    public function updateActive(Request $request,$id){
        $validator = Validator::make(
            $request->all(),
            [
                'active'      => 'required',
            ],
            [
                'required' => 'Le champ :attribute est requis',
            ]
        );

        $errors = $validator->errors();

        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }      
        
        
        $markdown = Markdown_Markdown::where('id',$id)->first();
        $markdown->active = $validator->validated()['active'];
        $markdown->save();

        return response()->json([
            "success" => true,
            "message" => "Etat modifier",
        ]);
        
    }

    
    public function updateCategory(Request $request,$id){
        $validator = Validator::make(
            $request->all(),
            [
                'category'      => 'required',
            ],
            [
                'required' => 'Le champ :attribute est requis',
            ]
        );

        $errors = $validator->errors();

        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }      
        
        
        $markdown = Markdown_Markdown::where('id',$id)->first();
        $markdown->md_category_id = $validator->validated()['category'];
        $markdown->save();

        return response()->json([
            "success" => true,
            "message" => "Nouvelle categorie",
        ]);
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Md_ArchiveController;
use Illuminate\Http\Request;
use App\Models\Markdown_Markdown;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class Md_MarkdownController extends Controller
{
    //
    public function index($id){
        $markdown = Markdown_Markdown::find($id);
        $data = file_get_contents(public_path('markdowns/'.$markdown->url));
        return response()->json([
            'success' => true,
            'id'=>$markdown->id,
            'text'=>$data,
            'description'=>$markdown->description,
            'title'=>$markdown->title,
            'status'=>$markdown->active,
            'category'=> $markdown->categories(),
        ]);
    }

    public function show(){
        $markdowns=Markdown_Markdown::orderBy('created_at', 'desc')->get();
        return $markdowns;
    }
    // encours:liasin_archive
    public function editMd(Request $request,$id){
        $validator = Validator::make(
            $request->all(),
            [
                'text'      => 'required',
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
        
        $file          = time().rand().'.md';
        Storage::disk('public')->put('markdowns/'.$file, $validator->validated()['text']);

        
        $markdown = Markdown_Markdown::where('id',$id)->first();
        Md_ArchiveController::create($markdown->id,$markdown->url);
        $markdown->url = $file;
        $markdown->save();
        return response()->json([
            "success" => true,
            "message" => "Markdown Editer",
        ]);
    }
    public function create(Request $request){
        
        $validator = Validator::make(

            $request->all(),
            [
                'text'          => 'required',
                'category'      => 'required',
                'description'          => 'required',
                'active'        => 'required',
                'title'         =>  'required',
            ],

            [
                'required' => 'Le champ :attribute est requis',
            ]
        );
        /* dd($request); */
        $errors = $validator->errors();

        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }
                $file          = time().rand().'.md';
                Storage::disk('public')->put('markdowns/'.$file, $validator->validated()['text']);
                    

                //store your file into database
                $markdown = new Markdown_Markdown();
                $markdown->url = $file;
                $markdown->user_id =1;
                $markdown->md_category_id= $validator->validated()['category'];
                $markdown->active=$validator->validated()['active'];
                $markdown->title=$validator->validated()['title'];
                $markdown->description=$validator->validated()['description'];
                $markdown->save();  
            
            
            
              
            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $file
            ]);
  
        
    }
    public function updateDescription(Request $request,$id){
        $validator = Validator::make(
            $request->all(),
            [
                'description'      => 'required',
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
        $markdown->title = $validator->validated()['descrption'];
        $markdown->save();

        return response()->json([
            "success" => true,
            "message" => "Info Markdown mise a jour",
        ]);
        
    }
    public function updateTitle(Request $request,$id){
        $validator = Validator::make(
            $request->all(),
            [
                'title'      => 'required',
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
        $markdown->title = $validator->validated()['title'];
        $markdown->save();

        return response()->json([
            "success" => true,
            "message" => "Info Markdown mise a jour",
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
    //en cours:delete fichier
    public function delete($id){
        $markdown = Markdown_Markdown::where('id',$id)->first();
        $markdown->delete();

        return response()->json([
            "success" => true,
            "message" => "Markdown supprimé",
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

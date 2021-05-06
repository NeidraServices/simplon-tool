<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Markdown_Archive;
use App\Http\Resources\Md_ArchivesResource;

class Md_ArchiveController extends Controller
{
    //
    public static function create($markdownId,$url){
        
        $archive = new Markdown_Archive;
        $archive->url = $url;
        $archive->markdown_id = $markdownId;
        $archive->save();

        return response()->json([
            "success" => true,
            "message" => "Etat modifier",
        ]);
        
    }
    //
    public function show($id){
        $archives = Markdown_Archive::where('markdown_id',$id)->get();
        return Md_ArchivesResource::collection($archives);
    }
}

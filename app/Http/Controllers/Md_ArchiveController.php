<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Markdown_Archive;
use App\Http\Resources\Md_ArchivesResource;

class Md_ArchiveController extends Controller
{
    //
    public static function create($markdownId, $title, $category_id, $url, $description){
        
        $archive = new Markdown_Archive;
        $archive->url = $url;
        $archive->title = $title;
        $archive->category_id = $category_id;
        $archive->description = $description;
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

    public function showMdArchive($id){
        $mdArchives=Markdown_Archive::find($id);
        
        $data = file_get_contents(public_path('markdowns/'.$mdArchives->url));
        return response()->json([
          'archiveMd'    =>  new Md_ArchivesResource($mdArchives),
          'text'        =>  $data,
        ]);
        //return Md_ArchivesResource::collection($mdArchives);
    }
}

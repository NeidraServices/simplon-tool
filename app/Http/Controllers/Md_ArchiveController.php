<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Markdown_Archive;

class Md_ArchiveController extends Controller
{
    //
    public function create($markdownId,$url){
        
        $archive = new Markdown_Archive;
        $markdown->url = $url;
        $markdown->markdown_id = $id;
        $markdown->save();

        return response()->json([
            "success" => true,
            "message" => "Etat modifier",
        ]);
        
    }
}

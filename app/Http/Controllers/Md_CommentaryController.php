<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Markdown_Commentary;


class Md_CommentaryController extends Controller
{
    //
    public function index(Request $request){

        return response()->json("Coucou");
        
    }
    public function create(Request $request){
        
    }

}

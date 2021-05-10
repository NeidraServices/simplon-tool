<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Markdown_Markdown;
use App\Models\Markdown_Commentary;
use Illuminate\Support\Facades\Auth;


class Md_CommentaryController extends Controller
{
    //
    public function index(Request $request, $markdown_id)
    {
        $commentaries = Markdown_Commentary::where('markdowns', $markdown_id)->get();

        return response()->json($commentaries);
    }

    public function store(Request $request, $markdown_id)
    {
        $commentary =  new Markdown_Commentary;
        $commentary->description = $request->get('description');
        $commentary->user_id = Auth::id();
        $commentary->markdown_id = $markdown_id;
        $commentary->save();

        return response()->json(['message' => 'Commentaire bien ajouté']);

    }

}

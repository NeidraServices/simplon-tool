<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Markdown_Category;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Md_CategoryResource;


class Md_CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return Markdown_Category::orderBy('id', 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category = new Markdown_Category([
            'name' => $request->input('name'),
        ]);

        $category->save();
 
        return response()->json('Catégorie bien ajouté');
    }

    function search(Request $request)
    {

        $data = Validator::make(
            $request->input(),
            [
                'query' => 'required|max:255',
            ]
        )->validate();
        
        $categories = Markdown_Category::where('name', 'like', '%' . $data['query'] . '%')->get();

        return Md_CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $category = Markdown_Category::find($id);
        $category->update($request->all());
 
        return response()->json('Catégorie bien mis à jour');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Markdown_Category::find($id);

        $category->delete();
 
        return response()->json('Catégorie bien supprimé');
    }
}

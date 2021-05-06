<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Deliver_Rendu;
use App\Models\Deliver_MediaModel;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Deliver_RenduResource;
use App\Models\Deliver_ProjetModel;

class Deliver_RenduController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rendus()
    {
        $rendus = Deliver_Rendu::all();
        return response()->json(['projets' =>  Deliver_RenduResource::collection($rendus)]);
    }

    /**
     * Selectionner un projet
     *
     * @return \Illuminate\Http\Response
     */
    public function getRendu($id)
    {

        $rendu = Deliver_Rendu::find($id);

        if($rendu) {
            return  new Deliver_RenduResource($rendu);
        }

        return response()->json([
            'success' => false,
            'message' => "Introuvable"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // api/deliver/ajouter/rendu/projets/1
    public function addRendu(Request $request, $projet_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user_id'   => 'required',
                'github_url' => 'string',
                'site_url' => 'string',
                'medias.*' => 'file|nullable|mimes:jpg,jpeg,png|max:5000'
            ],
            [
                'file'  => 'Image non fournis',
                'mimes' => 'Extension invalide',
                'max'   => '5Mb maximum',
            ]
        );

        $errors = $validator->errors();

        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }

        // Vérifier si l'utilisateur fait bien partit du projet
        $projet = Deliver_ProjetModel::find($projet_id);
        $user_id = $validator->validated()['user_id'];
        $all_users_id = [];

        foreach ($projet->users as $user) {
            array_push($all_users_id, $user->pivot->user_id);
        }
        if(!in_array($user_id, $all_users_id)) {
            return response()->json([
                'success' => false,
                'message' => "L'utilisateur ne fait pas partit du projet"
            ]);
        }

        // Ajouter le rendu
        $rendu  = new Deliver_Rendu();
        $rendu->user_id = $request->user_id;
        $rendu->github_url = $validator->validated()['github_url'];
        $rendu->site_url = $validator->validated()['site_url'];
        $rendu->projet_id = $projet_id;
        $rendu->save();

        // S'il y a minimum un média
        if($request->hasfile('medias')) {
            foreach ($request->file('medias') as $file) {
                $name = time() . rand() .'.'.$file->extension();
                $file->move(public_path('images/rendus'), $name);

                $media = new Deliver_MediaModel();
                $media->type = "Type_media";
                $media->lien = "a_supp";
                $media->nom = $name;
                $media->rendu_id = $rendu->id;
                $media->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Rendu créé"
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deliver_Rendu  $deliver_Rendu
     * @return \Illuminate\Http\Response
     */
    public function show(Deliver_Rendu $deliver_Rendu)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deliver_Rendu  $deliver_Rendu
     * @return \Illuminate\Http\Response
     */
    public function edit(Deliver_Rendu $deliver_Rendu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deliver_Rendu  $deliver_Rendu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deliver_Rendu $deliver_Rendu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deliver_Rendu  $deliver_Rendu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deliver_Rendu $deliver_Rendu)
    {
        //
    }
}

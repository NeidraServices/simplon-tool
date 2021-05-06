<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Deliver_Rendu;
use App\Models\Deliver_MediaModel;
use App\Models\Deliver_ProjetModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Deliver_RenduResource;

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

        // Si le rendu appartient à l'utilisateur
        // Décommenter si la partie auth est totalement fonctionnel

        /*
        if($rendu && (Auth::user()->id === $rendu->user_id)) {
            return  new Deliver_RenduResource($rendu);
        }
        */

        // Supprimer si la partie auth est totalement fonctionnel
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
                'medias' => 'nullable',
                'medias.*' => 'file|mimes:jpg,jpeg,png|max:5000'
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
                $media->lien = "/images/rendus/". $name;
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deliver_Rendu  $deliver_Rendu
     * @return \Illuminate\Http\Response
     */
    public function editRendu(Request $request, $rendu_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'github_url' => 'string',
                'site_url' => 'string',
                'medias' => 'nullable',
                'medias.*' => 'file|mimes:jpg,jpeg,png|max:5000'
            ],
            [
                'file'  => 'Image non fournis',
                'mimes' => 'Extension invalide',
                'max'   => '5Mb maximum',
            ]
        );

        // dd($validator->validated());

        $errors = $validator->errors();

        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }


        $rendu = Deliver_Rendu::find($rendu_id);

        if(empty($rendu)) {
            return response()->json([
                'success' => false,
                'message' => "Introuvable"
            ]);
        }

        // Vérifier si l'utilisateur fait bien partit du projet
        /*
        if($rendu == null || (Auth::user()->id != $rendu->user_id)) {
            return response()->json([
                'success' => false,
                'message' => "Introuvable"
            ]);
        }
        */

        $rendu->github_url = $validator->validated()['github_url'];
        $rendu->site_url = $validator->validated()['site_url'];
        $rendu->save();

        $media_data = Deliver_MediaModel::where(['rendu_id' => $rendu_id])->get();

        $old_file_set = [];

        /*
        |
        | Dans le cas où il y a déjà de fichiers enregistrés pour ce rendu
        |
        */
        if(count($media_data) > 0) {
            foreach ($media_data as $key => $media) {
                array_push($old_file_set, $media->nom);
            }

            $new_file_set = [];

            // S'il y a minimum un média
            if($request->hasfile('medias')) {
                foreach ($request->file('medias') as $file) {

                    $filetype = $file->getClientOriginalName();
                    $filename = pathinfo($filetype, PATHINFO_FILENAME);
                    $extension = pathinfo($filetype, PATHINFO_EXTENSION);
                    $full_filename = $filename . '.' . $extension;

                    // Vérifier que le fichier n'existe pas déjà
                    // Si le fichier existe déjà, ne rien faire
                    // Si le fichier n'existe pas, l'ajouter
                    if(!in_array($full_filename, $old_file_set)) {
                        $name = time() . rand() .'.'.$file->extension();
                        $file->move(public_path('images/rendus'), $name);
                        $media = new Deliver_MediaModel();
                        $media->type = "Type_media";
                        $media->lien = "/images/rendus/". $name;
                        $media->nom = $name;
                        $media->rendu_id = $rendu->id;
                        $media->save();
                    }

                    array_push($new_file_set, $full_filename);

                }
            }
            // Si le fichier existant n'est pas fournis à nouveau, le supprimer
            foreach ($old_file_set as $key => $filename) {
                if(!in_array($filename, $new_file_set)) {
                    File::delete(public_path('images/rendus/'. $filename));
                    $media = Deliver_MediaModel::where(['nom' => $filename, 'rendu_id' => $rendu_id])->first();
                    $media->delete();
                }
            }
        }
        else {
            /*
            |
            | Dans le cas où il n'y a pas fichiers enregistrés pour ce rendu
            |
            */
            // S'il y a minimum un média
            if($request->hasfile('medias')) {
                foreach ($request->file('medias') as $file) {
                    $name = time() . rand() .'.'.$file->extension();
                    $file->move(public_path('images/rendus'), $name);
                    $media = new Deliver_MediaModel();
                    $media->type = "Type_media";
                    $media->lien = "/images/rendus/". $name;
                    $media->nom = $name;
                    $media->rendu_id = $rendu->id;
                    $media->save();
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Rendu modifié"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deliver_Rendu  $deliver_Rendu
     * @return \Illuminate\Http\Response
     */
    public function deleteRendu($rendu_id)
    {
        $rendu = Deliver_Rendu::find($rendu_id);

        // Si le rendu appartient à l'utilisateur
        // Décommenter si la partie auth est totalement fonctionnel

        /*
        if($rendu && (Auth::user()->id === $rendu->user_id)) {
            return  new Deliver_RenduResource($rendu);
        }
        */

        // Supprimer si la partie auth est totalement fonctionnel
        if($rendu) {
            $medias = Deliver_MediaModel::where(['rendu_id' => $rendu_id])->get();
            foreach ($medias as $key => $media) {
                File::delete(public_path('images/rendus/'. $media->nom));
                $media->delete();
            }
            $rendu->delete();

            return response()->json([
                'success' => true,
                'message' => "Rendu supprimé"
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Introuvable"
        ]);
    }
}

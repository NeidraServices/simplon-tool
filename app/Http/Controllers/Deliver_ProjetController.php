<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deliver_ProjetModel;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Deliver_ProjetResource;
use App\Models\User;
use DateTime;
use Mockery\Undefined;

class Deliver_ProjetController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Liste des projets
    |--------------------------------------------------------------------------
    */

    /**
     * Liste des projets
     *
     * @return \Illuminate\Http\Response
     */
    public function projets()
    {
        $projets = Deliver_ProjetModel::all();

        foreach($projets as $projet){
            $projet->formateur_id = User::find($projet->formateur_id)->select(['name', 'surname', 'email', 'id'])->get();

            $deadline = new DateTime($projet->deadline);
            $projet->deadline = $deadline->format('Y-m-d');

            if($projet->date_presetation !== null){
                $date_presentation = new DateTime($projet->date_presentation);
                $projet->date_presentation = $date_presentation->format('Y-m-d');
            }
        }
        return response()->json(['projets' =>  $projets]);
    }


    /*
    |--------------------------------------------------------------------------
    | Selectionner un projet
    |--------------------------------------------------------------------------
    */

    /**
     * Selectionner un projet
     *
     * @return \Illuminate\Http\Response
     */
    public function getProjet($id)
    {

        $projet = Deliver_ProjetModel::find($id);

        $affectations = [];
        foreach ($projet->users as $user) {
            $apprenant = User::find($user->pivot->user_id);
            array_push($affectations, $apprenant);
        }

        if($projet) {
            return response()->json([
                'projet' => new Deliver_ProjetResource($projet),
                'apprenants' => $affectations,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Introuvable"
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Ajouter un projet
    |--------------------------------------------------------------------------
    */

    /**
     * Ajouter un projet
     * @return \Illuminate\Http\Response
     */
    public function addProjet(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                "formateur_id" => "required",
                'titre' => 'required',
                'deadline' => 'required',
                'description' => 'required',
                'image' => 'file|mimes:jpg,jpeg,png|max:5000',
            ],
            [
                'file'  => 'Image non fournis',
                'mimes' => 'Extension invalide',
                'max'   => '5Mb maximum'
            ]
        );

        $errors = $validator->errors();

        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }

        $public_img_path = "/public/img/";
        if($request->image){
            $image       =  $request->image;
            $extension   = $image->getClientOriginalExtension();
            $image_name  = time() . rand() . '.' . $extension;
            $image_path  = $public_img_path + "/cover/" + $image_name;
            $image->move(public_path('img/cover'), $image_name);
        }else{
            $image_path = "https://ma.ambafrance.org/IMG/arton11404.png?1565272504";
        }

        $projet = Deliver_ProjetModel::create(array_merge([
            "titre" => $request->titre,
            "formateur" => $request->formateur_id,
            "deadline" => $request->deadline,
            "description" => $request->description,
            "image" => $image_path,
            "formateur_id" => $request->formateur_id
        ]));
        return response()->json([
            'success' => true,
            'message' => "Projet créé"
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Modifier un projet
    |--------------------------------------------------------------------------
    */

    /**
     * Edit cover
     * @return \Illuminate\Http\Response
     */
    public function editProjet(Request $request, $id) {
        $validator = Validator::make(
            $request->all(),
            [
                'titre' => 'required',
                'deadline' => 'required',
                'description' => 'required',
                'image' => 'file|mimes:jpg,jpeg,png|max:5000',
            ],
            [
                'file'  => 'Image non fournis',
                'mimes' => 'Extension invalide',
                'max'   => '5Mb maximum'
            ]
        );

        $errors = $validator->errors();

        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }

        $projet = Deliver_ProjetModel::where(['id' => $id])->first();
        $projet->titre        = $validator->validated()['titre'];
        $projet->deadline     = $validator->validated()['deadline'];
        $projet->description  = $validator->validated()['description'];

        // Pour des raisons de test du backend seulement
        if(array_key_exists("image", $validator->validated())) {
            if ($request->hasFile('image')) {
                $oldImage = $projet->image;

                if ($oldImage != null) {
                    $oldFilePath = public_path('img/cover') . '/' . $oldImage;
                    unlink($oldFilePath);
                }

                $image          = $validator->validated()['cover'];
                $extension      = $image->getClientOriginalExtension();
                $image_name          = time() . rand() . '.' . $extension;
                $image->move(public_path('img/cover'), $image_name);
                $projet->image = $image_name;
            }
        }


        $projet->save();

        return response()->json([
            'success' => true,
            'message' => "Mise à jour effectuée"
        ]);
    }

    /**
     * Supprimer un projet
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteProjet($id)
    {
        $projet=Deliver_ProjetModel::find($id);

        if($projet) {
            $projet->delete();
            return response()->json([
                'success' => true,
                'message' => "Vous avez supprimé le projet"
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "Introuvable"
        ]);
    }
}

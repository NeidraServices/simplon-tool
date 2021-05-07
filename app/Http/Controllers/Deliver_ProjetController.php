<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deliver_ProjetModel;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Deliver_ProjetResource;
use App\Models\Deliver_CompetencesModel;
use App\Models\Deliver_TagModel;
use App\Models\Deliver_UsersModel;
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
            $projet->formateur_id = User::find($projet->formateur_id)->select(['name', 'surname', 'email', 'id'])->first();

            $deadline = new DateTime($projet->deadline);
            $projet->deadline = $deadline->format('Y-m-d');

            if($projet->date_presetation !== null){
                $date_presentation = new DateTime($projet->date_presentation);
                $projet->date_presentation = $date_presentation->format('Y-m-d');
            }
        }
        return response()->json(['projets' =>  $projets]);
    }

    public function mesProjets(){
        $projets = Deliver_UsersModel::with("projets")->whereHas("projets",function($user){
            $user->where("user_id",3);
        })->get();
       return response()->json(['projets' =>  $projets[0]["projets"]]);
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

       // $projet = Deliver_ProjetModel::find($id);
        $projet=Deliver_ProjetModel::with("tags")->where("id",$id)->get();

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
        $validator = Validator::make($request->all(),
            [
                "formateur_id" => "required",
                'titre' => 'required',
                'deadline' => 'required',
                'description' => 'required',
                'competences'  => '',
                'techno'      => ''
            ]
        );
        if($validator->fails()) return response()->json(["success" => false, "error" => $validator->errors()]);

        $projet = Deliver_ProjetModel::create(array_merge([
            "titre" => $request->titre,
            "formateur" => $request->formateur_id,
            "deadline" => $request->deadline,
            "description" => $request->description,
            "formateur_id" => $request->formateur_id,
            "extrait"      => $request->extrait
        ]));

        if($request->all()["competences"]){
            foreach($request->all()["competences"] as $comp){
                $competences=Deliver_CompetencesModel::where("nom",$comp)->get();
                $competences[0]->projets()->attach($competences[0]["id"],["projet_id"=>$projet["id"] ]);
            }
        }
        if($request->all()["techno"]){
            foreach($request->all()["techno"] as $comp){
                $competences=Deliver_TagModel::where("nom",$comp)->get();
                $competences[0]->projets()->attach($competences[0]["id"],["projet_id"=>$projet["id"] ]);
            }
        }
            return response()->json([
                'success' => true,
                'message' => "Projet créé",
                "projet_created" => $projet,
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
                'date_presentation' => 'required',
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
        $projet->date_presentation  = $validator->validated()['date_presentation'];

        // Pour des raisons de test du backend seulement
        if(array_key_exists("image", $validator->validated())) {
            if ($request->hasFile('image')) {
                $oldImage = $projet->image;

                if ($oldImage != null) {
                    $oldFilePath = public_path('images/projets') . '/' . $oldImage;
                    unlink($oldFilePath);
                }

                $image          = $validator->validated()['image'];
                $extension      = $image->getClientOriginalExtension();
                $image_name          = time() . rand() . '.' . $extension;
                $image->move(public_path('images/projets'), $image_name);
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

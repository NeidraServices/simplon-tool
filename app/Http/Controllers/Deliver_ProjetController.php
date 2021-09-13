<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Deliver_ProjetModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Deliver_ProjetResource;
use App\Models\Deliver_CompetencesModel;
use App\Models\Deliver_RendusModel;
use App\Models\Deliver_TagModel;
use App\Models\Deliver_UsersModel;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $projets = Deliver_ProjetModel::with(["tags", "competences"])->get();

        foreach($projets as $projet){
            $projet->formateur_id = User::find($projet->formateur_id)->select(['name', 'surname', 'email', 'id'])->first();

            $deadline = new DateTime($projet->deadline);
            $projet->deadline = $deadline->format('Y-m-d');

            $presentation = new DateTime($projet->date_presentation);
            $projet->date_presentation = $presentation->format('Y-m-d');

            if($projet->date_presetation !== null){
                $date_presentation = new DateTime($projet->date_presentation);
                $projet->date_presentation = $date_presentation->format('Y-m-d');
            }
        }
        return response()->json(['projets' =>  $projets]);
    }

public function getApprenants(){

    $apprenants=Deliver_UsersModel::select(['name', 'surname', 'email', 'id'])->where("role_id",3)->get();

    return response()->json(['data' =>  $apprenants]);
}
    /*
    |--------------------------------------------------------------------------
    | Liste de mes projets
    |--------------------------------------------------------------------------
    */

    /**
     * Liste de mes projets
     *
     * @return \Illuminate\Http\Response
     */
    public function mesProjets($formateur_id = null){
        $user = Auth::user();
        
        if($user->role_id === 2 || $user->id === $formateur_id){
            $projets = Deliver_UsersModel::with("projets")->whereHas("projets", function($user) use($formateur_id){
                $user->where("formateur_id", $formateur_id);
            })->get();
            return response()->json(['projets' =>  $projets[0]["projets"]]);            
        }elseif($user){
            $assignation_projet = DB::table('dp_affectations')->where('user_id', $user->id)->get();
            $mes_projets        = [];
            foreach($assignation_projet as $assign){
                $projet = Deliver_ProjetModel::find($assign->projet_id)->first();
                array_push($mes_projets, $projet);
            }
            return response()->json(['response' => $mes_projets]);
        }else{
            return response()->json(['success' => false, 'erreur' => 'Veuillez vous connecté !']);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Selectionner un projet
    |--------------------------------------------------------------------------
    */

    /**
     * Selectionner un projet
     *
     * @param $id
     * @return JsonResponse
     */
    public function getProjet($id): JsonResponse
    {
        $projet = Deliver_ProjetModel::whereId($id)->with("users", "tags", "competences")->get();

        if(isset($projet)) {
            return response()->json([
                'projet' => $projet,
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
                'titre'        => 'required',
                'deadline'     => 'required',
                'description'  => 'required',
                'date_presentation' => 'required',
                'competences'  => '',
                'technos'      => ''
            ]
        );

        // return $request->technos;
        if($validator->fails()) return response()->json(["success" => false, "error" => $validator->errors()]);

        $projet = Deliver_ProjetModel::create(array_merge([
            "titre"     => $request->titre,
            "formateur" => $request->formateur_id,
            "deadline"  => $request->deadline,
            "description"  => $request->description,
            "formateur_id" => $request->formateur_id,
            "date_presentation" => $request->date_presentation,
            "extrait"           => $request->extrait
        ]));

        return $request->competences;
        if(isset($request->technos)){
            foreach($request->technos as $techno){
                $technologies = Deliver_TagModel::where("nom", $techno)->get();
                // return $technologies;
                $technologies[0]->projets()->attach($technologies[0]["id"], ["projet_id" => $projet["id"] ]);
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
        $validator = Validator::make( $request->all(), [
                "formateur_id" => "required",
                'titre'        => 'required',
                'deadline'     => 'required',
                'description'  => 'required',
                'date_presentation' => 'required',
                'competences'  => '',
                'technos'      => ''

            ], [
                'file'  => 'Image non fournis',
                'mimes' => 'Extension invalide',
                'max'   => '5Mb maximum'
            ]
        );

        if($validator->fails()) return response()->json(['success' => false, 'error' => $validator->errors()]);

        $projet = Deliver_ProjetModel::where(['id' => $id])->first();
        $projet->titre        = $validator->validated()['titre'];
        $projet->deadline     = $validator->validated()['deadline'];
        $projet->description  = $validator->validated()['description'];
        $projet->date_presentation  = $validator->validated()['date_presentation'];
        $projet->extrait = $request->extrait;

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
        $rendus=Deliver_RendusModel::where("projet_id",$id)->get();

    
        $projet->users()->detach();

        foreach($rendus as $rendu){
            $rendu->medias()->delete();
        }
        $projet->rendus()->delete();

        
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

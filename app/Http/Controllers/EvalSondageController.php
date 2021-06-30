<?php

namespace App\Http\Controllers;

use App\Http\Resources\EvalSondageFormateurResource;
use Illuminate\Http\Request;
use App\Models\EvalSondage;
use App\Http\Resources\EvalSondageResource;
use App\Http\Resources\EvalUserAnswerLinesResource;
use App\Models\EvalSondageLines;
use App\Models\EvalUsersAnswerLines;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class EvalSondageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Get data functions
    |--------------------------------------------------------------------------
    */


    /**
     * Retrieve all (formateur)
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDataAll()
    {
        $sondages = EvalSondage::distinct()->get();
        return EvalSondageFormateurResource::collection($sondages);
    }


    /**
     * Retrieve all (connected learners)
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDataSpecific($id)
    {
        $sondages = EvalSondage::where(['user_id' => $id, 'published' => 1, 'accepted' => 1])->get();
        return EvalSondageResource::collection($sondages);
    }


    /**
     * Retrieve specific Sondage (connected learners)
     * 
     * @return \Illuminate\Http\Response
     */
    public function getSpecificSondage($userId, $sondageId)
    {
        $sondages = EvalSondage::where(['id' => $sondageId, 'user_id' => $userId, 'published' => 1, 'accepted' => 1])->first();
        return new EvalSondageResource($sondages);
    }
    /*
    |--------------------------------------------------------------------------
    | Create data functions
    |--------------------------------------------------------------------------
    */


    /**
     * Add data
     * 
     * @return \Illuminate\Http\Response
     */
    public function addData(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'         => "required",
                'lines.*'      => 'required',
                'published'    => 'required',
            ],
            [
                'required' => 'Le champ :attribute est requis',
            ]
        );

        $errors = $validator->errors();
        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }

        $name       =  $validator->validated()['name'];
        $published  =  $validator->validated()['published'];
        $lines      =  $validator->validated()['lines'];

        $apprenants = User::where(["role_id" => 3])->get();

        foreach ($apprenants as $apprenant) {
            $sondage            = new EvalSondage();
            $sondage->name      = $name;
            $sondage->user_id   = $apprenant->id;
            $sondage->accepted  = 1;
            $sondage->published = $published;
            $sondage->save();

            foreach ($lines as $lineInfo) {
                $sondageLine = new EvalSondageLines();
                $sondageLine->sondage_id = $sondage->id;
                $sondageLine->type       = $lineInfo['type'];

                switch ($lineInfo['type']) {
                    case 0:
                        $sondageLine->langage_id  = $lineInfo['content'];
                        break;
                    case 1:
                        $sondageLine->skill_id    = $lineInfo['content'];
                        break;
                    case 2:
                        $sondageLine->question    = $lineInfo['content'];
                        break;
                    default:
                        break;
                }
                $sondageLine->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Sondage ajouté"
        ]);
    }


    /**
     * Proposing data
     * 
     * @return \Illuminate\Http\Response
     */
    public function proposingData(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'         => "required",
                'lines.*'      => 'required',
            ],
            [
                'required' => 'Le champ :attribute est requis',
            ]
        );

        $errors = $validator->errors();
        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }

        $name       =  $validator->validated()['name'];
        $lines      =  $validator->validated()['lines'];

        $sondage            = new EvalSondage();
        $sondage->name      = $name;
        $sondage->user_id   = Auth::id();
        $sondage->save();

        foreach ($lines as $lineInfo) {
            $sondageLine = new EvalSondageLines();
            $sondageLine->sondage_id = $sondage->id;
            $sondageLine->langage_id = $lineInfo['langage_id'] ?? null;
            $sondageLine->skill_id   = $lineInfo['skill_id'];
            $sondageLine->save();
        }

        return response()->json([
            'success' => true,
            'message' => "Sondage ajouté"
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Update data functions
    |--------------------------------------------------------------------------
    */


    /**
     * Update data
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'         => "required",
                'published'    => 'required',
                'lines.*'      => 'required',
            ],
            [
                'required' => 'Le champ :attribute est requis',
            ]
        );

        $errors = $validator->errors();
        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }

        $name        =  $validator->validated()['name'];
        $published   =  $validator->validated()['published'];
        $lines       =  $validator->validated()['lines'];
        
        $sondages    = EvalSondage::where(['name' => $name])->get();
        foreach ($sondages as $sondage) {
            $sondage->name = $name;
            $sondage->published = $published;

            $sondageLine = EvalSondageLines::where(['sondage_id' => $sondage->id])->get();
            foreach ($sondageLine as $line) {
                $line->delete();
            }

            foreach ($lines as $lineInfo) {
                $sondageLineUpdate = new EvalSondageLines();
                $sondageLineUpdate->sondage_id = $sondage->id;
                $sondageLineUpdate->type       = $lineInfo['type'];

                switch ($lineInfo['type']) {
                    case 0:
                        $sondageLineUpdate->langage_id  = $lineInfo['content'];
                        break;
                    case 1:
                        $sondageLineUpdate->skill_id    = $lineInfo['content'];
                        break;
                    case 2:
                        $sondageLineUpdate->question    = $lineInfo['content'];
                        break;
                    default:
                        break;
                }             
                $sondageLineUpdate->save();
            }

            $sondage->save();
        }


        return response()->json([
            'success' => true,
            'message' => "Sondage mis à jour"
        ]);
    }


    /**
     * Update data (Accept proposing)
     * 
     * @return \Illuminate\Http\Response
     */
    public function acceptProposing($id)
    {
        $sondage = EvalSondage::where(['id' => $id])->first();
        if (!$sondage) {
            return response()->json([
                'success' => false,
                'message' => "Sondage introuvable"
            ], 400);
        }
        $sondage->accepted = 1;
        $sondage->save();

        return response()->json([
            'success' => true,
            'message' => "Sondage accepté"
        ]);
    }


    /**
     * Update data (set it to draft mode)
     * 
     * @return \Illuminate\Http\Response
     */
    public function setToDraft($id)
    {
        $sondage = EvalSondage::where(['id' => $id])->first();
        if (!$sondage) {
            return response()->json([
                'success' => false,
                'message' => "Sondage introuvable"
            ], 400);
        }
        $sondage->published = 0;
        $sondage->save();

        return response()->json([
            'success' => true,
            'message' => "Sondage mis à jour"
        ]);
    }


    /**
     * Update data (set it to publish mode)
     * 
     * @return \Illuminate\Http\Response
     */
    public function setToPublish($id)
    {
        $sondage = EvalSondage::where(['id' => $id])->first();
        if (!$sondage) {
            return response()->json([
                'success' => false,
                'message' => "Sondage introuvable"
            ], 400);
        }
        $sondage->published = 1;
        $sondage->save();

        return response()->json([
            'success' => true,
            'message' => "Sondage mis à jour"
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Delete data functions
    |--------------------------------------------------------------------------
    */

    /**
     * Delete data
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteData($name)
    {
        $sondages = EvalSondage::where(['name' => $name])->get();

        foreach ($sondages as $sondage) {
            $sondageLine = EvalSondageLines::where(['sondage_id' => $sondage->id])->get();
            foreach ($sondageLine as $line) {
                $line->delete();
            }

            $sondage->delete();
        }

        return response()->json([
            'success' => true,
            'message' => "Sondage supprimer"
        ]);
    }
    /*
    |--------------------------------------------------------------------------
    | Answer sondage functions
    |--------------------------------------------------------------------------
    */

    /**
     * Answer sondage
     * 
     * @return \Illuminate\Http\Response
     */
    public function answerSondage(Request $request, $id)
    {
        $global = 0;
        $count = 0;
        foreach ($request['lines'] as $line) {
            $answer = new EvalUsersAnswerLines();
            if ($line['answers']) {
                $answer->reponse = $line['answers'];
                $answer->user_id = Auth::id();
                $answer->sondage_line_id = $line['id'];
                $answer->save();
            } else if ($line['note']) {
                $count++;
                $global = $global + $line['note'];
                $answer->note = $line['note'];
                $answer->user_id = Auth::id();
                $answer->sondage_line_id = $line['id'];
                $answer->save();
            }
        }
        if ($global != 0) {
            $globalNote = EvalSondage::where(['id' => 3, 'accepted' => 1, 'published' => 1])->first();
            $globalNote->global_note = round($global / $count, 2);
            $globalNote->save();
        }
        return response()->json([
            'success' => true,
            'message' => "Sondage bien envoyé"
        ]);
    }
    /*
    |--------------------------------------------------------------------------
    | Get Sondage Answers  functions
    |--------------------------------------------------------------------------
    */

    /**
     * Sondage answers 
     * 
     * @return \Illuminate\Http\Response
     */
    public function getNotes($id)
    {
        $notes = EvalUsersAnswerLines::where([['user_id', $id], ['note', '!=', null]])->get();
        return EvalUserAnswerLinesResource::collection($notes);
    }
}

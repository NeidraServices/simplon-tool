<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deliver_CommentairesModel;

class Deliver_CommentairesController extends Controller
{
    //

    public function liste(){
        $com = Deliver_CommentairesModel::with("reponses")->where("commentaire_id", null)->where("projet_id", 1)->get();
        return $com;

    }
}

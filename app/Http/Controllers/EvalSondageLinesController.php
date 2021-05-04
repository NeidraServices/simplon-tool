<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvalSondageLines;
use App\Http\Resources\EvalSondageLinesResource;
use Illuminate\Support\Facades\Validator;

class EvalSondageLinesController extends Controller
{
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
    public function addData(Request $request) {
        
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
    public function updateData(Request $request, $id) {
        
    }


    /*
    |--------------------------------------------------------------------------
    | Delete data functions
    |--------------------------------------------------------------------------
    */


    /**
     * Delete data (one by one)
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteData($id) {
        
    }


    /**
     * Delete data (array selected)
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteDataArray(Request $request) {
        
    }
}

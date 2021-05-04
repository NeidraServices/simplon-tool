<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class EvalCoorteController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Get data functions
    |--------------------------------------------------------------------------
    */


    /**
     * Retrieve all
     * 
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        $coorte = User::all();
        return UserResource::collection($coorte);
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
    public function updateData(Request $request, $id)
    {
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
    public function deleteData($id)
    {
    }


    /**
     * Delete data (array selected)
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteDataArray(Request $request)
    {
    }
}

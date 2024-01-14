<?php

namespace App\Http\Controllers;

use App\Models\Model\LocationFather;
use App\Http\Requests\StoreLocationFatherRequest;
use App\Http\Requests\UpdateLocationFatherRequest;
use Illuminate\Http\Request;
use Validator;
class LocationFatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function storeApi($id_father, $longitude, $latitude, $type)
    {
        $location_father = new LocationFather();
        $location_father->id_father = $id_father;
        $location_father->longitude = $longitude;
        $location_father->latitude = $latitude;
        $location_father->type = $type;
        $location_father->save();
        

    }

    public function updateLocationFatherApi(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'longitude' => 'required',
            'latitude' => 'required',
            'type' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false, 'message'=>$validator->errors()]);       
        }

        try {
            //code...
            $location_father = LocationFather::where('id_father', Auth()->user()->id)->where('type', $request->type)->first();
            $location_father->longitude = $request->longitude;
            $location_father->latitude = $request->latitude;
            $isSave = $location_father->save();
            if($isSave){
                return response()->json(['status'=>true, 'message_en'=>'LocationFather updated successfully', 'message_ar'=>'تم تحديث الموقع بنجاح']);
            }
            return response()->json(['status'=>false, 'message_en'=>'LocationFather not updated', 'message_ar'=>'لم يتم تحديث الموقع']);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>false, 'message_en'=>'LocationFather not updated', 'message_ar'=>'لم يتم تحديث الموقع', 'error'=>$th->getMessage()]);

        }
       

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocationFatherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationFatherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\LocationFather  $locationFather
     * @return \Illuminate\Http\Response
     */
    public function show(LocationFather $locationFather)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\LocationFather  $locationFather
     * @return \Illuminate\Http\Response
     */
    public function edit(LocationFather $locationFather)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocationFatherRequest  $request
     * @param  \App\Models\Model\LocationFather  $locationFather
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationFatherRequest $request, LocationFather $locationFather)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\LocationFather  $locationFather
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationFather $locationFather)
    {
        //
    }
}

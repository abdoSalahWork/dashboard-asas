<?php

namespace App\Http\Controllers;

use App\Models\Model\Setting_languege;
use App\Models\Model\Company_data;
use App\Http\Requests\StoreSetting_languegeRequest;
use App\Http\Requests\UpdateSetting_languegeRequest;

class SettingLanguegeController extends Controller
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

    public function showApi(){
        $setting_langueges = Setting_languege::all();
        return response()->json($setting_langueges);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSetting_languegeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSetting_languegeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Setting_languege  $setting_languege
     * @return \Illuminate\Http\Response
     */
    public function show(Setting_languege $setting_languege)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Setting_languege  $setting_languege
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting_languege $setting_languege)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSetting_languegeRequest  $request
     * @param  \App\Models\Model\Setting_languege  $setting_languege
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSetting_languegeRequest $request, Setting_languege $setting_languege)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Setting_languege  $setting_languege
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting_languege $setting_languege)
    {
        //
    }
}

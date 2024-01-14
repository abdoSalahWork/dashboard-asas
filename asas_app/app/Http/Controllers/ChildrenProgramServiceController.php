<?php

namespace App\Http\Controllers;

use App\Models\Model\Children_program_service;
use App\Http\Requests\StoreChildren_program_serviceRequest;
use App\Http\Requests\UpdateChildren_program_serviceRequest;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

class ChildrenProgramServiceController extends Controller
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

    public function getChildrenProgramService($id_children_program){
        $children_program_service = DB::table('service_mores AS servMor')
            ->join('children_program_services AS chilProgSer', 'servMor.id', '=', 'chilProgSer.id_service')
            ->select('servMor.*')
            ->where('chilProgSer.id_child_program', $id_children_program)
            ->get();
            
        return $children_program_service;
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

    public function storeWithChildProgram($id_child_program, $id_service){
        try {
            //code...
            $children_program_service = new Children_program_service();
            $children_program_service->id_child_program = $id_child_program;
            $children_program_service->id_service = $id_service;
            $isSave = $children_program_service->save();
            if($isSave)
                return response()->json(['status'=>true, 'message_en'=>'Successfully added', 'message_ar'=>'تمت الاضافة بنجاح'], 200);
            else
                return response()->json(['status'=>false, 'message_en'=>'Failed to add', 'message_ar'=>'فشلت الاضافة'], 401);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>false, 'message_en'=>'Failed to add', 'message_ar'=>'فشلت الاضافة', 'error'=>$th->getMessage()], 401);
        }
    


    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChildren_program_serviceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChildren_program_serviceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Children_program_service  $children_program_service
     * @return \Illuminate\Http\Response
     */
    public function show(Children_program_service $children_program_service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Children_program_service  $children_program_service
     * @return \Illuminate\Http\Response
     */
    public function edit(Children_program_service $children_program_service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChildren_program_serviceRequest  $request
     * @param  \App\Models\Model\Children_program_service  $children_program_service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChildren_program_serviceRequest $request, Children_program_service $children_program_service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Children_program_service  $children_program_service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Children_program_service $children_program_service)
    {
        //
    }
}

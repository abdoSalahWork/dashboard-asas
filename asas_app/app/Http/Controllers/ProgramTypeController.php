<?php

namespace App\Http\Controllers;

use App\Models\Model\Program_type;
use App\Http\Requests\StoreProgram_typeRequest;
use App\Http\Requests\UpdateProgram_typeRequest;
use Illuminate\Http\Request;

class ProgramTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $program_types = Program_type::orderBy('id', 'DESC')->get();
        return view('admin.program_type.main', compact('program_types'));
    }

    public function showApi(){
        $program_type = Program_type::where('is_deleted','0')->orderBy('id', 'DESC')->get();
        return response()->json([
            'status' => true,
            'data' => $program_type
        ]);
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
     * @param  \App\Http\Requests\StoreProgram_typeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = request()->validate([
            'program_type_en' => 'required|string|max:255',
            'program_type_ar' => 'required|string|max:255',
        ]);

        $program_type = new Program_type();
        $program_type->program_type_en = $request->program_type_en;
        $program_type->program_type_ar = $request->program_type_ar;
        $isSave = $program_type->save();
        if($isSave)
            return back()->with('success', 'تم الاضافة بنجاح');
          
        return back()->with('error', 'حدث خطأ ما');    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Program_type  $program_type
     * @return \Illuminate\Http\Response
     */
    public function show(Program_type $program_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Program_type  $program_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Program_type $program_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProgram_typeRequest  $request
     * @param  \App\Models\Model\Program_type  $program_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = request()->validate([
            'program_type_en' => 'required|string|max:255',
            'program_type_ar' => 'required|string|max:255',
        ]);

        $program_type = Program_type::find($id);
        $program_type->program_type_en = $request->program_type_en;
        $program_type->program_type_ar = $request->program_type_ar;
        $isSave = $program_type->save();
        if($isSave)
            return back()->with('success', 'تم التعديل بنجاح');
          
        return back()->with('error', 'حدث خطأ ما');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Program_type  $program_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $program_type = Program_type::find($id);
        if($program_type->is_deleted == 0){
            $program_type->is_deleted = 1;
            $isSave = $program_type->save();
            if($isSave)
                return back()->with('success', 'تم الحذف بنجاح');
        }else{
            $program_type->is_deleted = 0;
            $isSave = $program_type->save();
            if($isSave)
                return back()->with('success', 'تم الاعادة بنجاح');
        }
    }
}

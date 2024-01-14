<?php

namespace App\Http\Controllers;

use App\Models\Model\Curriculum_types;
use App\Http\Requests\StoreCurriculum_typesRequest;
use App\Http\Requests\UpdateCurriculum_typesRequest;
use Illuminate\Http\Request;
use Validator;
class CurriculumTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curriculum_types = Curriculum_types::orderBy('id','desc')->get();
        return view('admin.curriculum_types.main', compact('curriculum_types'));
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

    public function showApi(){
        try {
            //code...
            $curriculum_types = Curriculum_types::where('is_deleted','0')->orderBy('id','desc')->get();
            return response()->json([
                'status' => true,
                'data' => $curriculum_types
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message_en' => 'Error al obtener los datos',
                'meesage_ar' => 'خطأ في الحصول على البيانات',
                'err' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCurriculum_typesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = request()->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $curriculum_type = new Curriculum_types();
        $curriculum_type->name_en = $request->name_en;
        $curriculum_type->name_ar = $request->name_ar;
        $isSave = $curriculum_type->save();
        if($isSave)
            return back()->with('success', 'تم الاضافة بنجاح');
        return back()->with('error', 'حدث خطأ ما');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Curriculum_types  $curriculum_types
     * @return \Illuminate\Http\Response
     */
    public function show(Curriculum_types $curriculum_types)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Curriculum_types  $curriculum_types
     * @return \Illuminate\Http\Response
     */
    public function edit(Curriculum_types $curriculum_types)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCurriculum_typesRequest  $request
     * @param  \App\Models\Model\Curriculum_types  $curriculum_types
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = request()->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);

        $curriculum_type = Curriculum_types::find($id);
        $curriculum_type->name_en = $request->name_en;
        $curriculum_type->name_ar = $request->name_ar;
        $isSave = $curriculum_type->save();
        if($isSave)
            return back()->with('success', 'تم التعديل بنجاح');
        return back()->with('error', 'حدث خطأ ما');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Curriculum_types  $curriculum_types
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curriculum_type = Curriculum_types::find($id);
        if($curriculum_type->is_deleted == 0)
            $curriculum_type->is_deleted = 1;
        else
            $curriculum_type->is_deleted = 0;
              
        $isSave = $curriculum_type->save();
        if($isSave)
            return back()->with('success', 'تم الحذف بنجاح');
        return back()->with('error', 'حدث خطأ ما');
    }
}

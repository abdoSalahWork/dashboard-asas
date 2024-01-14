<?php

namespace App\Http\Controllers;

use App\Models\Model\Time_type;
use App\Http\Requests\StoreTime_typeRequest;
use App\Http\Requests\UpdateTime_typeRequest;
use Illuminate\Http\Request;
class TimeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $time_types = Time_type::where('is_deleted','0')->orderBy('id', 'DESC')->get();
        return view('admin.time_type.main', compact('time_types'));
    }

    public function showApi()
    {
        $time_types = Time_type::where('is_deleted','0')->orderBy('id', 'DESC')->get();
        return response()->json([
            'status' => true,
            'data' => $time_types
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
     * @param  \App\Http\Requests\StoreTime_typeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = request()->validate([
            'time_type_en' => 'required|string|max:255',
            'time_type_ar' => 'required|string|max:255',
        ]);
        
        $time_type = new Time_type();
        $time_type->time_type_en = $request->time_type_en;
        $time_type->time_type_ar = $request->time_type_ar;
        $isSave = $time_type->save();
        if($isSave)
            return back()->with('success', 'تم الاضافة بنجاح');

        return back()->with('error', 'حدث خطأ ما');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Time_type  $time_type
     * @return \Illuminate\Http\Response
     */
    public function show(Time_type $time_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Time_type  $time_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Time_type $time_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTime_typeRequest  $request
     * @param  \App\Models\Model\Time_type  $time_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = request()->validate([
            'time_type_en' => 'required|string|max:255',
            'time_type_ar' => 'required|string|max:255',
        ]);
        
        $time_type = Time_type::find($id);
        $time_type->time_type_en = $request->time_type_en;
        $time_type->time_type_ar = $request->time_type_ar;
        $isSave = $time_type->save();
        if($isSave)
            return back()->with('success', 'تم التعديل بنجاح');

        return back()->with('error', 'حدث خطأ ما');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Time_type  $time_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $time_type = Time_type::find($id);
        if($time_type->is_deleted == 0){
            $time_type->is_deleted = 1;
            $isSave = $time_type->save();
            if($isSave)
                return back()->with('success', 'تم الحذف بنجاح');
        }else{
            $time_type->is_deleted = 0;
            $isSave = $time_type->save();
            if($isSave)
                return back()->with('success', 'تم الاعادة بنجاح');
        }

    }
}

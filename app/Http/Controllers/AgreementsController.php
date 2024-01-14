<?php

namespace App\Http\Controllers;

use App\Models\Model\Agreements;
use App\Http\Requests\StoreAgreementsRequest;
use App\Http\Requests\UpdateAgreementsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;   
class AgreementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agreements = Agreements::where('is_deleted','0')->orderBy('id','desc')->paginate(9);
        return view('admin.agreements.main', compact('agreements'));
    }

    public function showApi(){
        try {
            //code...
            $agreements = Agreements::where('is_deleted','0')->orderBy('id','desc')->paginate(10);
            return response()->json([
                'status'=>true,
                'data' => $agreements,
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status'=>false,
                'message' => $th->getMessage()
            ], 500);
        }
       

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agreements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAgreementsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required',
            'short_description_en' => 'required',
            'short_description_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $agreements = new Agreements;
        $agreements->name_en = $request->name_en;
        $agreements->name_ar = $request->name_ar;
        $agreements->short_description_en = $request->short_description_en;
        $agreements->short_description_ar = $request->short_description_ar;
        $agreements->description_en = $request->description_en;
        $agreements->description_ar = $request->description_ar;
        $isSave = $agreements->save();
        if($isSave)
            return back()->with('success', 'تم اضافة الاتقاية بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Agreements  $agreements
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agreement = Agreements::find($id);
        return view('admin.agreements.single', compact('agreement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Agreements  $agreements
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agreement = Agreements::find($id);
        return view('admin.agreements.update', compact('agreement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAgreementsRequest  $request
     * @param  \App\Models\Model\Agreements  $agreements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required',
            'short_description_en' => 'required',
            'short_description_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $agreements = Agreements::find($id);
        $agreements->name_en = $request->name_en;
        $agreements->name_ar = $request->name_ar;
        $agreements->short_description_en = $request->short_description_en;
        $agreements->short_description_ar = $request->short_description_ar;
        $agreements->description_en = $request->description_en;
        $agreements->description_ar = $request->description_ar;
        $isSave = $agreements->save();
        if($isSave)
            return back()->with('success', 'تم تعديل الاتقاية بنجاح');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Agreements  $agreements
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agreement = Agreements::find($id);
        if($agreement->is_deleted == 1){
            $agreement->is_deleted = 0;
        }else{
            $agreement->is_deleted = 1;

        }
        $isDelete = $agreement->save();
        if($isDelete)
            return redirect('/admin/agreement')->with('success', 'تم حذف الاتقاية بنجاح');
            
        return back()->with('faild', 'حدث خطأ أثناء حذف الاتقاية');    
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Model\Company_type;
use App\Http\Requests\StoreCompany_typeRequest;
use App\Http\Requests\UpdateCompany_typeRequest;
use Illuminate\Http\Request;
use Validator;
class CompanyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_types = Company_type::orderBy('sort', 'asc')->get();
        return view('admin.company_type.main', compact('company_types'));
    }

    public function showApi(){
        $company_type = Company_type::orderBy('sort', 'asc')->get();
        return response()->json(['status'=>true, 'data'=>$company_type]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompany_typeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \validator($request->all())->validate([
            'type_name_en' => 'required|string|max:255',
            'type_name_ar' => 'required|string|max:255',
            'icon' => 'required|string',
            'sort' => 'required|numeric',
        ]);
        $company_type = new Company_type();
        $company_type->type_name_en = $request->type_name_en;
        $company_type->type_name_ar = $request->type_name_ar;
        $company_type->sort = $request->sort;

        if ($request->file('icon')) {
            $file = $request->file('icon');
            $icon = time().$file->getClientOriginalName();
            $icon = trim($icon, ' ');
            $file->move('assets/image/company_type/',$icon);
            $company_type->icon = $icon;
    
}else{
    $company_type->icon = "null";

}


        $isSave = $company_type->save();
        if($isSave)
            return back()->with('success', 'تم اضافة النوع بنجاح');
         return \back()->with('faild', 'لم يتم اضافة النوع بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Company_type  $company_type
     * @return \Illuminate\Http\Response
     */
    public function show(Company_type $company_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Company_type  $company_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Company_type $company_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompany_typeRequest  $request
     * @param  \App\Models\Model\Company_type  $company_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \validator($request->all())->validate([
            'type_name_en' => 'required|string|max:255',
            'type_name_ar' => 'required|string|max:255',
            'sort' => 'required|numeric',
        ]);
        $company_type = Company_type::find($id);
        $company_type->type_name_en = $request->type_name_en;
        $company_type->type_name_ar = $request->type_name_ar;
        $company_type->sort = $request->sort;
        if($request->icon){
            $file = $request->file('icon');
            $icon = time().$file->getClientOriginalName();
            $icon = trim($icon, ' ');
            $file->move('assets/image/company_type/',$icon);
            $company_type->icon = $icon;
        }
            
        $isSave = $company_type->save();
        if($isSave)
            return back()->with('success', 'تم تعديل النوع بنجاح');
         return \back()->with('faild', 'لم يتم تعديل النوع بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Company_type  $company_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //code...
            $company_type = Company_type::find($id);
            $isDelete = $company_type->delete();
            if($isDelete)
                return back()->with('success', 'تم حذف النوع بنجاح');
             return \back()->with('faild', 'لم يتم حذف النوع بنجاح');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('faild', $th->getMessage());
        }
     
    }
}

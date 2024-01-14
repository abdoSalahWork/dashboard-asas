<?php

namespace App\Http\Controllers;

use App\Models\Model\Fahter_children;
use App\Http\Requests\StoreFahter_childrenRequest;
use App\Http\Requests\UpdateFahter_childrenRequest;
use App\Models\Model\Media;
use Illuminate\Http\Request;
use Validator;

class FahterChildrenController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFahter_childrenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFahter_childrenRequest $request)
    {
        //
    }
    public function storeApi(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_father' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false, 'message_en'=>'Please fill in all the data', 'message_ar'=>'الرجاء تعبئة جميع البيانات' ,'error'=>$validator->errors()], 401);
        }
        try {
            //code...
            $fahter_children = new Fahter_children();
            $fahter_children->id_father = auth()->user()->id;
            $fahter_children->name = $request->name;
            $fahter_children->name_father = $request->name_father;
            $fahter_children->date_of_birth = $request->date_of_birth;
            $fahter_children->gender = $request->gender;
            if($request->nationality)
                $fahter_children->nationality = $request->nationality;
         
            if($request->country_of_residence)
                $fahter_children->country_of_residence = $request->country_of_residence;
    
            if($request->id_curriculum_type)
                $fahter_children->id_curriculum_type = $request->id_curriculum_type;
                
            if($request->current_academic_certificates)
                $fahter_children->current_academic_certificates = $request->current_academic_certificates;      
                
            if($request->sports_of_interest)
                $fahter_children->sports_of_interest = $request->sports_of_interest;
                
            if($request->artistic_activities_of_interest)
                $fahter_children->artistic_activities_of_interest = $request->artistic_activities_of_interest;  
    
            if($request->religious_activities_of_interest)
                $fahter_children->religious_activities_of_interest = $request->religious_activities_of_interest;  
    
             $isSave = $fahter_children->save();
             if($isSave){
                //upload img
                //صور الشهادات الحالية
                if($request->file("img")){
                    foreach($request->file("img") as $file){
                        $img = time().$file->getClientOriginalName();
                        $img = trim($img, ' ');
                        $file->move('assets/image/children/',$img);
                        $media = new Media();
                        $media->media = $img;
                        $media->id_ = $fahter_children->id;
                        $media->table_name = "children";
                        $media->save();
                    }
                }
                 return response()->json(['status'=>true, 'data'=>$fahter_children]);
             }
            return response()->json(['status'=>false, "message_en"=>"Error insert data", "message_ar"=>"حدث خطأ في اضافة البيانات"]);  
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>false, "message_en"=>"Error insert data", "message_ar"=>"حدث خطأ في اضافة البيانات", 'error'=>$th->getMessage()]);
        }
     

    }

    public function myChildren(){
        try {
            //code...
            $children = Fahter_children::where('id_father', auth()->user()->id)->where('is_deleted',0)->get();
            return response()->json(['status'=>true, 'data'=>$children]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>false, "message_en"=>"Error show data", "message_ar"=>"حدث خطأ في عرض البيانات", 'error'=>$th->getMessage()]);
        }
        
    }

    public function singleApi($id){
        try {
            //code...
            $children = Fahter_children::where('id', $id)->first();
            $media = Media::where('id_', $id)->where('table_name', 'children')->get();
            return response()->json(['status'=>true, 'data'=>$children, 'media'=>$media]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>false, "message_en"=>"Error show data", "message_ar"=>"حدث خطأ في عرض البيانات", 'error'=>$th->getMessage()]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Fahter_children  $fahter_children
     * @return \Illuminate\Http\Response
     */
    public function show(Fahter_children $fahter_children)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Fahter_children  $fahter_children
     * @return \Illuminate\Http\Response
     */
    public function edit(Fahter_children $fahter_children)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFahter_childrenRequest  $request
     * @param  \App\Models\Model\Fahter_children  $fahter_children
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFahter_childrenRequest $request, Fahter_children $fahter_children)
    {
        //
    }
    public function updateApi(Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_father' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false, 'message_en'=>'Please fill in all the data', 'message_ar'=>'الرجاء تعبئة جميع البيانات' ,'error'=>$validator->errors()], 401);
        }
        try {
            //code...
            $fahter_children = Fahter_children::find($id);
            if(Auth()->user()->id != $fahter_children->id_father)
                return response()->json(['status'=>false, "message_en"=>"You are not authorized to update this data", "message_ar"=>"ليس لديك صلاحية لتعديل هذه البيانات"]);

            $fahter_children->name = $request->name;
            $fahter_children->name_father = $request->name_father;
            $fahter_children->date_of_birth = $request->date_of_birth;
            $fahter_children->gender = $request->gender;
            if($request->nationality)
                $fahter_children->nationality = $request->nationality;
         
            if($request->country_of_residence)
                $fahter_children->country_of_residence = $request->country_of_residence;
    
            if($request->id_curriculum_type)
                $fahter_children->id_curriculum_type = $request->id_curriculum_type;
                
            if($request->current_academic_certificates)
                $fahter_children->current_academic_certificates = $request->current_academic_certificates;      
                
            if($request->img){
                $file = $request->file('img');
                $img = time().$file->getClientOriginalName();
                $img = trim($img, ' ');
                $file->move('assets/image/programs/',$img);
                $fahter_children->img = $img;    
            }
    
            if($request->sports_of_interest)
                $fahter_children->sports_of_interest = $request->sports_of_interest;
                
            if($request->artistic_activities_of_interest)
                $fahter_children->artistic_activities_of_interest = $request->artistic_activities_of_interest;  
    
            if($request->religious_activities_of_interest)
                $fahter_children->religious_activities_of_interest = $request->religious_activities_of_interest;  
    
             $isSave = $fahter_children->save();
             if($isSave)
                return response()->json(['status'=>true, 'data'=>$fahter_children]);
            return response()->json(['status'=>false, "message_en"=>"Error update data", "message_ar"=>"حدث خطأ في تعديل البيانات"]);  
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>false, "message_en"=>"Error update data", "message_ar"=>"حدث خطأ في تعديل البيانات", 'error'=>$th->getMessage()]);
        }
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Fahter_children  $fahter_children
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fahter_children $fahter_children)
    {
        //
    }
    public function destroyApi($id){
        try {
            //code...
            $fahter_children = Fahter_children::find($id);
            if(Auth()->user()->id != $fahter_children->id_father)
                return response()->json(['status'=>false, "message_en"=>"You are not authorized to delete this data", "message_ar"=>"ليس لديك صلاحية لحذف هذه البيانات"]);

             if($fahter_children->is_deleted == 1){
                 $fahter_children->is_deleted = 0;
                $message_en = "Data restored successfully";
                $message_ar = "تمت استعادة البيانات بنجاح";
            }else{
                $fahter_children->is_deleted = 1;
                $message_en = "Data deleted successfully";
                $message_ar = "تم حذف البيانات بنجاح";
            }

            $isSave = $fahter_children->save();
            if($isSave)
                return response()->json(['status'=>true, 'message_en'=>$message_en, 'message_ar'=>$message_ar]);
            return response()->json(['status'=>false, "message_en"=>"Error delete data", "message_ar"=>"حدث خطأ في حذف البيانات"]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>false, "message_en"=>"Error delete data", "message_ar"=>"حدث خطأ في حذف البيانات", 'error'=>$th->getMessage()]);
        }



    }
}

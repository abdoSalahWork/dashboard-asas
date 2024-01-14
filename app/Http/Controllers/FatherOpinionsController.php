<?php

namespace App\Http\Controllers;

use App\Models\Model\Father_opinions;
use App\Http\Requests\StoreFather_opinionsRequest;
use App\Http\Requests\UpdateFather_opinionsRequest;
use Illuminate\Http\Request;
use Validator;
use App\Models\Model\Children_program;
use Illuminate\Support\Facades\DB;

class FatherOpinionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    //عرض الاراء الجديدة
    public function index()
    {
        try {
            //code...
            $opinions = DB::table('father_opinions')
                ->join('fathers', 'fathers.id', '=', 'father_opinions.id_father')
                ->join('facility_owners', 'facility_owners.id', '=', 'father_opinions.id_company')
                ->select('father_opinions.*', 'fathers.name as father_name', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
                ->where('father_opinions.is_deleted', '1')
                ->paginate(10);
            return view('admin.opinions.main', compact('opinions'));
        } catch (\Throwable $th) {
            //throw $th;
            return \back()->with('error', $th->getMessage());
        }
    }
    //ارسال رأي
    public function sendOpinions(Request $request){
        $validator = Validator::make($request->all(), [
            'id_company' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            //code...
            //عشان اتاكد الي هيضيف رأي يكون حاجز في هذه المؤسسة اولا
            // $id_fatehr = \auth()->user()->id;
            // $is_children_program = DB::select("SELECT * FROM children_programs AS child_prog
            //     INNER JOIN company_datas AS company ON company.id = $request->id_company
            //     INNER JOIN programs AS program ON company.id_facility_owner = program.id_facility_owner
                
            //     INNER JOIN fahter_childrens AS fath_child ON fath_child.id_father = $id_fatehr
            //     WHERE child_prog.id_child = fath_child.id AND child_prog.id_program = program.id
            // ");
            // if(count($is_children_program) == 0)
            //     return \response()->json(['status'=>false, 'message_ar'=>'لايمكنك اذا الرأي لأي طفل غير مسجل لهذه المؤسسة', 'message_en'=>'You can not send this opinion to any child not registered in this company'], 401);

            $father_opinions = new Father_opinions;
            $father_opinions->id_company = $request->id_company;
            $father_opinions->id_father = auth()->user()->id;
            $father_opinions->opinion = $request->opinion;
            $father_opinions->is_deleted = 1;
            $isSave = $father_opinions->save();
            if($isSave){
                return \response()->json(['status'=>true, 'meessage_ar'=>'تم ارسال الرأي بنجاح', 'message_en'=>'Opinion sent successfully']);
            }
             return \response()->json(['status'=>false, 'meessage_ar'=>'حدث خطأ ما', 'message_en'=>'Error']);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json(['status'=>false, 'meessage_ar'=>'حدث خطأ ما', 'message_en'=>'Error', 'error'=>$th->getMessage()]);
        }
        
            
    }

    public function getOpinions($id_company){
        try {
            //code...
            $opinions = DB::table('father_opinions')
                ->join('fathers', 'fathers.id', '=', 'father_opinions.id_father')
                ->select('father_opinions.*', 'fathers.name as father_name')
                ->where('father_opinions.id_company', $id_company)
                ->paginate(10);
            return \response()->json(['status'=>true, 'data'=>$opinions]);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json(['status'=>false, 'message_ar'=>'حدث خطأ ما', 'message_en'=>'Error', 'error'=>$th->getMessage()]);
        }
        

    }


    public function getOpinios2($id_company){
        $opinions = DB::table('father_opinions')
            ->join('fathers', 'fathers.id', '=', 'father_opinions.id_father')
            ->select('father_opinions.*', 'fathers.name as father_name')
            ->where('father_opinions.id_company', $id_company)
            ->orderBy('id','DESC')
            ->take(10)->get();
            return $opinions;
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
     * @param  \App\Http\Requests\StoreFather_opinionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFather_opinionsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Father_opinions  $father_opinions
     * @return \Illuminate\Http\Response
     */
    public function show(Father_opinions $father_opinions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Father_opinions  $father_opinions
     * @return \Illuminate\Http\Response
     */
    public function edit(Father_opinions $father_opinions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFather_opinionsRequest  $request
     * @param  \App\Models\Model\Father_opinions  $father_opinions
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $opinion = Father_opinions::find($id);
        $opinion->is_deleted = 0;
        $isSave = $opinion->save();
        if($isSave)
            return \back()->with('success', 'تم تعديل الرأي بنجاح');
        return \back()->with('error', 'حدث خطأ ما');
        
    }

    public function activeSingle($id){
        $opinion = Father_opinions::find($id);
        $opinion->is_deleted = 0;
        $isSave = $opinion->save();
        if($isSave)
            return \back()->with('success', 'تم تعديل الرأي بنجاح');
        return \back()->with('error', 'حدث خطأ ما');
    }

    public function activeAll(){
        try {
            //code...
            $opinions = Father_opinions::where('is_deleted', 1)->get(); // get all the opinions that are deleted    
            foreach($opinions as $opinion){
                $opinion->is_deleted = 0;
                $isSave = $opinion->save();
            }
            if($isSave)
                return \back()->with('success', 'تم تعديل الرأي بنجاح');
        } catch (\Throwable $th) {
            //throw $th;
            return \back()->with('error', 'حدث خطأ ما');

        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Father_opinions  $father_opinions
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {

    }

    public function destroySingle($id)
    {
        $opin = Father_opinions::find($id);
        $isDelete = $opin->delete();
        if($isDelete)
            return \back()->with('success', 'تم حذف الرأي بنجاح');
        return \back()->with('error', 'حدث خطأ ما');
    }
    
}

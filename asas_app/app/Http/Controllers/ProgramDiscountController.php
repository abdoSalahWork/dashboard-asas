<?php

namespace App\Http\Controllers;

use App\Models\Model\Program_discount;
use App\Http\Requests\StoreProgram_discountRequest;
use App\Http\Requests\UpdateProgram_discountRequest;
use Illuminate\Http\Request;
use Validator;
class ProgramDiscountController extends Controller
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

    public function programDiscount($id_program){
        $dateNow = date('Y-m-d');
        $program_discount = Program_discount::where('id_program',$id_program)
        ->where('start_discount','<=',$dateNow)
        ->where('end_discount','>=',$dateNow)
        ->get();
        return $program_discount;
    }

    public function createApiWithProgramController( $discount, $id_program){
        
        foreach ($discount as $item) {
            try{

                $program_discount = new Program_discount();
                $program_discount->id_program = $id_program;
                $program_discount->price_rate_discount = $item['price_rate_discount'];
                $program_discount->start_discount = $item['start_discount'];
                $program_discount->end_discount = $item['end_discount'];
                $isSave = $program_discount->save();
                if(!$isSave)
                    return response()->json(['status'=>false ,'message'=>'حدث خطأ أثناء إضافة الخصم']);
            }
            catch(\Exception $ex){
                return response()->json(['status'=>false ,'message'=>'حدث خطأ أثناء إضافة الخصم' , 'ex'=>$ex->getMessage()]);
            }
        
        }

            return response()->json(['status'=>true ,'message'=>'تم إضافة الخصم بنجاح']);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProgram_discountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       try {
           //code...
            $validator = Validator::make($request->all(), [
            'id_program' => 'required',
            'price_rate_discount' => 'required',
            'start_discount' => 'required',
            'end_discount' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $program_discount = new Program_discount();
            $program_discount->id_program = $request->id_program;
            $program_discount->price_rate_discount = $request->price_rate_discount;
            $program_discount->start_discount = $request->start_discount;
            $program_discount->end_discount = $request->end_discount;
            $isSave = $program_discount->save();
            if($isSave)
                return redirect()->back()->with('success', 'تم إضافة الخصم بنجاح');
       } catch (\Throwable $th) {
           //throw $th;
              return redirect()->back()->with('error', 'حدث خطأ أثناء إضافة الخصم');
       }

               
    }

    public function storeApi(Request $request){
        $validator = Validator::make($request->all(), [
            'id_program'=>'required',
            'price_rate_discount' => 'required',
            // 'start_discount' => 'required',
            // 'end_discount' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>false, 'message_en'=>'Please fill in all the data', 'message_ar'=>'الرجاء تعبئة جميع البيانات' ,'error'=>$validator->errors()], 401);
        }
        $program_discount = new Program_discount;
        $program_discount->id_program = $request->id_program;
        $program_discount->price_rate_discount = $request->price_rate_discount;
        if($request->start_discount)
            $program_discount->start_discount = $request->start_discount;
        if($request->end_discount)    
            $program_discount->end_discount = $request->end_discount;
        $isSave = $program_discount->save();
        if($isSave)
            return response()->json(['status'=>true,'message_en'=>'add succefuly','message_ar'=>'تم اضافة الخدمة بنجاح'], 200);

        return \response()->json(['status'=>false,'message_en'=>'add not succefuly','message_ar'=>'لم يتم اضافة الخدمة'], 401);    
    }

    //جلب الخصومات للطالب
    public function get_my_discount($creat_at_children_programs, $id_program){
        $creat_at_children_programs = date('Y-m-d', strtotime($creat_at_children_programs));
        $discount = Program_discount::where('start_discount','<=',$creat_at_children_programs)->where('end_discount', '>=' ,$creat_at_children_programs)->where('id_program', $id_program)->get();
        return $discount;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Program_discount  $program_discount
     * @return \Illuminate\Http\Response
     */
    public function show(Program_discount $program_discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Program_discount  $program_discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Program_discount $program_discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProgram_discountRequest  $request
     * @param  \App\Models\Model\Program_discount  $program_discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //code...
            $validator = Validator::make($request->all(), [
                'id_program' => 'required',
                'price_rate_discount' => 'required',
                'start_discount' => 'required',
                'end_discount' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $program_discount = Program_discount::find($id);
            $program_discount->id_program = $request->id_program;
            $program_discount->price_rate_discount = $request->price_rate_discount;
            $program_discount->start_discount = $request->start_discount;
            $program_discount->end_discount = $request->end_discount;
            $isSave = $program_discount->save();
            if($isSave)
                return redirect()->back()->with('success', 'تم تعديل الخصم بنجاح');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'حدث خطأ أثناء تعديل الخصم');
        }
    }
    public function updateApi(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'price_rate_discount' => 'required',
            // 'start_discount' => 'required',
            // 'end_discount' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        try{

            $program_discount = Program_discount::find($id);
            $program_discount->price_rate_discount = $request->price_rate_discount;
            if($request->start_discount)
            $program_discount->start_discount = $request->start_discount;
            if($request->end_discount)    
            $program_discount->end_discount = $request->end_discount;
            $isSave = $program_discount->save();
            if($isSave)
            return response()->json(['status'=>true,'message_en'=>'add succefuly','message_ar'=>'تم تعديل الخصم بنجاح'], 200);
            
            return \response()->json(['status'=>false,'message_en'=>'add not succefuly','message_ar'=>'لم يتم تعديل الخصم'], 401);    
        }catch(\Exception $ex){
            return response()->json(['status'=>false,'message_en'=>'add not succefuly','message_ar'=>'لم يتم تعديل الخدمة' , "ex"=>$ex->getMessage()], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Program_discount  $program_discount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //code...
            $program_discount = Program_discount::find($id);
            if($program_discount){
                $isDelete = $program_discount->delete();
                if($isDelete)
                    return back()->with('success','تم الحذف بنجاح');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error',$th->getMessage());
        }
    }
    public function destroyApi($id){
        $program_discount = Program_discount::find($id);
        if($program_discount)
            $program_discount->delete();
        return response()->json(['status'=>true,'message_en'=>'delete succefuly','message_ar'=>'تم حذف الخصم بنجاح'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Model\Service_more;
use App\Http\Requests\StoreService_moreRequest;
use App\Http\Requests\UpdateService_moreRequest;
use Illuminate\Http\Request;
use Validator;
use App\Models\Model\facility_owner;
use App\Models\Model\Company_data;
use App\Models\Model\Program;

class ServiceMoreController extends Controller
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
    public function createServiceWithProgramController($service, $id_program){
        $company_data = Company_data::find(Auth()->user()->id);
        $settingCoinsController = new SettingCoinsController();
        $coins = $settingCoinsController->getCoins($company_data->id_coins);

        foreach ($service as $item) {
            try {

                $service = new Service_more();
                $service->id_program = $id_program;
                $service->service_en = $item['service_en'];
                $service->service_ar = $item['service_ar'];
                $service->price = $item['price'] / $coins->dollar;
                $isSave = $service->save();
                if(!$isSave)
                    return response()->json(['status'=>false ,'message_ar'=>'حدث خطأ أثناء إضافة الخدمة', 'message_en'=>'Error while adding service']);
            } catch (\Throwable $th) {
                return response()->json(['status'=>false ,'message'=>'حدث خطأ أثناء إضافة الخدمة' , 'message_en'=>'Error while adding service' , 'ex'=>$th->getMessage()]);
            }

        }
            
                return response()->json(['status'=>true ,'message_ar'=>'تم إضافة الخدمة بنجاح', 'message_en'=>'Service added successfully']);
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
     * @param  \App\Http\Requests\StoreService_moreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {
            //code...

                $validator = Validator::make($request->all(), [
                    'id_program' => ['required'],
                    'service_en' => ['required', 'string', 'max:255'],
                    'service_ar' => ['required', 'string', 'max:255'],
                    'price' => ['required'],

                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $programsTemp = Program::find($request->id_program);
                $company_data = Company_data::find($programsTemp->id_facility_owner);
                $settingCoinsController = new SettingCoinsController();
                $coins = $settingCoinsController->getCoins($company_data->id_coins);

                

                $service = new Service_more();
                $service->id_program = $request->id_program;
                $service->service_en = $request->service_en;
                $service->service_ar = $request->service_ar;
                $service->price = $request->price / $coins->dollar;
                $isSave = $service->save();
                if($isSave)
                    return \back()->with('success', 'تم اضافة الخدمة بنجاح');
             
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());

        }
    }
    public function storeApi(Request $request){
        $validator = Validator::make($request->all(), [
            'service_en' => 'required',
            'service_ar' => 'required',
            'price' => 'required',
            'id_program' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(["status"=>false, 'error'=>$validator->errors()], 401);
        }

        try {
            //code...
            $company_data = Company_data::find(Auth()->user()->id);
            $settingCoinsController = new SettingCoinsController();
            $coins = $settingCoinsController->getCoins($company_data->id_coins);
    
            $service_more = new Service_more;
            $service_more->service_en = $request->service_en;
            $service_more->service_ar = $request->service_ar;
            $service_more->price = $request->price / $coins->dollar;
            $service_more->id_program = $request->id_program;
            $isSave = $service_more->save();
            if($isSave)
                return response()->json(['status'=>true,'message_en'=>'add succefuly','message_ar'=>'تم اضافة الخدمة بنجاح'], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json(['status'=>false,'message_en'=>'add not succefuly','message_ar'=>'لم يتم اضافة الخدمة'], 401);    

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Service_more  $service_more
     * @return \Illuminate\Http\Response
     */
    public function show(Service_more $service_more)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Service_more  $service_more
     * @return \Illuminate\Http\Response
     */
    public function edit(Service_more $service_more)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateService_moreRequest  $request
     * @param  \App\Models\Model\Service_more  $service_more
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //code...
            $service_more = Service_more::find($id);
            if($service_more){
                $validator = Validator::make($request->all(), [
                    'service_en' => ['required', 'string', 'max:255'],
                    'service_ar' => ['required', 'string', 'max:255'],
                    'price' => ['required'],

                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $service_more->service_en = $request->service_en;
                $service_more->service_ar = $request->service_ar;   
                $service_more->price = $request->price;
                $isSave = $service_more->save();
                if($isSave)
                    return back()->with('success', 'تم تعديل الخدمة بنجاح');
                return back()->with('error', 'لم يتم تعديل الخدمة');
            }   
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
        
    }
    public function updateApi(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'service_en' => 'required',
            'service_ar' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>false, 'message_en'=>'Please fill in all the data', 'message_ar'=>'الرجاء تعبئة جميع البيانات' ,'error'=>$validator->errors()], 401);
        }
        try {
            //code...
            $service_more = Service_more::find($id);
            $service_more->service_en = $request->service_en;
            $service_more->service_ar = $request->service_ar;
            $service_more->price = $request->price;
            $isSave = $service_more->save();
            if($isSave)
                return response()->json(['status'=>true,'message_en'=>'add succefuly','message_ar'=>'تم تعديل الخدمة بنجاح'], 200);
    
            return \response()->json(['status'=>false,'message_en'=>'add not succefuly','message_ar'=>'لم يتم تعديل الخدمة'], 401);    
        } catch (\Exception $ex) {
            //throw $th;
            return response()->json(['status'=>false,'message_en'=>'add not succefuly','message_ar'=>'لم يتم تعديل الخدمة', 'ex'=>$ex->getMessage()], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Service_more  $service_more
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service_more = Service_more::find($id);
        if($service_more)
            $isDelete = $service_more->delete();
        if($isDelete)
            return back()->with('success', 'تم حذف الخدمة بنجاح');
        return back()->with('error', 'لم يتم حذف الخدمة');
    }
    public function destroyApi($id){
        $service_more = Service_more::find($id);
        if($service_more)
            $isDelete = $service_more->delete();
        if($isDelete)
            return response()->json(['status'=>true,'message_en'=>'delete succefuly','message_ar'=>'تم حذف الخدمة بنجاح'], 200);
        return response()->json(['status'=>false,'message_en'=>'delete not succefuly','message_ar'=>'لم يتم حذف الخدمة'], 401);
    }
}

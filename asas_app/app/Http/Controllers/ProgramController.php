<?php

namespace App\Http\Controllers;

use App\Models\Model\Program;
use App\Models\Model\Media;
use App\Models\Model\Service_more;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use Illuminate\Http\Request;
use Validator;
use App\Models\Model\Curriculum_types;
use App\Models\Model\facility_owner;
use App\Models\Model\Company_data;
use Illuminate\Support\Facades\DB;
use App\Models\Model\Setting_country_city;
use App\Models\Model\Setting_coins;
use App\Models\Model\Time_type;
use App\Models\Model\Program_type;
use App\Models\Model\Program_discount;
use App\Models\Model\Father;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $programs = Program::where('id_facility_owner', session('facility')->id)->paginate(10);
        $programs = DB::table('programs')
        ->join('time_types', 'programs.id_timeType', '=', 'time_types.id')
        ->join('program_types', 'programs.id_typeProgram', '=', 'program_types.id')
        ->select('programs.*', 'time_types.time_type_ar as time_type_ar', 'program_types.program_type_ar as program_type_ar')
        ->where('programs.id_facility_owner', session('facility')->id)->where('programs.is_deleted',0)
        ->paginate(10);
        
        $company_data = Company_data::find(session('facility')->id);
        $settingCoinsController = new SettingCoinsController();
        $coins = $settingCoinsController->getCoins($company_data->id_coins);
        
        return view('facility_owner.programs.main')
        ->with('programs', $programs)
        ->with('coins', $coins); 
    }

    public function countProgram($id_facility_owner){
        $countProgrames = Program::where('id_facility_owner', $id_facility_owner)->count();
        return $countProgrames;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $time_types = Time_type::all();
        $program_types = Program_type::all();
        $curriculum_types = Curriculum_types::all();
        return view('facility_owner.programs.create')
            ->with('time_type', $time_types)
            ->with('program_types',$program_types)
            ->with('curriculum_types',$curriculum_types);
    }

    public function createWithAdmin($id_facility){
        $time_types = Time_type::all();
        $program_types = Program_type::where("is_deleted",'=','0')->get();
        $curriculum_types = Curriculum_types::all();
        return view('admin.programs.create')
            ->with('time_type', $time_types)
            ->with('program_types',$program_types)
            ->with('curriculum_types',$curriculum_types)
            ->with('id_facility',$id_facility);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProgramRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'description_en' => ['required', 'string'],
            'description_ar' => ['required', 'string'],
            'id_timeType' => ['required'],
            'id_typeProgram' => ['required'],
            'price_main' => ['required'],
            // 'age_conditions_en' => ['required'],
            // 'age_conditions_ar' => ['required'],
            // 'id_curriculum_type' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            $companyData = Company_data::find(session('facility')->id);
            $id_coins = $companyData->id_coins;

            $settingCoinsController = new SettingCoinsController();
            $settingCoins = $settingCoinsController->getCoins($id_coins);
            //code...
            $program = new Program();
            $program->id_facility_owner = Session('facility')->id;
            $program->name_en = $request->name_en;
            $program->name_ar = $request->name_ar;
            $program->description_en = $request->description_en;
            $program->description_ar = $request->description_ar;
            $program->id_timeType = $request->id_timeType;
            $program->id_typeProgram = $request->id_typeProgram;
            if($settingCoins->dollar == 0)
                        return back()->with('error', 'لايمكن الاضافه وقيمه العمله 0');
            $program->price_main = $request->price_main / $settingCoins->dollar;
            
            if($request->age_conditions_en){
                $program->age_conditions_en = $request->age_conditions_en;
            }else{
                $program->age_conditions_en = null;
            }
            if($request->sort){
                $program->sort = $request->sort;
            }else{
                $program->sort = 0;
            }

            if($request->age_conditions_ar){
                $program->age_conditions_ar = $request->age_conditions_ar;
            }else{
                $program->age_conditions_ar = null;
            }

            if($request->id_curriculum_type){
                $program->id_curriculum_type = $request->id_curriculum_type;
            }else{
                $program->id_curriculum_type = ' ';
            }
    
            if($request->other_conditions_en){
                $program->other_conditions_en = $request->other_conditions_en;
            }
            if($request->other_conditions_ar){
                $program->other_conditions_ar = $request->other_conditions_ar;
            }
            if($request->url_viedo){
                $program->url_viedo = $request->url_viedo;
            }
    
            if($request->price_note_en){
                $program->price_note_en = $request->price_note_en;
            }
    
            if($request->price_note_ar){
                $program->price_note_ar = $request->price_note_ar;
            }
    
            if($request->other_fute){
                $program->other_fute = $request->other_fute;
            }else{
                $program->other_fute = " ";   
            }
            
            
            $program->image = '-';
            $isSave = $program->save();
            if($isSave){
                if($request->file("image")){
                    foreach($request->file("image") as $file){
                        $img = time().$file->getClientOriginalName();
                        $img = trim($img, ' ');
                        $file->move('assets/image/programs/',$img);
                        $media = new Media();
                        $media->media = $img;
                        $media->id_ = $program->id;
                        $media->table_name = "programs";
                        $media->save();
                    }
                }
                // return back()->with('success', 'تم إضافة البرنامج بنجاح');
                return redirect()->route('programs.edit',$program->id)->with('success', 'تم إضافة البرنامج بنجاح');
            }
            return back()->with('error', 'حدث خطأ ما');



    }

    public function storeWithAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'description_en' => ['required', 'string'],
            'description_ar' => ['required', 'string'],
            'id_timeType' => ['required'],
            'id_typeProgram' => ['required'],
            'price_main' => ['required'],
            'age_conditions_en' => ['required'],
            'sort' => 'required|unique:programs,sort',

            'age_conditions_ar' => ['required'],
            'id_curriculum_type' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $companyData = Company_data::find($request->id_facility);
        $id_coins = $companyData->id_coins;

        $settingCoinsController = new SettingCoinsController();
        $settingCoins = $settingCoinsController->getCoins($id_coins);
            //code...
            $program = new Program();
            $program->id_facility_owner = $request->id_facility;
            $program->name_en = $request->name_en;
            $program->name_ar = $request->name_ar;
            $program->description_en = $request->description_en;
            $program->description_ar = $request->description_ar;
            $program->id_timeType = $request->id_timeType;
            $program->id_typeProgram = $request->id_typeProgram;
            if($settingCoins->dollar == 0)
                        return back()->with('error', 'لايمكن الاضافه وقيمه العمله 0');
            $program->price_main = $request->price_main / $settingCoins->dollar;

            $program->age_conditions_en = $request->age_conditions_en;
            $program->sort = $request->sort;

            $program->age_conditions_ar = $request->age_conditions_ar;
            $program->id_curriculum_type = $request->id_curriculum_type;
    
            if($request->other_conditions_en){
                $program->other_conditions_en = $request->other_conditions_en;
            }
            if($request->other_conditions_ar){
                $program->other_conditions_ar = $request->other_conditions_ar;
            }
            if($request->url_viedo){
                $program->url_viedo = $request->url_viedo;
            }
    
            if($request->price_note_en){
                $program->price_note_en = $request->price_note_en;
            }
    
            if($request->price_note_ar){
                $program->price_note_ar = $request->price_note_ar;
            }
    
            if($request->other_fute){
                $program->other_fute = $request->other_fute;
            }else{
                $program->other_fute = " ";
            }
            $program->image = '-';

            $program->Gender = $request->Gender;

            $isSave = $program->save();
            if($isSave){
                if($request->file("image")){
                    foreach($request->file("image") as $file){
                        $img = time().$file->getClientOriginalName();
                        $img = trim($img, ' ');
                        $file->move('assets/image/programs/',$img);
                        $media = new Media();
                        $media->media = $img;
                        $media->id_ = $program->id;
                        $media->table_name = "programs";
                        $media->save();
                    }
                }
                // return back()->with('success', 'تم إضافة البرنامج بنجاح');
                return \redirect("admin/programs2/edit/".$program->id)->with('success', 'تم إضافة البرنامج بنجاح');
                // return redirect()->route('programs2.edit',$program->id)->with('success', 'تم إضافة البرنامج بنجاح');
            }
            return back()->with('error', 'حدث خطأ ما');



    }

    public function storeApi(Request $request){
            // [
            //     {
            //         "price_rate_discount":"10",
            //        "start_discount":"2022/04/01",
            //        "end_discount":"2022/04/30"
            //     },{
            //         "price_rate_discount":"10",
            //        "start_discount":"2022/04/01",
            //        "end_discount":"2022/04/30"
            //     }
            // ]


            // [
            //     {
            //         "service_en":"service_en",
            //        "service_ar":"خدمة عربية",
            //        "price":"50"
            //     },{
            //         "service_en":"service_en",
            //         "service_ar":"خدمة عربية",
            //         "price":"50"
            //     },{
            //         "service_en":"service_en",
            //        "service_ar":"خدمة عربية",
            //        "price":"50"
            //     }
            // ]
        

        $validator = Validator::make($request->all(), [
            // 'id_facility_owner' => 'required',
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'required',
            'description_ar' => 'required',
            'id_timeType' => 'required',
            'id_typeProgram' => 'required',
            'price_main' => 'required',
            // 'price_rate_discount' => 'required',
            // 'start_discount' => 'required',
            // 'end_discount' => 'required',
            // 'age_conditions_en' => 'required',
            // 'age_conditions_ar' => 'required',
            // 'other_conditions' => 'required',
            // 'image' => 'required',
            // 'main_img' => 'required',
            // 'id_curriculum_type' => 'required',
            // 'other_fute' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false, 'message_en'=>'Please fill in all the data', 'message_ar'=>'الرجاء تعبئة جميع البيانات' ,'error'=>$validator->errors()], 401);
        }

        $company_data = Company_data::find(Auth()->user()->id);
        $settingCoinsController = new SettingCoinsController();
        $coins = $settingCoinsController->getCoins($company_data->id_coins);

        if($coins->dollar == 0)
            return response()->json(['status'=>false, 'message_ar'=>'لايمكن الاضافه وقيمه العمله 0', 'message_en'=>'It cannot be added and the currency value is 0' ,'error'=>$validator->errors()], 401);

        $program = new Program();
        $program->id_facility_owner = Auth()->user()->id;
        $program->name_en = $request->name_en;
        $program->name_ar = $request->name_ar;
        $program->description_en = $request->description_en;
        $program->description_ar = $request->description_ar;
        $program->id_timeType = $request->id_timeType;
        $program->id_typeProgram = $request->id_typeProgram;
        $program->price_main = (float)$request->price_main / (float)$coins->dollar;
        // $program->age_conditions_en = $request->age_conditions_en;
        if($request->age_conditions_en){
            $program->age_conditions_en = $request->age_conditions_en;
        }else{
            $program->age_conditions_en = ' ';
        }

        // $program->age_conditions_ar = $request->age_conditions_ar;
        if($request->age_conditions_ar){
            $program->age_conditions_ar = $request->age_conditions_ar;
        }else{
            $program->age_conditions_ar = ' ';
        }
        if($request->id_curriculum_type){
            $program->id_curriculum_type = $request->id_curriculum_type;
        }else{
            $program->id_curriculum_type = ' ';
        }

        if($request->other_conditions_en){
            $program->other_conditions_en = $request->other_conditions_en;
        }
        if($request->other_conditions_ar){
            $program->other_conditions_ar = $request->other_conditions_ar;
        }
        if($request->url_viedo){
            $program->url_viedo = $request->url_viedo;
        }

        if($request->price_note_en){
            $program->price_note_en = $request->price_note_en;
        }

        if($request->price_note_ar){
            $program->price_note_ar = $request->price_note_ar;
        }

        $program->Gender = $request->Gender;

        // $images =[];
        // foreach($request->file("image") as $file){
        //     $img = time().$file->getClientOriginalName();
        //     $img = trim($img, ' ');
        //     $file->move('assets/image/programs/',$img);
        //     array_push($images, $img);
        // }
        // $s = serialize($images);
        // $d = unserialize($s);
        // return response()->json(['s'=>$s, 'd'=>$d], 200);
        // $program->image = serialize($images);
        
        // $file = $request->file('main_img');
        // $main_img = time().$file->getClientOriginalName();
        // $main_img = trim($main_img, ' ');
        // $file->move('assets/image/programs/',$main_img);
        // $program->image = $main_img;
        $program->image = "-";
       
         
        if($request->other_fute){
            $program->other_fute = $request->other_fute;
        }else{
            $program->other_fute = "-";
        }
        $isSave = $program->save();
        if($isSave){
            //upload img
            if($request->file("image")){
                foreach($request->file("image") as $file){
                    $img = time().$file->getClientOriginalName();
                    $img = trim($img, ' ');
                    $file->move('assets/image/programs/',$img);
                    $media = new Media();
                    $media->media = $img;
                    $media->id_ = $program->id;
                    $media->table_name = "programs";
                    $media->save();
                }
            }
           
            $resultDiscountSave = null;
            $resultServiceMoreSave = null;
            if($request->discount != "-"){
                $programDiscount = new ProgramDiscountController();
                $discount = \json_decode($request->discount, true);
                $resultDiscountSave = $programDiscount->createApiWithProgramController($discount, $program->id);
            }

            if($request->service_more != "-"){
                $serviceMore = new ServiceMoreController();
                $service_more = \json_decode($request->service_more, true);
                $resultServiceMoreSave = $serviceMore->createServiceWithProgramController($service_more, $program->id);
            }

            return response()->json(['status'=>true,
                'message_en'=>'Program created successfully',
                'message_ar'=>'تم انشاء البرنامج بنجاح',
                'data'=>$program,
                'discount'=>$resultDiscountSave,
                'service'=>$resultServiceMoreSave], 200);
        }
        return \response()->json([
            'status' => false,
            'message_en' => 'Error in creating program',
            'message_ar' => 'خطأ في انشاء البرنامج',
        ], 401);
        
    }   


    public function copyProgram($id){
        $program = Program::find($id);
        if($program){
            $program_copy = new Program();
            $program_copy->id_facility_owner = $program->id_facility_owner;
            $program_copy->name_en = $program->name_en;
            $program_copy->name_ar = $program->name_ar;
            $program_copy->description_en = $program->description_en;
            $program_copy->description_ar = $program->description_ar;
            $program_copy->id_timeType = $program->id_timeType;
            $program_copy->id_typeProgram = $program->id_typeProgram;
            $program_copy->price_main = $program->price_main;
            $program_copy->age_conditions_en = $program->age_conditions_en;
            $program_copy->sort = $program->sort;

            $program_copy->age_conditions_ar = $program->age_conditions_ar;
            $program_copy->other_conditions_en = $program->other_conditions_en;
            $program_copy->other_conditions_ar = $program->other_conditions_ar;
            $program_copy->other_fute = $program->other_fute;
            $program_copy->image = $program->image;
            $program_copy->url_viedo = $program->url_viedo;
            $program_copy->id_curriculum_type = $program->id_curriculum_type;
            $isSave = $program_copy->save();
            if($isSave){
                $image = Media::where('id_',$program->id)->where('table_name','programs')->get();
                foreach ($image as $item) {
                    // # code...
                    // $copyImage = new Media();
                    // $copyImage->media = $item->media;
                    // $copyImage->id_ = $program_copy->id;
                    // $copyImage->table_name = $item->table_name;
                    // $copyImage->save();
                     # code...
                     $pathFile = "assets/image/$item->table_name/"; 
                     $oldFile = $pathFile.$item->media;
                     $newFile = $item->media.microtime(true);
 
                     $isCipyImage = copy($oldFile, $pathFile.$newFile);
                     if($isCipyImage){
                         $copyImage = new Media();
                         $copyImage->media = $newFile;
                         $copyImage->id_ = $program_copy->id;
                         $copyImage->table_name = $item->table_name;
                         $copyImage->save();
                     }
                }
                return \response()->json([
                    'status'=>true,
                    'message_en'=>'Program copied successfully',
                    'message_ar'=>'تم نسخ البرنامج بنجاح',
                    'data'=>$program_copy
                ]);
            }
            return \response()->json([
                'status'=>false,
                'message_en'=>'Error in copying program',
                'message_ar'=>'خطأ في نسخ البرنامج',
            ]);  
        }
        return \response()->json([
            'status'=>false,
            'message_en'=>'Program not found',
            'message_ar'=>'البرنامج غير موجود',
        ]);
    }

    public function CopyProgramWithAdmin($id){
        $program = Program::find($id);
        if($program){
            $program_copy = new Program();
            $program_copy->id_facility_owner = $program->id_facility_owner;
            $program_copy->name_en = $program->name_en;
            $program_copy->name_ar = $program->name_ar;
            $program_copy->description_en = $program->description_en;
            $program_copy->description_ar = $program->description_ar;
            $program_copy->id_timeType = $program->id_timeType;
            $program_copy->id_typeProgram = $program->id_typeProgram;
            $program_copy->price_main = $program->price_main;
            $program_copy->age_conditions_en = $program->age_conditions_en;
            $program_copy->sort = $program->sort;

            $program_copy->age_conditions_ar = $program->age_conditions_ar;
            $program_copy->other_conditions_en = $program->other_conditions_en;
            $program_copy->other_conditions_ar = $program->other_conditions_ar;
            $program_copy->other_fute = $program->other_fute;
            $program_copy->image = $program->image;
            $program_copy->url_viedo = $program->url_viedo;
            $program_copy->id_curriculum_type = $program->id_curriculum_type;
            $isSave = $program_copy->save();
            //return $program_copy->id;
            if($isSave){
                $image = Media::where('id_',$program->id)->where('table_name','programs')->get();
                foreach ($image as $item) {
                    # code...
                    $pathFile = "assets/image/$item->table_name/"; 
                    $oldFile = $pathFile.$item->media;
                    $newFile = $item->media.microtime(true);

                    $isCipyImage = copy($oldFile, $pathFile.$newFile);
                    if($isCipyImage){
                        $copyImage = new Media();
                        $copyImage->media = $newFile;
                        $copyImage->id_ = $program_copy->id;
                        $copyImage->table_name = $item->table_name;
                        $copyImage->save();
                    }
                }
                return back()->with('success', 'تم نسخ البرانامج بنجاح');
            }
            return back()->with('error', 'خطأ في نسخ البرنامج');
        }
        return back()->with('error', 'البرنامج غير موجود');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }
    public function singleApi($id){
        try {
            //code...
            $program = Program::find($id);
            if($program){
                $facility_owner = facility_owner::where('id', $program->id_facility_owner)->first(['name_corporation', 'name_corporation_ar']);
                $companyData = Company_data::where('id_facility_owner', $program->id_facility_owner)->first(['id_country', 'id_city','id_coins']);
                $city_companyData = Setting_country_city::where('id', $companyData->id_city)->first(['name_en', 'name_ar']);
                $country_companyData = Setting_country_city::where('id', $companyData->id_country)->first(['name_en', 'name_ar']);
                $coins_companyData = Setting_coins::where('id', $companyData->id_coins)->first();

                $media = Media::where('id_',$program->id)->where('table_name','programs')->get();
                $service_more = Service_more::where('id_program',$program->id)->get();
                $programDiscount = new ProgramDiscountController();
                // $discount= $programDiscount->programDiscount($program->id);
                // $discount = Program_discount::where('id',$program->id)->get();
                $dateNow = date('Y/m/d');
                $discount = DB::select("SELECT * FROM program_discounts WHERE
                start_discount <= '$dateNow' AND end_discount >= '$dateNow' AND id_program = '$id'");


                $curriculum_type = Curriculum_types::where('id',$program->id_curriculum_type)->first();
                return response()->json([
                    'status'=>true,
                    'message_en'=>'Program found successfully',
                    'message_ar'=>'تم العثور على البرنامج بنجاح',
                    'data'=>$program,
                    'name_corporation'=>$facility_owner,
                    'media'=>$media,
                    'service_more'=>$service_more,
                    'discount'=>$discount,
                    'curriculum_type'=>$curriculum_type,
                    'country_companyData'=>$country_companyData,
                    'city_companyData'=>$city_companyData,
                    'coins_companyData'=>$coins_companyData
                ], 200);
            }

        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json([
                'status' => false,
                'message_en' => 'Error in finding program',
                'message_ar' => 'خطأ في العثور على البرنامج',
                'error' => $th->getMessage()
            ], 401);
        }

    }

    //لمن ينطلب البرنامج عن طريق facility
    public function singleApiWithFacility($id){
        try {
            //code...
            $program = Program::find($id);
            if($program){
                $facility_owner = facility_owner::where('id', $program->id_facility_owner)->first(['name_corporation', 'name_corporation_ar']);
                $companyData = Company_data::where('id_facility_owner', $program->id_facility_owner)->first(['id_country', 'id_city','id_coins']);
                $city_companyData = Setting_country_city::where('id', $companyData->id_city)->first(['name_en', 'name_ar']);
                $country_companyData = Setting_country_city::where('id', $companyData->id_country)->first(['name_en', 'name_ar']);
                $coins_companyData = Setting_coins::where('id', $companyData->id_coins)->first();

                $media = Media::where('id_',$program->id)->where('table_name','programs')->get();
                $service_more = Service_more::where('id_program',$program->id)->get();
                $programDiscount = new ProgramDiscountController();
                // $discount= $programDiscount->programDiscount($program->id);
                $discount = Program_discount::where('id_program',$program->id)->get();
                // $dateNow = date('Y/m/d');
                // $discount = DB::select("SELECT * FROM program_discounts WHERE
                // start_discount <= '$dateNow' AND end_discount >= '$dateNow' AND id_program = '$id'");


                $curriculum_type = Curriculum_types::where('id',$program->id_curriculum_type)->first();
                return response()->json([
                    'status'=>true,
                    'message_en'=>'Program found successfully',
                    'message_ar'=>'تم العثور على البرنامج بنجاح',
                    'data'=>$program,
                    'name_corporation'=>$facility_owner,
                    'media'=>$media,
                    'service_more'=>$service_more,
                    'discount'=>$discount,
                    'curriculum_type'=>$curriculum_type,
                    'country_companyData'=>$country_companyData,
                    'city_companyData'=>$city_companyData,
                    'coins_companyData'=>$coins_companyData
                ], 200);
            }

        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json([
                'status' => false,
                'message_en' => 'Error in finding program',
                'message_ar' => 'خطأ في العثور على البرنامج',
                'error' => $th->getMessage()
            ], 401);
        }

    }

    public function singleApiAuth($id){
        try {
            //code...
  

            $program = Program::find($id);
            if($program){

                if(isset(Auth()->user()->name_corporation)){
                    $companyData = Company_data::where('id_facility_owner', Auth()->user()->id)->first(['id_coins']);
                    $coins = Setting_coins::where('id', $companyData->id_coins)->first();
                    $discount = Program_discount::where('id',$program->id)->get();
    
                }else{
                    $father = Father::where('id', Auth()->user()->id)->first(['id_coins']);
                    $coins = Setting_coins::where('id', $father->id_coins)->first();
                   $dateNow = date('Y/m/d');
                $discount = DB::select("SELECT * FROM program_discounts WHERE
                start_discount <= '$dateNow' AND end_discount >= '$dateNow' AND id_program = '$id'");
                }

                $facility_owner = facility_owner::where('id', $program->id_facility_owner)->first(['name_corporation', 'name_corporation_ar']);
                $companyData = Company_data::where('id_facility_owner', $program->id_facility_owner)->first(['id_country', 'id_city','id_coins']);
                $city_companyData = Setting_country_city::where('id', $companyData->id_city)->first(['name_en', 'name_ar']);
                $country_companyData = Setting_country_city::where('id', $companyData->id_country)->first();
                // $coins_companyData = Setting_coins::where('id', $companyData->id_coins)->first(['coins_name_en', 'coins_name_ar']);

                $media = Media::where('id_',$program->id)->where('table_name','programs')->get();
                $service_more = Service_more::where('id_program',$program->id)->get();
                // $programDiscount = new ProgramDiscountController();
                // $discount = $programDiscount->programDiscount($program->id);
                $curriculum_type = Curriculum_types::where('id',$program->id_curriculum_type)->first();
                return response()->json([
                    'status'=>true,
                    'message_en'=>'Program found successfully',
                    'message_ar'=>'تم العثور على البرنامج بنجاح',
                    'data'=>$program,
                    'name_corporation'=>$facility_owner,
                    'media'=>$media,
                    'service_more'=>$service_more,
                    'discount'=>$discount,
                    'curriculum_type'=>$curriculum_type,
                    'country_companyData'=>$country_companyData,
                    'city_companyData'=>$city_companyData,
                    'coins'=>$coins
                ], 200);
            }	


        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json([
                'status' => false,
                'message_en' => 'Error in finding program',
                'message_ar' => 'خطأ في العثور على البرنامج',
                'error' => $th->getMessage()
            ], 401);
        }

    }

    public function showApi($id_facility_owner){
        try {
            $dateNow = date("Y/m/d");
            //return $dateNow;
            //code...
            // $program = Program::where('id_facility_owner',$id_facility_owner)->where('is_deleted',0)->orderBy('id','DESC')->paginate(10);
            $program = DB::table('programs')
                // ->leftjoin('program_discounts', 'programs.id', '=', 'program_discounts.id_program')
                ->leftJoin('program_discounts', function ($leftJoin) use ($dateNow) {
                    $leftJoin->on('programs.id', '=', 'program_discounts.id_program')
                         ->where('program_discounts.id', '=', DB::raw("(select max(`id`) from program_discounts WHERE program_discounts.id_program = programs.id AND start_discount <= '$dateNow' AND end_discount >= '$dateNow')"));
                })
                ->join('company_datas', 'company_datas.id_facility_owner','=','programs.id_facility_owner')
                ->join('setting_coins', 'setting_coins.id','=','company_datas.id_coins')
                ->select('programs.*', 'setting_coins.coins_name_en', 'setting_coins.coins_name_ar', 'setting_coins.dollar', 'program_discounts.price_rate_discount','program_discounts.start_discount', 'program_discounts.end_discount',
               ) //
                ->where('programs.id_facility_owner',$id_facility_owner)
                ->where('programs.is_deleted',0)
                ->orderBy('programs.id','DESC')
                ->sortBy('sort','DESC')

                ->paginate(10);
            $companyData = Company_data::where('id_facility_owner', $id_facility_owner)->first(['id_coins']);
            $coins_companyData = Setting_coins::where('id', $companyData->id_coins)->first();
            return response()->json(['status'=>true,'message_en'=>'Programs found successfully','message_ar'=>'تم العثور على البرامج بنجاح','data'=>$program, 'coins_companyData'=>$coins_companyData], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json([
                'status' => false,
                'message_en' => 'Error in finding programs',
                'message_ar' => 'خطأ في العثور على البرامج',
                'error' => $th->getMessage()
            ], 401);
        }
    }

    public function showApiAuth($id_user){
        try {
            //code...
            // $program = Program::where('id_facility_owner',$id_facility_owner)->where('is_deleted',0)->orderBy('id','DESC')->paginate(10);
            $program = DB::table('programs')
                // ->leftJoin('program_discounts', 'programs.id', '=', 'program_discounts.id_program')
                ->select('programs.*') //, 'program_discounts.price_rate_discount','program_discounts.start_discount', 'program_discounts.end_discount'
                ->where('programs.id_facility_owner',$id_user)
                ->where('programs.is_deleted','0')
                ->orderBy('programs.id','DESC')
                ->sortBy('sort','DESC')

                ->paginate(10);

            if(isset(Auth()->user()->name_corporation)){
                $companyData = Company_data::where('id_facility_owner', $id_user)->first(['id_coins']);
                $coins = Setting_coins::where('id', $companyData->id_coins)->first();
            }else{
                $father = Father::where('id', $id_user)->first(['id_coins']);
                $coins = Setting_coins::where('id', $father->id_coins)->first();
            }


            return response()->json(['status'=>true,'message_en'=>'Programs found successfully','message_ar'=>'تم العثور على البرامج بنجاح','data'=>$program, 'coins'=>$coins], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json([
                'status' => false,
                'message_en' => 'Error in finding programs',
                'message_ar' => 'خطأ في العثور على البرامج',
                'error' => $th->getMessage()
            ], 401);
        }
    }
 
    public function getProgramWithTypeProgram($id_type_program, $id_city,$search = null){
        try {
            //code...
            if($search == null){
                $program = DB::table('programs')
                ->join('facility_owners', 'programs.id_facility_owner', '=', 'facility_owners.id')
                ->join('company_datas', 'company_datas.id_facility_owner', '=', 'facility_owners.id')
                ->join('setting_coins','setting_coins.id','company_datas.id_coins')
                ->leftJoin('program_discounts', function ($leftJoin) {
                    $leftJoin->on('programs.id', '=', 'program_discounts.id_program')
                         ->where('program_discounts.id', '=', DB::raw("(select max(`id`) from program_discounts WHERE program_discounts.id_program = programs.id)"));
                })
                ->select('setting_coins.*','setting_coins.id AS coins_id','programs.*','programs.id AS idProgram','program_discounts.price_rate_discount','program_discounts.start_discount', 'program_discounts.end_discount')
                ->where('programs.id_typeProgram',$id_type_program)
                ->where('programs.is_deleted','0')
                ->where('company_datas.id_city',$id_city)
                ->where('facility_owners.is_deleted','0')
                ->orderBy('programs.id','DESC')
                ->sortBy('sort','DESC')

                ->paginate(10);

            }else{
                // $dateNow = date('Y-m-d'); 

                $program = DB::table('programs')
                ->join('facility_owners',  'programs.id_facility_owner', '=', 'facility_owners.id')
                ->join('company_datas', 'company_datas.id_facility_owner', '=', 'facility_owners.id')
                ->join('setting_coins','setting_coins.id','company_datas.id_coins')
                ->leftJoin('program_discounts', function ($leftJoin) {
                    $leftJoin->on('programs.id', '=', 'program_discounts.id_program')
                         ->where('program_discounts.id', '=', DB::raw("(select max(`id`) from program_discounts WHERE program_discounts.id_program = programs.id)")); // AND program_discounts.start_discount <= $dateNow AND program_discounts.end_discount >= $dateNow
                })
                ->select('setting_coins.*','setting_coins.id AS coins_id','programs.*','programs.id AS idProgram','program_discounts.price_rate_discount','program_discounts.start_discount', 'program_discounts.end_discount')
                ->where('programs.id_typeProgram',$id_type_program)
                ->where('programs.name_en', 'like', '%'.$search.'%')
                ->where('company_datas.id_city',$id_city)
                ->where('facility_owners.is_deleted','0')
                ->where('programs.is_deleted','0')

                ->orWhere('programs.name_ar', 'like', '%'.$search.'%')
                ->where('programs.id_typeProgram',$id_type_program)
                ->where('company_datas.id_city',$id_city)
                ->where('facility_owners.is_deleted','0')
                ->where('programs.is_deleted','0')
                ->sortBy('sort','DESC')

                ->orderBy('programs.id','DESC')
                ->paginate(10);
            }
            
            return response()->json(['status'=>true,'message_en'=>'Programs found successfully','message_ar'=>'تم العثور على البرامج بنجاح','data'=>$program], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json([
                'status' => false,
                'message_en' => 'Error in finding programs',
                'message_ar' => 'خطأ في العثور على البرامج',
                'error' => $th->getMessage()
            ], 401);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            //code...
            $program = Program::find($id);
            if($program){
                $facility_owner = facility_owner::where('id', $program->id_facility_owner)->first(['name_corporation']);
                $companyData = Company_data::where('id_facility_owner', $program->id_facility_owner)->first(['id_country', 'id_city','id_coins']);
                $city_companyData = Setting_country_city::where('id', $companyData->id_city)->first(['name_en', 'name_ar']);
                $country_companyData = Setting_country_city::where('id', $companyData->id_country)->first(['name_en', 'name_ar']);
                $coins_companyData = Setting_coins::where('id', $companyData->id_coins)->first();

                $media = Media::where('id_',$program->id)->where('table_name','programs')->get();
                $service_more = Service_more::where('id_program',$program->id)->get();
                // $programDiscount = new ProgramDiscountController();
                // $discount = $programDiscount->programDiscount($program->id);
                $discount = Program_discount::where('id',$program->id)->get();
                $curriculum_type = Curriculum_types::where('id',$program->id_curriculum_type)->first();

                $time_type = Time_type::all();
                $program_types = Program_type::all();
                $curriculum_types = Curriculum_types::all();
                return view('facility_owner.programs.update', compact('program','facility_owner','media','service_more','discount','curriculum_type','country_companyData','city_companyData','coins_companyData', 'time_type', 'program_types', 'curriculum_types'));
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    public function editWithAdmin($id)
    {
        try {
            //code...
            $program = Program::find($id);
            if($program){
                $facility_owner = facility_owner::where('id', $program->id_facility_owner)->first(['name_corporation']);
                $companyData = Company_data::where('id_facility_owner', $program->id_facility_owner)->first(['id_country', 'id_city','id_coins']);
                $city_companyData = Setting_country_city::where('id', $companyData->id_city)->first(['name_en', 'name_ar']);
                $country_companyData = Setting_country_city::where('id', $companyData->id_country)->first(['name_en', 'name_ar']);
                $coins_companyData = Setting_coins::where('id', $companyData->id_coins)->first();

                $media = Media::where('id_',$program->id)->where('table_name','programs')->get();
                $service_more = Service_more::where('id_program',$program->id)->get();
                // $programDiscount = new ProgramDiscountController();
                // $discount = $programDiscount->programDiscount($program->id);
                $discount = Program_discount::where('id',$program->id)->get();
                $curriculum_type = Curriculum_types::where('id',$program->id_curriculum_type)->first();

                $time_type = Time_type::all();
                $program_types = Program_type::all();
                $curriculum_types = Curriculum_types::all();
                return view('admin.programs.update', compact('program','facility_owner','media','service_more','discount','curriculum_type','country_companyData','city_companyData','coins_companyData', 'time_type', 'program_types', 'curriculum_types'));
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProgramRequest  $request
     * @param  \App\Models\Model\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //code...
            $program = Program::find($id);
            if($program){
                $validator = Validator::make($request->all(), [
                    'name_en' => ['required', 'string', 'max:255'],
                    'name_ar' => ['required', 'string', 'max:255'],
                    'description_en' => ['required', 'string'],
                    'description_ar' => ['required', 'string'],
                    'id_timeType' => ['required'],
                    'id_typeProgram' => ['required'],
                    'price_main' => ['required'],
                    'age_conditions_en' => ['required'],
                    'sort'=> ['required'],
                    'age_conditions_ar' => ['required'],
                    'id_curriculum_type' => ['required'],
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                    //code...
                    $companyData = Company_data::find($program->id_facility_owner);
                    $id_coins = $companyData->id_coins;
        
                    $settingCoinsController = new SettingCoinsController();
                    $settingCoins = $settingCoinsController->getCoins($id_coins);

                    $program->name_en = $request->name_en;
                    $program->name_ar = $request->name_ar;
                    $program->description_en = $request->description_en;
                    $program->description_ar = $request->description_ar;
                    $program->id_timeType = $request->id_timeType;
                    $program->id_typeProgram = $request->id_typeProgram;
                    if($settingCoins->dollar == 0)
                        return back()->with('error', 'لايمكن الاضافه وقيمه العمله 0');
        
                    $program->price_main = $request->price_main / $settingCoins->dollar;
                    $program->age_conditions_en = $request->age_conditions_en;
                    $program->sort = $request->sort;

                    $program->age_conditions_ar = $request->age_conditions_ar;
                    $program->id_curriculum_type = $request->id_curriculum_type;
            
                    if($request->other_conditions_en){
                        $program->other_conditions_en = $request->other_conditions_en;
                    }
                    if($request->other_conditions_ar){
                        $program->other_conditions_ar = $request->other_conditions_ar;
                    }
                    if($request->url_viedo){
                        $program->url_viedo = $request->url_viedo;
                    }
            
                    if($request->price_note_en){
                        $program->price_note_en = $request->price_note_en;
                    }
            
                    if($request->price_note_ar){
                        $program->price_note_ar = $request->price_note_ar;
                    }
            
                    if($request->other_fute){
                        $program->other_fute = $request->other_fute;
                    }
                    $program->image = '-';
                    
                    $program->Gender = $request->Gender;
                    $isUpdate = $program->save();
                    if($isUpdate){
                        return back()->with('success', 'تم تعديل البرنامج بنجاح');
                    }
            }
        }catch(\Throwable $th){
            //throw $th;
            return $th->getMessage();
        }
    }
    public function updateApi(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'required',
            'description_ar' => 'required',
            'id_timeType' => 'required',
            'id_typeProgram' => 'required',
            'price_main' => 'required',
            'sort' => 'required|unique:programs,sort',

            // 'age_conditions_en' => 'required',
            // 'age_conditions_ar' => 'required',
            'id_curriculum_type' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>false, 'message_en'=>'Please fill in all the data', 'message_ar'=>'الرجاء تعبئة جميع البيانات' ,'error'=>$validator->errors()], 401);
        }

        $companyData = Company_data::find(auth()->user()->id);
        $id_coins = $companyData->id_coins;

        $settingCoinsController = new SettingCoinsController();
        $settingCoins = $settingCoinsController->getCoins($id_coins);

        $program = Program::find($id);
        $program->name_en = $request->name_en;
        $program->name_ar = $request->name_ar;
        $program->description_en = $request->description_en;
        $program->description_ar = $request->description_ar;
        $program->id_timeType = $request->id_timeType;
        $program->id_typeProgram = $request->id_typeProgram;
        
        if($settingCoins->dollar == 0)
            return \response()->json([
                'status' => false,
                'message_en' => 'Error in updating program',
                'message_ar' => 'خطأ في تعديل البرنامج نوع العمله يجب ان تكون اكبر من 0 ',
            ], 401);
        $program->price_main = $request->price_main / $settingCoins->dollar;

        if($request->age_conditions_en)
            $program->age_conditions_en = $request->age_conditions_en;

        if($request->age_conditions_ar)
            $program->age_conditions_ar = $request->age_conditions_ar;

        if($program->id_curriculum_type)
            $program->id_curriculum_type = $request->id_curriculum_type;

        if($request->other_conditions_en){
            $program->other_conditions_en = $request->other_conditions_en;
        }
        if($request->other_conditions_ar){
            $program->other_conditions_ar = $request->other_conditions_ar;
        }
        if($request->url_viedo){
            $program->url_viedo = $request->url_viedo;
        }  if($request->sort){
            $program->sort = $request->sort;
        }

        if($request->price_note_en){
            $program->price_note_en = $request->price_note_en;
        }

        if($request->price_note_ar){
            $program->price_note_ar = $request->price_note_ar;
        }

        if($request->other_fute){
            $program->other_fute = $request->other_fute;
        }else{
            $program->other_fute = "-";
        }

        $program->Gender = $request->Gender;

        $isSave = $program->save();
        if($isSave){
            return response()->json(['status'=>true,'message_en'=>'Program updating successfully','message_ar'=>'تم تعديل البرنامج بنجاح','data'=>$program], 200);
        }
        return \response()->json([
            'status' => false,
            'message_en' => 'Error in updating program',
            'message_ar' => 'خطأ في تعديل البرنامج',
        ], 401);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //code...
            $program = Program::find($id);
            $program->is_deleted = 1;
            $isDelete = $program->save();
            if($isDelete){
                return back()->with('success', 'تم حذف البرنامج بنجاح');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'حدث خطأ أثناء حذف البرنامج');
        }
    }
    public function destroyApi($id){
        $program = Program::find($id);
        $program->is_deleted = 1;
        $isDelete = $program->save();
        if($isDelete){
            return response()->json(['status'=>true,'message_en'=>'Program deleted successfully','message_ar'=>'تم حذف البرنامج بنجاح','data'=>$program], 200);
        }
        return \response()->json([
            'status' => false,
            'message_en' => 'Error in deleting program',
            'message_ar' => 'خطأ في حذف البرنامج',
        ], 401);
    }
}

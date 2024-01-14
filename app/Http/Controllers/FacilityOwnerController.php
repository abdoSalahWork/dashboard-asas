<?php

namespace App\Http\Controllers;

use App\Models\Model\facility_owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use App\Models\Model\Company_data;
use Session;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Model\Setting_coins;
use App\Models\Model\Setting_country_city;
use App\Models\Model\Company_type;
use App\Models\Model\Program;
use DataTables;
use App\Models\Model\Media;


class FacilityOwnerController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_data = Company_data::where('id_facility_owner', session('facility')->id)->first();

        //عدد البرامج
        $programController = new ProgramController();
        $programsCount = $programController->countProgram(session('facility')->id);

        //عدد الطلاب تم الموافقه عليهم
        $countStudentsRequest_2 = $this->countStudentRequest(session('facility')->id, 2);
        //عدد الطلاب المنتظرون في الانتظار
        $countStudentsRequest_1 = $this->countStudentRequest(session('facility')->id, 1);

        //جلب اراء العملاء
        $fatherOpinionsController =  new FatherOpinionsController();
        $opinios = $fatherOpinionsController->getOpinios2($company_data->id);

        //جلب تقييم العملاء
        $companyRateController = new CompanyRateController();
        $company_rate = $companyRateController->getRateCompany($company_data->id);

        return view('facility_owner.main' , compact('company_data', 'programsCount', 'countStudentsRequest_2', 'countStudentsRequest_1','opinios','company_rate'));
    }
    public function countStudentRequest($facility_owner_id,$id_reservation_statuses)
    {
        $countStudentsRequest = DB::select("SELECT COUNT(ch_prog.id) AS count FROM `children_programs` AS ch_prog
        INNER JOIN programs AS prog ON prog.id_facility_owner = $facility_owner_id
        WHERE prog.id = ch_prog.id_program AND ch_prog.id_reservation_statuses = $id_reservation_statuses");
        return $countStudentsRequest[0]->count;

    }
    public function isNotDeletedfacility($facility_owner_id){
        return facility_owner::where('id',$facility_owner_id)->where('is_deleted','0')->count();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('facility_owner.auth.register');
    }

    public function createNewWithAadmin()
    {

        $setting_coins = Setting_coins::get();
        $city = Setting_country_city::where('type', 'city')->get();
        $country = Setting_country_city::where('type', 'country')->get();
        return view('admin.facility_owner.create', compact('setting_coins','city','country'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storefacility_ownerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:facility_owners',
            'name_corporation' => 'required|string|max:255|unique:facility_owners',
            'name_corporation_ar' => 'required|string|max:255|unique:facility_owners',
            'phone' => 'required|string|max:255|unique:facility_owners',
            'country' => 'required',
            'city' => 'required',
            'id_coins' => 'required',
            'password' => 'required|string|min:8'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $facility_owner = facility_owner::create([
            'name' => $request->name,
            'name_corporation' => $request->name_corporation,
            'name_corporation_ar' => $request->name_corporation_ar,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);
        $statusCompanyData = null;
        try {
            //code...
            $company_data = new Company_data();
            $company_data->desception_en = '-';
            $company_data->desception_ar = '-';
            if($request->latitude){
                $company_data->latitude = $request->latitude;
            }else{
                $company_data->latitude = 0.00;
            }

            if($request->longitude){
                $company_data->longitude = $request->longitude;
            }else{
            $company_data->longitude = 0.00;
            }
            $company_data->id_facility_owner = $facility_owner->id;
            $company_data->id_country = $request->country;
            $company_data->id_city = $request->city;
            $company_data->id_coins = $request->id_coins;
            $company_data->id_company_type = '-';
            $company_data->logo = '-';
            $isSave = $company_data->save();
            if($isSave){
                $statusCompanyData = true;
                $company_rate = new CompanyRateController();
                $result_company_rate = $company_rate->storeApi($company_data->id);

            }else{
                $statusCompanyData = false;
            }
            Auth()->facility = $facility_owner;
            $request->Session()->put('facility', $facility_owner);
            $request->Session()->put('facility_id', $facility_owner->id);
            if($request->has('notLogin')){
                return back()->with('success', 'تم تسجيل الحساب بنجاح');
            }
            return redirect('/login_page/facility');
        } catch (\Throwable $th) {
            //throw $th;
            return \back()->with('error', $th->getMessage());
        }
    }

    public function showFromAdmin(){

        return view('admin.facility_owner.show');
    }

    public function showFromAdminList(Request $request){


        if ($request->ajax()) {
            $facility = DB::table('facility_owners')
            ->join('company_rates', 'company_rates.id_company', '=', 'facility_owners.id')
            ->select('facility_owners.*', 'company_rates.rate_total')
            // ->where('facility_owners.is_deleted', '=', 0)
            ->orderBy('facility_owners.id','DESC')
            ->get();
            return Datatables::of($facility)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="facilityAdmin/edit/'.$row->id.'"class="btn btn-sm btn-primary">تعديل</a>';
                    return $actionBtn;
                })
                ->addColumn('rate', function($row){
                    $actionBtn = '<div class="rating">
                    <div class="rating-label me-2 ">
                        <span class="fa fa-star checked"></span> | '.$row->rate_total.'
                    </div>
                </div>';
                    return $actionBtn;
                })
                ->addColumn('is_deleted', function($row){
                    $actionBtn = $row->is_deleted == 0 ? '<span class="badge badge-success">مفعل</span>' : '<span class="badge badge-danger">غير مفعل</span>';
                    return $actionBtn;
                })
                ->addColumn('id', function($row){
                    $actionBtn = '<span class="text-danger font-weight-bold">'. $row->id .'</span>';
                    return $actionBtn;
                })
                ->rawColumns(['action','rate','is_deleted','id'])
                ->make(true);
        }
    }

    public function getName_corporation($id_facility_owner){
        $name_corporation = facility_owner::where('id', $id_facility_owner)->first(['name_corporation']);
        return $name_corporation;
    }
    public function getDevice_token($id_facility_owner){
        $device_token = facility_owner::where('id', $id_facility_owner)->first(['device_token']);
        return $device_token;
    }

    public function storeApi(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255|unique:facility_owners',
            'name_corporation' => 'required|string|max:255|unique:facility_owners',
            'name_corporation_ar' => 'required|string|max:255|unique:facility_owners',
            'phone' => 'required|string|max:255|unique:facility_owners',
            'password' => 'required|string|min:8',
            // 'device_token'=>'required',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        if($request->device_token){
            $device_token = $request->device_token;
        }else{
            $device_token = null;
        }
        $facility_owner = facility_owner::create([
            'name' => $request->name,
            'name_corporation' => $request->name_corporation,
            'name_corporation_ar' => $request->name_corporation_ar,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'device_token'=>$device_token

        ]);

        $statusCompanyData = null;
        try {
            //code...
            $company_data = new Company_data();
            $company_data->desception_en = '-';
            $company_data->desception_ar = '-';
            $company_data->latitude = 0.00;
            $company_data->longitude = 0.00;
            $company_data->id_facility_owner = $facility_owner->id;
            $company_data->id_country = 1;
            $company_data->id_city = 1;
            $company_data->id_company_type = '-';
            $company_data->logo = '-';
            $isSave = $company_data->save();
            if($isSave){
                $statusCompanyData = true;
                $company_rate = new CompanyRateController();
                $result_company_rate = $company_rate->storeApi($company_data->id);

            }else{
                $statusCompanyData = false;
            }

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>false, 'message_ar'=>'حدث خطأ أثناء إضافة البيانات', 'message_en'=>'Error while adding data', 'error'=>$th->getMessage()]);
        }

        $token = $facility_owner->createToken('auth_token')->plainTextToken;
        return response()->json(['status' => true, 'data'=>$facility_owner,'status_company_data'=>$statusCompanyData, 'token' => $token, 'token_type' => 'Bearer']);

    }

    public function socialLogin(Request $request)
    {
        // $provider = "facebook"; // or $request->input('provider_name') for multiple providers
        $provider = $request->provider_name;
        $token = $request->access_token;
        if($provider == 'facebook'){
            $provicerCullom = 'facebook_id';
        }else{
            $provicerCullom = 'google_id';
        }
        $providerUser = Socialite::driver($provider)->userFromToken($token);

        $facility = facility_owner::where($provicerCullom, $providerUser->id)->first();

        //return \response()->json($providerUser->getName());
        if($facility == null){
            $facility = facility_owner::create([
                // 'provider_name' => $provider,
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'password' => Hash::make($providerUser->getName().'@'.$providerUser->getId()),
                'phone' => '-',
                // 'id_country' => $request->id_country,
                // 'id_city' => $request->id_city,
                'name_corporation'=>$request->name_corporation,
                'name_corporation_ar'=>$request->name_corporation_ar,
                $provicerCullom => $providerUser->id,
            ]);

            $statusCompanyData = null;
            try {
                //code...
                $company_data = new Company_data();
                $company_data->desception_en = '-';
                $company_data->desception_ar = '-';
                $company_data->latitude = 0.00;
                $company_data->longitude = 0.00;
                $company_data->id_facility_owner = $facility->id;
                $company_data->id_country = 1;
                $company_data->id_city = 1;
                $company_data->id_company_type = '-';
                $company_data->logo = '-';
                $isSave = $company_data->save();
                if($isSave){
                    $statusCompanyData = true;
                    $company_rate = new CompanyRateController();
                    $result_company_rate = $company_rate->storeApi($company_data->id);

                }else{
                    $statusCompanyData = false;
                }

            } catch (\Throwable $th) {
                //throw $th;
                return response()->json(['status'=>false, 'message_ar'=>'حدث خطأ أثناء إضافة البيانات', 'message_en'=>'Error while adding data', 'error'=>$th->getMessage()]);
            }
        }
            $token = $facility->createToken('auth_token')->plainTextToken;
            return response()
                ->json(['status' => 'success ', 'data'=>$facility ,'access_token' => $token, 'token_type' => 'Bearer']);

        //$token = $father->createToken(env('APP_NAME'))->accessToken;
        // return the token for usage
        /*return response()->json([
            'success' => true,
            'token' => $token
        ]);*/
    }

    public function login(Request $request)
    {
        if (!$request->only('name', 'password'))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $facility_owner = facility_owner::where('name', $request['name'])->first();
        if(!$facility_owner)
        {
            return response()
            ->json(['status'=>false,'message_en' => 'Wrong user or password', 'message_ar'=>'كلمة المرور او اسم المستخدم خاطئ'], 401);

        }

        if($facility_owner->is_deleted == 1){
            return response()
            ->json(['status'=>false,'message_en' => 'Your account has been disabled, please check with the admins.', 'message_ar'=>'تم تعطيل حسابك يرجا مراجعة المسؤولين'], 401);
        }
        // return response()->json(["data"=>$facility_owner, "pass"=>Hash::make($request['password'])]);
        if( Hash::check($request['password'],$facility_owner->password) && $facility_owner->name = $request->name){
            $token = $facility_owner->createToken('auth_token')->plainTextToken;
            $facility_owner->update([
                'device_token'=>$request->device_token,
            ]);
            return response()
            ->json(['status' => true, 'data'=>$facility_owner ,'access_token' => $token, 'token_type' => 'Bearer']);
        }
        return response()
            ->json(['status'=>false,'message_en' => 'Wrong user or password', 'message_ar'=>'كلمة المرور او اسم المستخدم خاطئ'], 401);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message_en' => 'You have successfully logged out and the token was successfully deleted',
            'message_ar' => 'تم تسجيل الخروج بنجاح وحذف التوكن بنجاح'
        ];
    }

    public function loginPage()
    {
        return view('facility_owner.auth.login');
    }
    public function loginDashboard(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        // $creadentials = $request->only('name', 'password');
        $creadentials = facility_owner::where('name', $request['name'])->first();
        if(!$creadentials)
        {
            return back()->with('success','Wrong user or password');
        }
        if( Hash::check($request['password'],$creadentials->password) && $creadentials->name = $request->name){
            Auth()->facility = $creadentials;
            $request->Session()->put('facility', $creadentials);
            $request->Session()->put('facility_id', $creadentials->id);
            return redirect('/facility_m');
            return view('facility_owner.main');
        }
        return back()->withSuccess('Login details are not valid');
    }

    public function logoutDashboard(Request $request){
        Auth()->logout();
        $request->session()->flush();
        return redirect('/login_page/facility');
    }

    public function getPestTop_10_Facility(){
        $arr_top_facility = [];
        // $pest = DB::select("SELECT COUNT(ch2.id_program) AS countCh, ch2.id_program FROM children_programs
        //         INNER JOIN children_programs AS ch2 ON children_programs.id = ch2.id GROUP BY ch2.id_program
        //         ORDER BY countCh DESC
        //         LIMIT 10
        // ");

        //بتجيب اكثر البرامج مشترك بيها
        $best = DB::select("SELECT COUNT(ch2.id_program) AS countCh, ch2.id_program FROM children_programs
                INNER JOIN programs ON programs.id = children_programs.id_program AND programs.is_deleted = 0
                INNER JOIN children_programs AS ch2 ON children_programs.id = ch2.id GROUP BY ch2.id_program
                ORDER BY countCh DESC
                LIMIT 50");
        //بتجيب بيانات المؤسسه للبرنامج الي اجا من فوق
        foreach ($best as $key => $value) {
            $id_prog = $value->id_program;
            $facility = DB::select("SELECT COUNT(programs.id) AS programCount, facility_owners.id AS fa_id, facility_owners.name_corporation,  facility_owners.name_corporation_ar, facility_owners.phone, facility_owners.is_deleted, company_datas.logo, company_rates.rate_total
            FROM programs
            INNER JOIN children_programs ON programs.id = children_programs.id_program
            INNER JOIN facility_owners ON programs.id_facility_owner = facility_owners.id
            INNER JOIN company_datas ON company_datas.id_facility_owner = facility_owners.id
            INNER JOIN company_rates ON company_rates.id_company = company_datas.id
            WHERE programs.id = $id_prog
            GROUP BY programs.id, facility_owners.name_corporation, facility_owners.name_corporation_ar, facility_owners.phone, company_datas.logo, company_rates.rate_total, facility_owners.id, facility_owners.is_deleted");

            array_push($arr_top_facility, $facility);
        }
        // return $arr_top_facility;
        return view('admin.facility_owner.top_best', compact('arr_top_facility'));
    }

    public function facility_program_page(){
        return view('admin.facility_owner.facility_program');
    }
    public function facility_program(Request $request)
    {
        try {
            if ($request->ajax()) {
                $fac_prog = DB::table('facility_owners')
                    ->join('company_datas', 'company_datas.id_facility_owner', '=', 'facility_owners.id')
                    ->join('company_rates', 'company_rates.id_company', '=', 'company_datas.id')
                    ->join('company_types', 'company_types.id', '=', 'company_datas.id_company_type')
                    ->select(
                        'facility_owners.*',
                        'company_datas.longitude',
                        'company_datas.latitude',
                        'company_types.type_name_ar',
                        'company_rates.rate_total',
                        DB::raw('(SELECT COUNT(id) FROM programs WHERE id_facility_owner = facility_owners.id) as program_count')
                    )
                    ->get();

                return Datatables::of($fac_prog)
                    ->addIndexColumn()
                    ->addColumn('rate', function ($row) {
                        $actionBtn = '<div class="rating">
                        <div class="rating-label me-2">
                            <span class="fa fa-star checked"></span> | ' . $row->rate_total . '
                        </div>
                    </div>';
                        return $actionBtn;
                    })
                    ->addColumn('is_deleted', function ($row) {
                        $actionBtn = $row->is_deleted == 0 ? '<span class="badge badge-success">مفعل</span>' : '<span class="badge badge-danger">غير مفعل</span>';
                        return $actionBtn;
                    })
                    ->addColumn('id', function ($row) {
                        $actionBtn = '<span class="text-danger font-weight-bold">' . $row->id . '</span>';
                        return $actionBtn;
                    })
                    ->addColumn('longLat', function ($row) {
                        $actionBtn = $row->longitude . "," . $row->latitude;
                        return $actionBtn;
                    })
                    ->addColumn('company_type', function ($row) { // Added id_company_type column
                        $actionBtn = $row->type_name_ar;
                        return $actionBtn;
                    })
                    ->addColumn('program_count', function ($row) { // Added id_company_type column
                        $actionBtn = $row->program_count;
                        return $actionBtn;
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '<a href="' . URL('admin/facilityAdmin/edit') . '/' . $row->id . '" class="btn btn-sm btn-primary">فتح</a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['rate', 'is_deleted', 'id', 'longLat', 'id_company_type', 'action']) // Added id_company_type
                    ->make(true);
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\facility_owner  $facility_owner
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return facility_owner::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\facility_owner  $facility_owner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facility_owner = facility_owner::find(session('facility')->id);
        $company_data = Company_data::where('id_facility_owner', session('facility')->id)->first();
        $setting_coins = Setting_coins::get();
        $city = Setting_country_city::where('type', 'city')->get();
        $country = Setting_country_city::where('type', 'country')->get();
        $company_type = Company_type::orderBy('sort', 'DESC')->get();
        return view('facility_owner.profile.main', compact('facility_owner', 'company_data', 'city', 'country', 'setting_coins', 'company_type'));

    }

    public function editAdmin($id)
    {
        $facility_owner = facility_owner::find($id);
        $company_data = Company_data::where('id_facility_owner', $id)->first();
        $setting_coins = Setting_coins::get();
        $city = Setting_country_city::where('type', 'city')->get();
        $country = Setting_country_city::where('type', 'country')->get();
        $company_type = Company_type::orderBy('sort', 'DESC')->get();
        $programs = Program::where('id_facility_owner', $id)->where("is_deleted","0")->orderBy('sort', 'DESC')->get();
        $my_coins = Setting_coins::find($company_data->id_coins);
        $media = Media::where('id_',$id)->where('table_name','company')->get();
        return view('admin.facility_owner.update', compact('facility_owner', 'company_data', 'city', 'country', 'setting_coins', 'company_type', 'programs', 'my_coins', 'media'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatefacility_ownerRequest  $request
     * @param  \App\Models\Model\facility_owner  $facility_owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'name_corporation' => 'required|string|max:255',
            'name_corporation_ar' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $facility_owner = facility_owner::find($id);
        $facility_owner->name = $request->name;
        $facility_owner->name_corporation = $request->name_corporation;
        $facility_owner->name_corporation_ar = $request->name_corporation_ar;
        $facility_owner->phone = $request->phone;
        $isSave = $facility_owner->save();
        if($isSave)
            return \back()->with('success', 'تم تحديث البيانات بنجاح');
        return \back()->with('error', 'حدث خطأ أثناء تحديث البيانات');

    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            //code...
            $facility_owner = facility_owner::find(session('facility')->id);
            if(!Hash::check($request->old_password, $facility_owner->password)){
                return redirect()->back()->with('error', 'كلمة المرور القديمة غير صحيحة');
            }


            $facility_owner->password = Hash::make($request->password);
            $facility_owner->save();
            return \back()->with('success', 'تم تحديث البيانات بنجاح');
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\facility_owner  $facility_owner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //code...
            $facility_owner = facility_owner::find($id);
            if($facility_owner->is_deleted == 1){
                $facility_owner->is_deleted = 0;
            }else{
                $facility_owner->is_deleted = 1;
            }
            $facility_owner->save();
            return redirect()->back()->with('success', 'تم العملية البيانات بنجاح');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'حدث خطأ أثناء العملية ');
        }
    }

    public function activeAll(){
        try {
            //code...
            $facility_owner = facility_owner::where('is_deleted', 1)->get();
            foreach ($facility_owner as $key => $value) {
                $value->is_deleted = 0;
                $value->save();
            }
            return redirect()->back()->with('success', 'تم العملية البيانات بنجاح');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'حدث خطأ أثناء العملية ');
        }
    }
}

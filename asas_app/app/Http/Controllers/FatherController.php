<?php

namespace App\Http\Controllers;

use App\Models\Model\Father;
use App\Models\Favorite;
use App\Http\Requests\StoreFatherRequest;
use App\Http\Requests\UpdateFatherRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use DataTables;


class FatherController extends Controller
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
    public function getSingleFather()
    {
        $father = Father::find(Auth::user()->id);
        return response()->json(['status'=>true, 'message_ar'=>"تم التعديل بنجاح", 'message_en'=>"Successfully updated", 'data'=>$father]);
    }

    public function updateFather(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'id_country' => 'required|numeric',
            'id_city' => 'required|numeric',
            'id_coins' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        try {
            //code...
            $father = Father::find(Auth()->user()->id);
            $father->name = $request->name;
            $father->phone = $request->phone;
            $father->id_country = $request->id_country;
            $father->id_city = $request->id_city;
            $father->id_coins = $request->id_coins;
            if($request->password){
                $father->password = Hash::make($request->password);
            }
            $isUpdate = $father->save();
            if($isUpdate)
                return response()->json(['status'=>true, 'message_ar'=>"تم التعديل بنجاح", 'message_en'=>"Successfully updated", 'data'=>$father]);
            else
                return response()->json(['status'=>false, 'message_ar'=>"حدث خطأ أثناء التعديل", 'message_en'=>"Error while updating"]);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>false, 'message_ar'=>"حدث خطأ أثناء التعديل", 'message_en'=>"Error while updating"]);

        }



    }

    public function loginUsingFacebook()
    {
       return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook()
    {
     try {
          $user = Socialite::driver('facebook')->user();
   
          $saveUser = Father::updateOrCreate([
              'facebook_id' => $user->getId(),
          ],[
              'name' => $user->getName(),
              'email' => $user->getEmail(),
              'password' => Hash::make($user->getName().'@'.$user->getId())
               ]);
   
          Auth::loginUsingId($saveUser->id);
   
          return redirect()->route('home');
          } catch (\Throwable $th) {
             throw $th;
          }
    }



    /**
 * Social Login
 */
    public function socialLogin(Request $request)
    {
        $validator = Validator::make($request->all(),[
            // 'name' => 'required|string|max:255|unique:fathers',
            // 'phone' => 'required|string|max:255|unique:fathers',
            // 'password' => 'required|string|min:8',
            'id_country' => 'required|string|max:255',
            'id_city' => 'required|string|max:255',
            'device_token'=>'required',

        ]);

        if($validator->fails()){
            return response()->json(['status'=>false, 'message_ar'=>'يجب تعبئة كامل البيانات','message_an'=>'please enter all faild' ,'error'=>$validator->errors()]);       
        }
        // $provider = "facebook"; // or $request->input('provider_name') for multiple providers
        $provider = $request->provider_name;
        $token = $request->access_token;
        if($provider == 'facebook'){
            $provicerCullom = 'facebook_id';
        }else{
            $provicerCullom = 'google_id';
        }
        $providerUser = Socialite::driver($provider)->userFromToken($token);

        $father = Father::where($provicerCullom, $providerUser->id)->first();

        //return \response()->json($providerUser->getName());
        if($father == null){
            $father = Father::create([
                // 'provider_name' => $provider,
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'password' => Hash::make($providerUser->getName().'@'.$providerUser->getId()),
                'phone' => '-',
                'id_country' => $request->id_country,
                'id_city' => $request->id_city,
                $provicerCullom => $providerUser->id,
                'device_token'=>$request->device_token,
            ]);
        }else{
            $father->update([
                'device_token'=>$request->device_token,
            ]);
        }
            $token = $father->createToken('auth_token')->plainTextToken;
            return response()
                ->json(['status' =>true , 'data'=>$father ,'access_token' => $token, 'token_type' => 'Bearer']);
                
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

        $father = Father::where('name', $request['name'])->first();
        // dd($father);
        if(!$father){
            return response()
            ->json(['status'=>false,'message_en' => 'Wrong user or password', 'message_ar'=>'كلمة المرور او اسم المستخدم خاطئ'], 401);
        }

        if($father->is_deleted == 1)
        {
            return response()
            ->json(['status'=>false,'message_en' => 'Your account has been disabled, please check with the admins.', 'message_ar'=>'تم تعطيل حسابك يرجا مراجعة المسؤولين'], 401);
        }
        // return response()->json(["data"=>$facility_owner, "pass"=>Hash::make($request['password'])]);
        if( Hash::check($request['password'],$father->password) && $father->name = $request->name){
            $token = $father->createToken('auth_token')->plainTextToken;
            
            $father->update([
                'device_token'=>$request->device_token,
            ]);

            return response()
            ->json(['status' => true, 'data'=>$father ,'access_token' => $token, 'token_type' => 'Bearer']);
        }
        return response()
            ->json(['status'=>false,'message_en' => 'Wrong user or password', 'message_ar'=>'كلمة المرور او اسم المستخدم خاطئ'], 401);
    }


    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255|unique:fathers',
            'phone' => 'required|string|max:255|unique:fathers',
            'password' => 'required|string|min:8',
            'id_country' => 'required|string|max:255',
            'id_city' => 'required|string|max:255',
            
            // 'device_token'=>'required',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $father = new Father();
        $father->name = $request->name;
        $father->phone = $request->phone;
        if($request->email){
            $father->email = $request->email;
        }
        $father->id_country = $request->id_country;
        $father->id_city = $request->id_city;
        
        if($request->id_coins){
            $father->id_coins = $request->id_coins;
        }
        $father->password = Hash::make($request->password);
        if($request->device_token){
            $father->device_token = $request->device_token;
        }
        $father->save();

        $locationFatehrController = new LocationFatherController();
        $locationFatehrController->storeApi($father->id, '0.00', '0.00', 'home');
        $locationFatehrController->storeApi($father->id, '0.00', '0.00', 'work');
        
        $token = $father->createToken('auth_token')->plainTextToken;
        return response()
            ->json(['status' => true, 'data'=>$father ,'access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function showFromAdmin(){
        // $settingCountryCityController = new SettingCountryCityController();
        // $countries = $settingCountryCityController->show_country();
        // $cities = $settingCountryCityController->show_city();
        // $father = Father::orderBy('id','DESC')->paginate(10);
        return view('admin.fathers.show');
    }

    public function showFromAdmin_list(Request $request){
        if ($request->ajax()) {
            $father = Father::orderBy('id','DESC')->get();
            
            return Datatables::of($father)
                ->addIndexColumn()
                ->addColumn('is_deleted', function($row){
                    $actionBtn = $row->is_deleted == 0 ? '<span class="badge badge-success">مفعل</span>' : '<span class="badge badge-danger">غير مفعل</span>';
                    return $actionBtn;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="father/'.$row->id.'/edit"class="btn btn-sm btn-primary">تعديل</a>';  
                    return $actionBtn;
                })

                ->rawColumns(['is_deleted','action',])
                ->make(true);
        }
    }

    public function count_father(){
        $father = Father::count();
        return $father;
    }

    public function fatherCountry()
    {
        # code...
        $fathers = DB::select('SELECT COUNT(fathers.id) AS countFather, cc.name_ar AS country FROM fathers
        INNER JOIN setting_country_cities AS cc ON fathers.id_country = cc.id AND cc.type="country" GROUP BY cc.name_ar');
        $arr_country = [];
        $arr_count = [];
        $arr_result = [];
        foreach ($fathers as $key => $value) {
            # code...
            $arr_country[] = $value->country;
            $arr_count[] = $value->countFather;
        }
        $arr_result = [
            $arr_country,
            $arr_count
        ];
        return $arr_result;
    }

    public function AddfavoriteCompany($company_id){

        try {
            $isFav = Favorite::where('company_id', $company_id)->where('father_id', Auth::user()->id)->first();
            if($isFav){
                return response()->json(['status'=>false,'message_en' => 'This company is already in your favorite list', 'message_ar'=>'هذا الشركة موجود بالفعل في قائمة المفضلة'], 401);
            }
            //code...
            $favorite = new Favorite();
            $favorite->father_id = Auth()->user()->id;
            $favorite->company_id = $company_id;
            $isSave = $favorite->save();
            if($isSave){
                return response()->json(['status'=>true,'message_ar'=>'تمت الاضافة بنجاح', 'message_en'=>'Added successfully', 'id'=>$favorite->id], 200);
            }

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>false,'message_ar'=>'حدث خطأ أثناء الاضافة', 'message_en'=>'Error while adding', 'dev'=>$th->getMessage()]);
        }
    }
    public function removeFavoruteCompany($favorite_id){
        try {
            //code...
            $favorite = Favorite::find($favorite_id);
            $isDelete = $favorite->delete();
            if($isDelete){
                return response()->json(['status'=>true,'message_ar'=>'تمت الازاله بنجاح', 'message_en'=>'Delete successfully']);
            }

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>false,'message_ar'=>'حدث خطأ أثناء الازاله', 'message_en'=>'Error while Deleted', 'dev'=>$th->getMessage()]);
        }
    }
    public function getFavorateCompany(){
        try {
            //code...
            $favorites = DB::table('favorites')
            ->join('company_datas', 'company_datas.id', '=', 'favorites.company_id')
            ->join('company_rates', 'company_datas.id', '=', 'company_rates.id_company')
            ->join('facility_owners', 'company_datas.id_facility_owner', '=', 'facility_owners.id')
            ->select('favorites.id AS favorate_id','company_datas.*', 'company_rates.rate_total', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
            ->where('favorites.father_id', Auth::user()->id)
            ->where('facility_owners.is_deleted','0')
            ->paginate(10);
            return response()->json(['status'=>true,'data'=>$favorites]);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>false,'message_ar'=>'حدث خطأ أثناء الاضافة', 'message_en'=>'Error while adding', 'dev'=>$th->getMessage()]);
        }
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
     * @param  \App\Http\Requests\StoreFatherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFatherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Father  $father
     * @return \Illuminate\Http\Response
     */
    public function show(Father $father)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Father  $father
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $settingCountryCityController = new SettingCountryCityController();
        $countries = $settingCountryCityController->show_country();
        $cities = $settingCountryCityController->show_city();

        $coinsController = new SettingCoinsController();
        $coins = $coinsController->getCoinsList();
        $father = Father::find($id);
        return view('admin.fathers.edit', compact('father', 'countries', 'cities', 'coins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFatherRequest  $request
     * @param  \App\Models\Model\Father  $father
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \validator($request->all())->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'id_country' => 'required|numeric',
            'id_city' => 'required|numeric',
            'id_coins' => 'required'
        ]);
        
        $father = Father::find($id);
        $father->name = $request->name;
        $father->phone = $request->phone;
        $father->id_country = $request->id_country;
        $father->id_city = $request->id_city;
        $father->id_coins = $request->id_coins;
        if($request->password){
            $father->password = Hash::make($request->password);
        }
        $isUpdate = $father->save();
        if($isUpdate)
            return back()->with('success', 'تم تحديث البيانات بنجاح');
         return back()->with('error', 'يوجد خطا بتعديل البيانات');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Father  $father
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //code...
            $father = Father::find($id);
            if($father->is_deleted == 0){
                $father->is_deleted = 1;
            }else{
                $father->is_deleted = 0;
            }
            $isDelete = $father->save();
            return back()->with('success', 'تم العملية بنجاح');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'يوجد خطا بالعملية');
        }

    }
}

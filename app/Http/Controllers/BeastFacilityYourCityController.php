<?php

namespace App\Http\Controllers;

use App\Models\BeastFacilityYourCity;
use App\Http\Requests\StoreBeastFacilityYourCityRequest;
use App\Http\Requests\UpdateBeastFacilityYourCityRequest;
use Illuminate\Http\Request;
use Validator;
use App\Models\Model\facility_owner;
use Illuminate\Support\Facades\DB;

class BeastFacilityYourCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = BeastFacilityYourCity::orderBy('id','desc')->get();
        $data = DB::table('beast_facility_your_cities')
        ->join('facility_owners','facility_owners.id','beast_facility_your_cities.Facility_Id')
        ->join('setting_country_cities','setting_country_cities.id','beast_facility_your_cities.City_Id')
        ->select("beast_facility_your_cities.*","facility_owners.name_corporation as name_corporation","setting_country_cities.name_ar as cityName")
        ->where('facility_owners.is_deleted','0')
        ->orderBy('id','desc')->get();

        $facility_owner = facility_owner::where('is_deleted','0')->orderBy('id','DESC')->get();
        $settingCountryCityController = new SettingCountryCityController();
        $cities = $settingCountryCityController->show_city();
        return \view("admin.BeastFacilityYourCity.main", compact('data','facility_owner','cities'));
    }

    public function ShowApi($city_id, $type_sort = null)
    {
        
        if($type_sort == 'rate'){
            $data = DB::table('beast_facility_your_cities')
            ->join('facility_owners','facility_owners.id','beast_facility_your_cities.Facility_Id')
            ->join('company_datas','company_datas.id_facility_owner','facility_owners.id')
            ->join('setting_country_cities','setting_country_cities.id','beast_facility_your_cities.City_Id')
            ->leftjoin('company_rates', 'facility_owners.id', '=', 'company_rates.id_company')
            
            ->select("company_datas.*","facility_owners.name_corporation as name_corporation","facility_owners.name_corporation_ar as name_corporation_ar","setting_country_cities.name_ar as cityName",'company_rates.rate_total')
            
            ->where('facility_owners.is_deleted','0')
            ->where('beast_facility_your_cities.City_Id','=',$city_id)
            ->orderBy('company_rates.rate_total','DESC')

            ->paginate(10);
        }else{
            $data = DB::table('beast_facility_your_cities')
            ->join('facility_owners','facility_owners.id','beast_facility_your_cities.Facility_Id')
            ->join('company_datas','company_datas.id_facility_owner','facility_owners.id')
            ->join('setting_country_cities','setting_country_cities.id','beast_facility_your_cities.City_Id')
            ->leftjoin('company_rates', 'facility_owners.id', '=', 'company_rates.id_company')
            
            ->select("company_datas.*","facility_owners.name_corporation as name_corporation","facility_owners.name_corporation_ar as name_corporation_ar","setting_country_cities.name_ar as cityName",'company_rates.rate_total')
            
            ->where('facility_owners.is_deleted','0')
            ->where('beast_facility_your_cities.City_Id','=',$city_id)
            ->orderBy('id','desc')->paginate(10);
            
        }
        return response()->json(['status'=>true,'message_en'=>'Company data found successfully','message_ar'=>'تم العثور على بينات الشركة بنجاح','data'=>$data], 200);

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
     * @param  \App\Http\Requests\StoreBeastFacilityYourCityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'Facility_Id' => 'required',
            'City_Id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        try {
            $beastFacilityYourCity = new BeastFacilityYourCity();
            $beastFacilityYourCity->Facility_Id = $request->Facility_Id;
            $beastFacilityYourCity->City_Id = $request->City_Id;
            $isSave = $beastFacilityYourCity->save();
            if($isSave)
                return back()->with('success', 'تم الاضافة بنجاح');
            return back()->with('error', 'حدث خطأ ما');

        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'حدث خطأ ما');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BeastFacilityYourCity  $beastFacilityYourCity
     * @return \Illuminate\Http\Response
     */
    public function show(BeastFacilityYourCity $beastFacilityYourCity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BeastFacilityYourCity  $beastFacilityYourCity
     * @return \Illuminate\Http\Response
     */
    public function edit(BeastFacilityYourCity $beastFacilityYourCity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBeastFacilityYourCityRequest  $request
     * @param  \App\Models\BeastFacilityYourCity  $beastFacilityYourCity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'Facility_Id' => 'required',
            'City_Id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        try {
            $beastFacilityYourCity = BeastFacilityYourCity::find($id);
            $beastFacilityYourCity->Facility_Id = $request->Facility_Id;
            $beastFacilityYourCity->City_Id = $request->City_Id;
            $isSave = $beastFacilityYourCity->save();
            if($isSave)
                return back()->with('success', 'تم الاضافة بنجاح');
            return back()->with('error', 'حدث خطأ ما');

        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'حدث خطأ ما');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BeastFacilityYourCity  $beastFacilityYourCity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $beastFacilityYourCity = BeastFacilityYourCity::find($id);
        $isDelete = $beastFacilityYourCity->delete();
        if($isDelete)
            return redirect()->back()->with('success', 'تم حذف البيانات بنجاح');
         return \back()->with('error', 'لم يتم حذف البيانات بنجاح');
    }
}

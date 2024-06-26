<?php

namespace App\Http\Controllers;

use App\Models\Model\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{

    public function index()
    {
        $setting_country = Setting_country_city::where('type', 'country')->get();
        // $setting_city = Setting_country_city::where('type', 'city')->get();

        $setting_city = DB::table('setting_country_cities as c1')
            ->leftjoin('setting_country_cities as c2', 'c1.id_country', '=', 'c2.id')
            ->where('c1.id_country', '!=', "0")
            ->select('c1.*', 'c2.name_en as country_name_en', 'c2.name_ar as country_name_ar', 'c2.id as id_country')
            ->get();

//        $setting_area = DB::table('setting_country_cities as c1')
//            ->leftJoin('setting_country_cities as c3', 'c1.id_country', '=', 'c3.id')
//            ->leftJoin('setting_country_cities as c4', 'c3.id_country', '=', 'c4.id')
//            ->where('c1.type', 'area')
//            ->select(
//                'c1.*',
//                'c3.name_en as city_name_en',
//                'c3.name_ar as city_name_ar',
//                'c3.id as city_id',
//                'c3.id_country as city_country_id',
//                'c4.name_en as country_name_en',
//                'c4.name_ar as country_name_ar',
//                'c4.id as country_id'
//            )
//            ->get();`


//        dd($setting_area);


        // return $setting_city;

        return view('admin.setting_country_cities.main', compact('setting_country','setting_city' , 'setting_area'));
    }



    public function showApi_country(){
        $setting_country = Setting_country_city::where('type', 'country')->get();
        return response()->json(['status'=>true, 'data'=>$setting_country]);
    }

    public function showApi_city(){
        $setting_city = Setting_country_city::where('type', 'city')->get();
        return response()->json(['status'=>true, 'data'=>$setting_city]);
    }

    public function show_country(){
        $setting_country = Setting_country_city::where('type', 'country')->get();
        return $setting_country;
    }

    public function show_city(){
        $setting_city = Setting_country_city::where('type', 'city')->get();
        return $setting_city;
    }

    public function showCity_Mycountry($id_country){//بتجيب كل المدن التي تحت الدولة المحددة
        $setting_city = Setting_country_city::where('type', 'city')->where('id_country', $id_country)->get();
        return response()->json(['status'=>true, 'data'=>$setting_city]);
    }

    public function count_country_city(){
        $count_country = Setting_country_city::where('type', 'country')->count();
        $count_city = Setting_country_city::where('type', 'city')->count();
        $arr_count = [$count_country, $count_city];
        return $arr_count;
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
     * @param  \App\Http\Requests\StoreSetting_country_cityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        \validator($reqauest->all())->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $country_city = new Setting_country_city();
        $country_city->name_en = $request->name_en;
        $country_city->name_ar = $request->name_ar;
        if($request->Latitude)
            $country_city->Latitude = $request->Latitude;

        if($request->Longitude)
            $country_city->Longitude = $request->Longitude;

        $country_city->type = $request->type;
        if($request->id_country){
            $country_city->id_country = $request->id_country;
        }
        $isSave = $country_city->save();
        if($isSave)
            return redirect()->back()->with('success', 'تم اضافة البيانات بنجاح');
        return \back()->with('error', 'لم يتم اضافة البيانات بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Setting_country_city  $setting_country_city
     * @return \Illuminate\Http\Response
     */
    public function show(Setting_country_city $setting_country_city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Setting_country_city  $setting_country_city
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting_country_city $setting_country_city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSetting_country_cityRequest  $request
     * @param  \App\Models\Model\Setting_country_city  $setting_country_city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \validator($request->all())->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $country_city = Setting_country_city::find($id);
        $country_city->name_en = $request->name_en;
        $country_city->name_ar = $request->name_ar;

        if($request->Latitude)
            $country_city->Latitude = $request->Latitude;

        if($request->Longitude)
            $country_city->Longitude = $request->Longitude;

        $isSave = $country_city->save();
        if($isSave)
            return redirect()->back()->with('success', 'تم تعديل البيانات بنجاح');
        return \back()->with('error', 'لم يتم تعديل البيانات بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Setting_country_city  $setting_country_city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country_city = Setting_country_city::find($id);
        $isDelete = $country_city->delete();
        if($isDelete)
            return redirect()->back()->with('success', 'تم حذف البيانات بنجاح');
        return \back()->with('error', 'لم يتم حذف البيانات بنجاح');
    }
}

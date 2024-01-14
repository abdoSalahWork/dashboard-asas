<?php

namespace App\Http\Controllers;

use App\Models\Model\Agreements_facility;
use App\Http\Requests\StoreAgreements_facilityRequest;
use App\Http\Requests\UpdateAgreements_facilityRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;   
use App\Models\Model\Agreements;
use App\Models\Model\facility_owner;
use Illuminate\Support\Facades\DB;


class AgreementsFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $agreements_facility = DB::table('agreements_facilities')
            ->join('agreements', 'agreements.id', '=', 'agreements_facilities.id_agreement')
            ->join('facility_owners', 'facility_owners.id', '=', 'agreements_facilities.id_facility')
            ->select('agreements_facilities.*', 'agreements.name_ar', 'agreements.id AS ag_id','facility_owners.name_corporation','facility_owners.name_corporation_ar')
            ->where('agreements.is_deleted','0')
            ->where('facility_owners.is_deleted','0')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        
        $agreements = Agreements::where('is_deleted','0')->orderBy('id', 'DESC')->get();
        $facility_owner = facility_owner::where('is_deleted','0')->orderBy('id','DESC')->get();
        
        return view('admin.agreements_facility.main', \compact('agreements_facility', 'agreements', 'facility_owner'));
    }

    public function showDashboard_facility_owner(){
        $agreements_facility = DB::table('agreements_facilities')
        ->join('agreements', 'agreements.id', '=', 'agreements_facilities.id_agreement')
        ->join('facility_owners', 'facility_owners.id', '=', 'agreements_facilities.id_facility')
        ->select('agreements_facilities.*', 'agreements.name_ar','agreements.name_en','agreements.short_description_en',
                    'agreements.short_description_ar','agreements.description_en','agreements.description_ar',
                    'agreements.id AS ag_id','facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
        ->where('agreements_facilities.id_facility', session('facility')->id)
        ->where('agreements_facilities.is_deleted','0')
        ->where('agreements.is_deleted','0')
        ->where('facility_owners.is_deleted','0')
        ->orderBy('id', 'DESC')
        ->paginate(10);
        
        
        return view('facility_owner.agreements_facility.main', \compact('agreements_facility'));
    }

    public function showDashboard_facility_owner_sibgle($id){
        $agreements_facility = DB::table('agreements_facilities')
        ->join('agreements', 'agreements.id', '=', 'agreements_facilities.id_agreement')
        ->join('facility_owners', 'facility_owners.id', '=', 'agreements_facilities.id_facility')
        ->select('agreements_facilities.*', 'agreements.name_ar','agreements.name_en','agreements.short_description_en',
                    'agreements.short_description_ar','agreements.description_en','agreements.description_ar',
                    'agreements.id AS ag_id','facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
        ->where('agreements_facilities.id', $id)
        ->orderBy('id', 'DESC')
        ->first();
        
        return view('facility_owner.agreements_facility.single', \compact('agreements_facility'));

    }
    public function showApi_facility_owner(){
        try {
            //code...
            $agreements_facility = DB::table('agreements_facilities')
            ->join('agreements', 'agreements.id', '=', 'agreements_facilities.id_agreement')
            ->join('facility_owners', 'facility_owners.id', '=', 'agreements_facilities.id_facility')
            ->select('agreements_facilities.*', 'agreements.name_ar','agreements.name_en','agreements.short_description_en','agreements.short_description_ar','agreements.description_en','agreements.description_ar', 'agreements.id AS ag_id','facility_owners.name_corporation')
            ->where('agreements_facilities.id_facility', Auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->get();
            return response()->json([
                'status'=>true,
                'data' => $agreements_facility,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status'=>false,
                'message' => $th->getMessage()
            ], 500);
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
     * @param  \App\Http\Requests\StoreAgreements_facilityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_agreement' => 'required',
            'id_facility' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>false, 'message_en'=>'Please fill in all the data', 'message_ar'=>'الرجاء تعبئة جميع البيانات' ,'error'=>$validator->errors()], 401);
        }
        

        $agreements_facility = new Agreements_facility();
        $agreements_facility->id_agreement = $request->id_agreement;
        $agreements_facility->id_facility = $request->id_facility;
        if($request->end_date){
            $agreements_facility->end_date = $request->end_date;
        }else{
            $agreements_facility->end_date = '-';
            
        }

        $agreements_facility->status = $request->status;
        $agreements_facility->is_deleted = false;
        $isSave = $agreements_facility->save();
        if($isSave)
                return redirect('/admin/agreements_facility')->with('success', 'تم الاضافة بنجاح');
        return back()->with('faild','حدث خطأ غير متوقع');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Agreements_facility  $agreements_facility
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    public function search(Request $request){
        $agreements_facility = DB::table('agreements_facilities')
        ->join('agreements', 'agreements.id', '=', 'agreements_facilities.id_agreement')
        ->join('facility_owners', 'facility_owners.id', '=', 'agreements_facilities.id_facility')
        ->select('agreements_facilities.*', 'agreements.name_ar', 'agreements.id AS ag_id', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
        ->where('facility_owners.name_corporation', 'LIKE', "%{$request->agreement}%")
        ->orderBy('id', 'DESC')
        ->get();

        $agreements = Agreements::orderBy('id', 'DESC')->get();
        $facility_owner = facility_owner::orderBy('id','DESC')->get();

        return view('admin.agreements_facility.main', \compact('agreements_facility','agreements','facility_owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Agreements_facility  $agreements_facility
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agreements_facility = DB::table('agreements_facilities')
        ->join('agreements', 'agreements.id', '=', 'agreements_facilities.id_agreement')
        ->join('facility_owners', 'facility_owners.id', '=', 'agreements_facilities.id_facility')
        ->select('agreements_facilities.*', 'agreements.name_ar', 'agreements.id AS ag_id', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
        ->where('agreements_facilities.id', '=', $id)
        ->first();

        $agreements = Agreements::orderBy('id', 'DESC')->get();
        $facility_owner = facility_owner::orderBy('id','DESC')->get();

        return view('admin.agreements_facility.update', \compact('agreements_facility','agreements','facility_owner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAgreements_facilityRequest  $request
     * @param  \App\Models\Model\Agreements_facility  $agreements_facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_agreement' => 'required',
            'id_facility' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>false, 'message_en'=>'Please fill in all the data', 'message_ar'=>'الرجاء تعبئة جميع البيانات' ,'error'=>$validator->errors()], 401);
        }

        $agreements_facility = Agreements_facility::find($id);
        $agreements_facility->id_agreement = $request->id_agreement;
        $agreements_facility->id_facility = $request->id_facility;
        if($request->end_date){
            $agreements_facility->end_date = $request->end_date;
        }else{
            $agreements_facility->end_date = '-';    
        }
        $agreements_facility->status = $request->status;
        $isSave = $agreements_facility->save();
        if($isSave)
                return redirect('/admin/agreements_facility')->with('success', 'تم التعديل بنجاح');
        return back()->with('faild','حدث خطأ غير متوقع');
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Agreements_facility  $agreements_facility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agreements_facility = Agreements_facility::find($id);
        if($agreements_facility->is_deleted == 1){
            $agreements_facility->is_deleted = 0;
        }else{
            $agreements_facility->is_deleted = 1;
        }
        $isSave = $agreements_facility->save();
        if($isSave)
                return redirect('/admin/agreements_facility')->with('success', 'تم العمل بنجاح');
        return back()->with('faild','حدث خطأ غير متوقع');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Model\Company_rate;
use App\Http\Requests\StoreCompany_rateRequest;
use App\Http\Requests\UpdateCompany_rateRequest;
use Illuminate\Http\Request;
use App\Models\Rate_father_company;
use Validator;
class CompanyRateController extends Controller
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
    public function getRateCompany($id_company){
        $company_rate = Company_rate::where('id_company',$id_company)->get();
        return $company_rate;
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

    public function storeApi($id_company){
        $company_rate = new Company_rate();
        $company_rate->id_company = $id_company;
        $company_rate->scientific_level = 0;
        $company_rate->activity_level = 0;
        $company_rate->buildings_and_stadiums = 0;
        $company_rate->attention_and_communication = 0;
        $company_rate->discipline_and_cleanliness = 0;
        $company_rate->rate_total = 0;
        $company_rate->count_rate = 0;
        $isSave = $company_rate->save();
        if($isSave)
            return response()->json(['status'=>true ,'message_ar'=>'تم اضافة التقيم بنجاح', 'message_en'=>'Successfully added the rating']);
        return response()->json(['status'=>false ,'message_ar'=>'حدث خطأ أثناء اضافة تقييم', 'message_en'=>'Error add rate']);    
    }

    
    public function rateApi(Request $request){
        $validator = Validator::make($request->all(), [
            'id_company' => 'required',
            'scientific_level' => 'required',
            'activity_level' => 'required',
            'buildings_and_stadiums' => 'required',
            'attention_and_communication' => 'required',
            'discipline_and_cleanliness' => 'required',
        ]);

        try {
            //code...
            $id_company = $request->id_company;

            // $isCheck = $this->check_is_father_rate_this_company($id_company);
            // if($isCheck)
            //     return response()->json(['status'=>false ,'message_ar'=>'لا يمكنك التقييم لهذا الشركة', 'message_en'=>'You can not rate this company']);

            $rateCompany = Company_rate::where('id_company', $id_company)->first();
            if($rateCompany->scientific_level == 0){
                $rateCompany->scientific_level = $request->scientific_level;
            }else{
                $rateCompany->scientific_level = ($rateCompany->scientific_level + $request->scientific_level) / 2;
            }

            if($rateCompany->activity_level == 0){
                $rateCompany->activity_level = $request->activity_level;
            }else{
                $rateCompany->activity_level = ($rateCompany->activity_level + $request->activity_level) / 2;
            }

            if($rateCompany->buildings_and_stadiums == 0){
                $rateCompany->buildings_and_stadiums = $request->buildings_and_stadiums;
            }else{
                $rateCompany->buildings_and_stadiums = ($rateCompany->buildings_and_stadiums + $request->buildings_and_stadiums) / 2;
            }

            if($rateCompany->attention_and_communication == 0){
                $rateCompany->attention_and_communication = $request->attention_and_communication;
            }else{
                $rateCompany->attention_and_communication = ($rateCompany->attention_and_communication + $request->attention_and_communication) / 2;
            }

            if($rateCompany->discipline_and_cleanliness == 0){
                $rateCompany->discipline_and_cleanliness = $request->discipline_and_cleanliness;
            }else{
                $rateCompany->discipline_and_cleanliness = ($rateCompany->discipline_and_cleanliness + $request->discipline_and_cleanliness) / 2;
            }

            $rateCompany->rate_total = ($rateCompany->scientific_level + $rateCompany->activity_level + $rateCompany->buildings_and_stadiums + $rateCompany->attention_and_communication + $rateCompany->discipline_and_cleanliness) / 5;
            $rateCompany->count_rate = $rateCompany->count_rate + 1;
            $isSave = $rateCompany->save();
            if($isSave){
                $this->save_rate_father_company($rateCompany->id_company);
                return response()->json(['status'=>true ,'message_ar'=>'تم اضافة التقيم بنجاح', 'message_en'=>'Successfully added the rating', 'rate'=>$rateCompany]);
            }
                
            return response()->json(['status'=>false ,'message_ar'=>'حدث خطأ أثناء اضافة تقييم', 'message_en'=>'Error add rate']);
        } catch (\Exception $ex) {
            //throw $th;
            return response()->json(['status'=>false ,'message_ar'=>'حدث خطأ أثناء اضافة تقييم', 'message_en'=>'Error add rate', 'error'=>$ex->getMessage()]);

        }
        
        



    }

    public function save_rate_father_company($id_company){
        $rate_father_company = new Rate_father_company();
        $rate_father_company->id_father = Auth()->user()->id;
        $rate_father_company->id_company = $id_company;
        $isSave = $rate_father_company->save();
        if($isSave)
            return true;    
        return false;
    }

    //فحص هل تم تقيم هذه الشركة من قبل هذا الشخص
    public function check_is_father_rate_this_company($id_company){
        $rate_father_company = Rate_father_company::where('id_father',Auth()->user()->id)->where('id_company',$id_company)->first();
        if($rate_father_company)
            return true;
        return false;
    }

    public function singleRate($id_company){
        try {
            //code...
            $rateCompany = Company_rate::where('id_company', $id_company)->first();
            if($rateCompany)
                return response()->json(['status'=>true ,'message_ar'=>'تم عرض التقيم بنجاح', 'message_en'=>'Successfully view the rating', 'rate'=>$rateCompany]);
            return response()->json(['status'=>false ,'message_ar'=>'حدث خطأ أثناء عرض التقييم', 'message_en'=>'Error view rate']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>false ,'message_ar'=>'حدث خطأ أثناء عرض التقييم', 'message_en'=>'Error view rate', 'error'=>$th->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompany_rateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany_rateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Company_rate  $company_rate
     * @return \Illuminate\Http\Response
     */
    public function show(Company_rate $company_rate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Company_rate  $company_rate
     * @return \Illuminate\Http\Response
     */
    public function edit(Company_rate $company_rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompany_rateRequest  $request
     * @param  \App\Models\Model\Company_rate  $company_rate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompany_rateRequest $request, Company_rate $company_rate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Company_rate  $company_rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company_rate $company_rate)
    {
        //
    }
}

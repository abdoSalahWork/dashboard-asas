<?php

namespace App\Http\Controllers;

use App\Models\Model\Setting_coins;
use App\Http\Requests\StoreSetting_coinsRequest;
use App\Http\Requests\UpdateSetting_coinsRequest;
use Illuminate\Http\Request;
use App\Models\Model\Father;
use App\Models\Model\Company_data;


class SettingCoinsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coins = Setting_coins::orderBy('id', 'DESC')->get();
        return view('admin.setting_coins.main', compact('coins'));
    }

    public function showApi(){
        $coins = Setting_coins::orderBy('id', 'DESC')->get();
        return response()->json($coins);
    }

    public function getCoinsList(){
        $coins = Setting_coins::orderBy('id', 'DESC')->get();
        return $coins;
    }

    public function getCoins($id){
        try {
            //code...
            $coins = Setting_coins::find($id);
            return $coins;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }

    public function getCoinsLogid($id_user, $type){
        try {
            //code...
            if($type == "father"){
                $fatherCoin = Father::find($id_user);
                $coin = $this->getCoins($fatherCoin->id_coins);
            }else if($type == "facility"){
                $facilityCoin = Company_data::find($id_user);
                $coin = $this->getCoins($facilityCoin->id_coins);
            }else{
                return response()->json(['status'=>false, 'message_en'=>'Type = [father,facility ]', 'message_ar'=>'النوع = [father,facility ]' ], 401);
            }
            return response()->json(['status'=>true, 'message_en'=>'Success', 'message_ar'=>'تمت العمليه بنجاح', 'data'=>$coin ], 200);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>false, 'message_en'=>'faild', 'message_ar'=>'خطأ','error'=>$ht ]);

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
     * @param  \App\Http\Requests\StoreSetting_coinsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \validator($request->all())->validate([
            'coins_name_en' => 'required|string|max:255',
            'coins_name_ar' => 'required|string|max:255',
            'dollar' => 'required|numeric',
        ]);
        $coins = new Setting_coins();
        $coins->coins_name_en = $request->coins_name_en;
        $coins->coins_name_ar = $request->coins_name_ar;
        $coins->dollar = $request->dollar;
        if($coins->doller == 0){
           $coins->doller = 1.00;
        } 
        $isSave = $coins->save();
        if($isSave)
            return redirect()->back()->with('success', 'تم اضافة العملة بنجاح');
         return \back()->with('error', 'لم يتم اضافة العملة بنجاح');   
    }

    public function get_coin_company($id_coin){
        $coins = Setting_coins::where('id',$id_coin)->first();
        return $coins;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Setting_coins  $setting_coins
     * @return \Illuminate\Http\Response
     */
    public function show(Setting_coins $setting_coins)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Setting_coins  $setting_coins
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting_coins $setting_coins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSetting_coinsRequest  $request
     * @param  \App\Models\Model\Setting_coins  $setting_coins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //code...
            \validator($request->all())->validate([
                'coins_name_en' => 'required|string|max:255',
                'coins_name_ar' => 'required|string|max:255',
                'dollar' => 'required|numeric',
            ]);
            $coins = Setting_coins::find($id);
            $coins->coins_name_en = $request->coins_name_en;
            $coins->coins_name_ar = $request->coins_name_ar;
            $coins->dollar = $request->dollar;
            $isSave = $coins->save();
            if($isSave)
                return redirect()->back()->with('success', 'تم تعديل العملة بنجاح');
        } catch (\Throwable $th) {
            //throw $th;
            return \back()->with('error', 'لم يتم تعديل العملة بنجاح');   
        }
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Setting_coins  $setting_coins
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coins = Setting_coins::find($id);
        $isDelete = $coins->delete();
        if($isDelete)
            return redirect()->back()->with('success', 'تم حذف العملة بنجاح');
         return \back()->with('error', 'لم يتم حذف العملة بنجاح');   
    }
}

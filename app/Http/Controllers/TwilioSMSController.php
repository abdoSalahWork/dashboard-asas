<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Twilio\Rest\Client;
use App\Models\Model\Father;
use App\Models\verficationPhone;
use Validator;
use Auth; 
use App\Models\Model\facility_owner;

class TwilioSMSController extends Controller
{
    public function father_sendSMS(Request $request)
    {

 
        try {
            $validator = Validator::make($request->all(),[
                'phone' => 'required|string|max:255|unique:fathers',
            ]);
    
            if($validator->fails()){
                return response()->json($validator->errors());       
            }
            // $receiverNumber = "+970592695593";
            $code = rand(1000, 9999); 
    
            $message = "Your verification code is: $code";
            $phone = $request->phone;

            $isFound = verficationPhone::where('type_id', Auth()->user()->id)->where('type', 'father')->first();
            if($isFound){
                $isFound->code = $code;
                $isFound->phone = $phone;
                $isFound->save();
            }else{
                $saveVirfity = new verficationPhone();
                $saveVirfity->phone = $phone;
                $saveVirfity->code = $code;
                $saveVirfity->type = 'father';
                $saveVirfity->type_id = Auth()->user()->id;
                $isSave = $saveVirfity->save();
            }
            
            
            
                $account_sid = getenv("TWILIO_SID");
                $auth_token = getenv("TWILIO_TOKEN");
                $twilio_number = getenv("TWILIO_FROM");
    
                $client = new Client($account_sid, $auth_token);
                $isSenet = $client->messages->create($phone, [
                    'from' => $twilio_number, 
                    'body' => $message]);

                    
                
                return response()->json(['status'=>true, 'message_ar'=> 'تم ارسال رقم التحقق بنجاح' , 'message_en'=>'success send verfication cide',"isSenet"=>$isSenet], 200);
            
  
 
            // $saveVirfity = Father::find(auth()->user()->id);
            // $saveVirfity->vefity = $vervi;
            // $saveVirfity->is_vefity = false;
            // $isSave = $saveVirfity->save();
            // if($isSave)
            

        } catch (Exception $th) {
            return \response()->json([
                'status'=>false,
                'message_ar'=> 'حدث خطأ برجاء المحاولة مرة اخرى',
                'message_en'=>'error send verfication cide',
                'error'=>$th->getMessage()
            ], 200);
        }
    }

    public function father_getVerfication(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'code' => 'required|string|max:255',
            ]);
    
            if($validator->fails()){
                return response()->json($validator->errors());       
            }
            $code = $request->code;
            $isFound = verficationPhone::where('type_id', Auth()->user()->id)->where('type', 'father')->first();
            if($isFound){
                if($isFound->code == $code){
                    $father = Father::find(Auth()->user()->id);
                    $father->is_vefity = true;
                    $father->phone = $isFound->phone;
                    $father->save();
                    return response()->json(['status'=>true, 'message_ar'=> 'تم التحقق بنجاح' , 'message_en'=>'success verfication cide'], 200);
                }else{
                    return response()->json(['status'=>false, 'message_ar'=> 'رقم التحقق غير صحيح' , 'message_en'=>'error verfication cide'], 200);
                }
            }else{
                return response()->json(['status'=>false, 'message_ar'=> 'رقم التحقق غير صحيح' , 'message_en'=>'error verfication cide'], 200);
            }
        } catch (Exception $th) {
            return \response()->json([
                'status'=>false,
                'message_ar'=> 'حدث خطأ برجاء المحاولة مرة اخرى',
                'message_en'=>'error verfication cide',
                'error'=>$th->getMessage()
            ], 200);
        }

        return \response()->json(['verf'=>Auth()->user()->verification, 'phone'=>Auth()->user()->temp_phone, 'request-verficatuin'=>$request->verification], 200);
    }



    public function facility_sendSMS(Request $request)
    {

 
        try {
            $validator = Validator::make($request->all(),[
                'phone' => 'required|string|max:255|unique:facility_owners',
            ]);
    
            if($validator->fails()){
                return response()->json($validator->errors());       
            }
            // $receiverNumber = "+970592695593";
            $code = rand(1000, 9999); 
    
            $message = "Your verification code is: $code";
            $phone = $request->phone;

            $isFound = verficationPhone::where('type_id', Auth()->user()->id)->where('type', 'facility')->first();
            if($isFound){
                $isFound->code = $code;
                $isFound->phone = $phone;
                $isFound->save();
            }else{
                $saveVirfity = new verficationPhone();
                $saveVirfity->phone = $phone;
                $saveVirfity->code = $code;
                $saveVirfity->type = 'facility';
                $saveVirfity->type_id = Auth()->user()->id;
                $isSave = $saveVirfity->save();
            }
            
            
            
                $account_sid = getenv("TWILIO_SID");
                $auth_token = getenv("TWILIO_TOKEN");
                $twilio_number = getenv("TWILIO_FROM");
    
                $client = new Client($account_sid, $auth_token);
                $isSenet = $client->messages->create($phone, [
                    'from' => $twilio_number, 
                    'body' => $message]);

                    
                
                return response()->json(['status'=>true, 'message_ar'=> 'تم ارسال رقم التحقق بنجاح' , 'message_en'=>'success send verfication cide',"isSenet"=>$isSenet], 200);
            
  
 
            // $saveVirfity = Father::find(auth()->user()->id);
            // $saveVirfity->vefity = $vervi;
            // $saveVirfity->is_vefity = false;
            // $isSave = $saveVirfity->save();
            // if($isSave)
            

        } catch (Exception $th) {
            return \response()->json([
                'status'=>false,
                'message_ar'=> 'حدث خطأ برجاء المحاولة مرة اخرى',
                'message_en'=>'error send verfication cide',
                'error'=>$th->getMessage()
            ], 200);
        }
    }

    public function facility_getVerfication(Request $request){
        try {
            $validator = Validator::make($request->all(),[
                'code' => 'required|string|max:255',
            ]);
    
            if($validator->fails()){
                return response()->json($validator->errors());       
            }
            $code = $request->code;
            $isFound = verficationPhone::where('type_id', Auth()->user()->id)->where('type', 'facility')->first();
            if($isFound){
                if($isFound->code == $code){
                    $father = facility_owner::find(Auth()->user()->id);
                    $father->is_vefity = true;
                    $father->phone = $isFound->phone;
                    $father->save();
                    return response()->json(['status'=>true, 'message_ar'=> 'تم التحقق بنجاح' , 'message_en'=>'success verfication cide'], 200);
                }else{
                    return response()->json(['status'=>false, 'message_ar'=> 'رقم التحقق غير صحيح' , 'message_en'=>'error verfication cide'], 200);
                }
            }else{
                return response()->json(['status'=>false, 'message_ar'=> 'رقم التحقق غير صحيح' , 'message_en'=>'error verfication cide'], 200);
            }
        } catch (Exception $th) {
            return \response()->json([
                'status'=>false,
                'message_ar'=> 'حدث خطأ برجاء المحاولة مرة اخرى',
                'message_en'=>'error verfication cide',
                'error'=>$th->getMessage()
            ], 200);
        }

        return \response()->json(['verf'=>Auth()->user()->verification, 'phone'=>Auth()->user()->temp_phone, 'request-verficatuin'=>$request->verification], 200);
    }
}

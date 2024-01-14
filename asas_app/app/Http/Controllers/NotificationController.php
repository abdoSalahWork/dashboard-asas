<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model\Father;
use App\Models\Model\facility_owner;
use App\Models\Model\Company_data;
use App\Models\notification;
use App\Models\notefication_read;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $settingCountryCityController = new SettingCountryCityController();
        $country = $settingCountryCityController->show_country();
        $city = $settingCountryCityController->show_city();
        return view('notificaation.main', \compact('country', 'city'));
    }

    public function allNotifications(){
        $notifications = notification::select('id', 'title' , 'body' , 'type' , 'created_at')
            ->paginate(10);
        return view('notificaation.index' , compact('notifications'));
    }

    public function deleteNotifications($id){

        $notification = notification::find($id);
        $notification->delete();
        return \back()->with('success', 'تم حذف الاشعار بنجاح');
    }

    public function saveToken_father(Request $request)
    {
        try {
            //code...
            $father = Father::find($request->id);
            $father->device_token = $request->device_token;
            $isSave = $father->save();
            if($isSave)
                return response()->json(['success' => true, 'message_ar' => 'تم حفظ التوكن بنجاح' , 'message_en' => 'Token saved successfully'], 200);
            else
                return response()->json(['success' => false, 'message_ar' => 'حدث خطأ أثناء حفظ التوكن' , 'message_en' => 'Error while saving token'], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['success' => false, 'message_ar' => 'حدث خطأ أثناء حفظ التوكن' , 'message_en' => 'Error while saving token', 'error'=>$th->getMessage()], 200);

        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     * var type_notification = [1=> 'admin', 2=>message, 3=>new book, 4=>تغيير حالة الحجز]
     */
    public function sendNotification($title, $body, $device_token, $type_notification){
        $SERVER_API_KEY = 'AAAASG3qqzk:APA91bE5-yKsR2GwB-p8ClJRg2oFqE7ERrIWSEOoksfDUuoXtktD4flDlnO-bQUu09k8VErtFxf9veZt70X6PZ6tCSfQ4ev3Ugg9Vz0BoTS34Ggn_HMnztj__0uGcnv_y_1fxuOXcTBR';
        $firebaseToken = [$device_token];
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $title,
                "body" => $body,
                "type" => $type_notification
            ]
        ];
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);
        $response = json_decode($response);

        return $response;
    }


    //from admin
    public function sendNotification_all_father(Request $request)
    {
        \validator($request->all())->validate([
            'title' => 'required',
            'body' => 'required',
        ]);



        try {
            //code...
            $id_city = "-";
            $id_country = "-";

            $firebaseToken;
            if($request->id_country != 'empty')
            {
                $firebaseToken = Father::where('id_country', $request->id_country)->whereNotNull('device_token')->pluck('device_token')->all();
                $id_country = $request->id_country;
            }else if($request->id_city != 'empty'){
                $firebaseToken = Father::where('id_city',$request->id_city)->whereNotNull('device_token')->pluck('device_token')->all();
                $id_city = $request->id_city;
            }else{
                $firebaseToken = Father::whereNotNull('device_token')->pluck('device_token')->all();
            }
            $notification = new notification();
            $notification->title = $request->title;
            $notification->body = $request->body;
            $notification->type = 'father';
            $notification->id_country = $id_country;
            $notification->id_city = $id_city;
            $notification->save();
            $SERVER_API_KEY = 'AAAASG3qqzk:APA91bE5-yKsR2GwB-p8ClJRg2oFqE7ERrIWSEOoksfDUuoXtktD4flDlnO-bQUu09k8VErtFxf9veZt70X6PZ6tCSfQ4ev3Ugg9Vz0BoTS34Ggn_HMnztj__0uGcnv_y_1fxuOXcTBR';

            $data = [
                "registration_ids" => $firebaseToken,
                "notification" => [
                    "title" => $request->title,
                    "body" => $request->body,
                    "type" => '1'
                ]
            ];
            $dataString = json_encode($data);

            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);
            $response = json_decode($response);
            // return $response;
            if($response->success != 0){
                return \back()->with('success', 'تم ارسال الإشعار بنجاح');
            }
            else{
                return \back()->with('error', 'حدث خطأ الرجاء التأكد من صجه البيانات');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return \back()->with('error', $th->getMessage());
        }

    }

    public function getNotification_father(){
        $notifications = notification::where('type','father')
        ->where('id_type', Auth()->user()->id)
        ->orWhere('type','all')
        ->orWhere('type','father')->where('id_type', '-')
        ->orderBy('id','desc')
        ->paginate(10);



        return response()->json(['success' => true, 'notifications' => $notifications], 200);
    }

    public function getNotification_father_not_read(){
        $user_id = \auth()->user()->id;
        $notifications = DB::select("
            SELECT notifications.* FROM notifications
            LEFT JOIN notefication_reads ON notefication_reads.notefication_id = notifications.id
            WHERE notifications.id_type = $user_id
            AND notefication_reads.id IS NULL

            OR notifications.type = 'all'
            AND notefication_reads.id IS NULL

            OR notifications.type = 'father'
            AND notifications.id_type = '-'
            AND notefication_reads.id IS NULL
        ");

        //عشان لمن يفتح الاشعارات يروحن على جدول الاشعارات المقروءة
        foreach ($notifications as $key => $value) {
            $noteficationRead = new notefication_read();
            $noteficationRead->notefication_id = $value->id;
            $noteficationRead->user_id = $user_id;
            $noteficationRead->save();
        }
        return response()->json(['success' => true, 'notifications' => $notifications], 200);

    }

    public function getCountNoteficationNotRead_fahter(){
        $user_id = \auth()->user()->id;
        $notifications = DB::select("
            SELECT notifications.* FROM notifications
            LEFT JOIN notefication_reads ON notefication_reads.notefication_id = notifications.id
            WHERE notifications.id_type = $user_id
            AND notefication_reads.id IS NULL

            OR notifications.type = 'all'
            AND notefication_reads.id IS NULL

            OR notifications.type = 'father'
            AND notifications.id_type = '-'
            AND notefication_reads.id IS NULL
        ");
        return response()->json(['success' => true, 'count' => count($notifications)], 200);
    }

        //بتجيب الاشعارات المقروءة والغير مقروءة وبتخليها مقروءه
        public function getnotification_father_read_and_noteRead(){
            try {
                //code...
                $user_id = \auth()->user()->id;
                $father = Father::find($user_id);
                $id_city = $father->id_city;
                $id_country = $father->id_country;
                // $note = DB::select("SELECT notifications.*, notefication_reads.id AS id_notefication_reads FROM `notifications`
                // LEFT JOIN notefication_reads ON notifications.id = notefication_reads.notefication_id AND notefication_reads.user_id = $user_id
                // WHERE notifications.type='father' AND notifications.id_city = '-' AND notifications.id_country = '-'
                // OR notifications.type='father' AND notifications.id_city='$id_city' AND notifications.id_country = '-'
                // OR notifications.type='father' AND notifications.id_city='-' AND notifications.id_country = '$id_country'");

                $note = DB::table('notifications')
                ->leftJoin('notefication_reads', 'notifications.id', '=', 'notefication_reads.notefication_id', 'AND', 'notefication_reads.user_id', '=', $user_id)
                ->select('notifications.*', 'notefication_reads.id AS id_notefication_reads')
                ->where('notifications.type','father')
                ->where('notifications.id_city','-')
                ->where('notifications.id_country','-')
                ->orWhere('notifications.type','father')
                ->where('notifications.id_city',$id_city)
                ->where('notifications.id_country','-')
                ->orWhere('notifications.type','father')
                ->where('notifications.id_city','-')
                ->where('notifications.id_country',$id_country)
                ->orderBy('notifications.id','DESC')
                ->paginate(10);

                foreach ($note as $key => $value) {
                    if($value->id_notefication_reads == null){
                        $noteficationRead = new notefication_read();
                        $noteficationRead->notefication_id = $value->id;
                        $noteficationRead->user_id = \auth()->user()->id;
                        $noteficationRead->save();
                    }
                }
                return response()->json(['success' => true, 'data'=>$note], 200);
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json(['success' => false, 'message'=>$th->getMessage()], 200);
            }

        }
    // public function custome_sendNotification_all_father($title, $body, $id_father = null)
    // {
    //     if($id_father == null)
    //     {
    //         $firebaseToken = Father::whereNotNull('device_token')->pluck('device_token')->all();
    //         $notification = new notification();
    //         $notification->title = $title;
    //         $notification->body = $body;
    //         $notification->save();
    //     }else{
    //         $firebaseToken = Father::where('id',$request->id)->pluck('device_token')->all();
    //         $notification = new notification();
    //         $notification->title = $title;
    //         $notification->body = $body;
    //         $notification->type = 'father';
    //         $notification->id_type = $id_father;
    //         $notification->save();

    //     }
    //     $SERVER_API_KEY = 'AAAASG3qqzk:APA91bE5-yKsR2GwB-p8ClJRg2oFqE7ERrIWSEOoksfDUuoXtktD4flDlnO-bQUu09k8VErtFxf9veZt70X6PZ6tCSfQ4ev3Ugg9Vz0BoTS34Ggn_HMnztj__0uGcnv_y_1fxuOXcTBR';

    //     $data = [
    //         "registration_ids" => $firebaseToken,
    //         "notification" => [
    //             "title" => $title,
    //             "body" => $body,
    //         ]
    //     ];
    //     $dataString = json_encode($data);

    //     $headers = [
    //         'Authorization: key=' . $SERVER_API_KEY,
    //         'Content-Type: application/json',
    //     ];

    //     $ch = curl_init();

    //     curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    //     $response = curl_exec($ch);
    //     return $response;
    // }


    public function saveToken_facility(Request $request)
    {
        try {
            //code...
            $father = facility_owner::find(\auth()->user()->id);
            $father->device_token = $request->device_token;
            $isSave = $father->save();
            if($isSave)
                return response()->json(['success' => true, 'message_ar' => 'تم حفظ التوكن بنجاح' , 'message_en' => 'Token saved successfully'], 200);
            else
                return response()->json(['success' => false, 'message_ar' => 'حدث خطأ أثناء حفظ التوكن' , 'message_en' => 'Error while saving token'], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['success' => false, 'message_ar' => 'حدث خطأ أثناء حفظ التوكن' , 'message_en' => 'Error while saving token', 'error'=>$th->getMessage()], 200);

        }


    }
    //from admin
    public function sendNotification_all_facility(Request $request)
    {
        \validator($request->all())->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        try {
            $id_city = "-";
            $id_country = "-";
            //code...
            $firebaseToken;
            if($request->id_country != 'empty')
            {
                // $firebaseToken = facility_owner::where('id_country', $request->id_country)->whereNotNull('device_token')->pluck('device_token')->all();
                $firebaseToken = DB::table('facility_owners')
                                ->join('company_datas', 'facility_owners.id', '=', 'company_datas.id_facility_owner')
                                ->select('facility_owners.device_token')
                                ->where('company_datas.id_country', '=', $request->id_country)
                                ->whereNotNull('facility_owners.device_token')
                                ->pluck('device_token')
                                ->all();
                $id_country = $request->id_country;
            }else if($request->id_city != 'empty'){
                // $firebaseToken = facility_owner::where('id_city',$request->id_city)->whereNotNull('device_token')->pluck('device_token')->all();
                $firebaseToken = DB::table('facility_owners')
                ->join('company_datas', 'facility_owners.id', '=', 'company_datas.id_facility_owner')
                ->select('facility_owners.device_token')
                ->where('company_datas.id_country', '=', $request->id_city)
                ->whereNotNull('facility_owners.device_token')
                ->pluck('device_token')
                ->all();
                $id_city = $request->id_city;
            }else{
                $firebaseToken = facility_owner::whereNotNull('device_token')->pluck('device_token')->all();
            }
            $notification = new notification();
            $notification->title = $request->title;
            $notification->body = $request->body;
            $notification->type = 'facility';
            $notification->id_city = $id_city;
            $notification->id_country = $id_country;
            $notification->save();

        $SERVER_API_KEY = 'AAAASG3qqzk:APA91bE5-yKsR2GwB-p8ClJRg2oFqE7ERrIWSEOoksfDUuoXtktD4flDlnO-bQUu09k8VErtFxf9veZt70X6PZ6tCSfQ4ev3Ugg9Vz0BoTS34Ggn_HMnztj__0uGcnv_y_1fxuOXcTBR';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
                "type" => '1'

            ]

        ];

        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        $response = json_decode($response);

        if($response->success != 0){
            return \back()->with('success', 'تم ارسال الإشعار بنجاح');
        }
        else{
            return \back()->with('error', 'حدث خطأ أثناء ارسال الإشعار');
        }
    }catch(Throwable $th){
        return \back()->with('error', $th->getMessage());
    }


}

    // public function custome_sendNotification_all_facility($title, $body, $id_facility = null){

    //     if($id_facility == null)
    //     {
    //         $firebaseToken = facility_owner::whereNotNull('device_token')->pluck('device_token')->all();
    //     }else{
    //         $firebaseToken = facility_owner::where('id',$id_facility)->pluck('device_token')->all();
    //     }
    //     $SERVER_API_KEY = 'AAAASG3qqzk:APA91bE5-yKsR2GwB-p8ClJRg2oFqE7ERrIWSEOoksfDUuoXtktD4flDlnO-bQUu09k8VErtFxf9veZt70X6PZ6tCSfQ4ev3Ugg9Vz0BoTS34Ggn_HMnztj__0uGcnv_y_1fxuOXcTBR';

    //     $data = [
    //         "registration_ids" => $firebaseToken,
    //         "notification" => [
    //             "title" => $title,
    //             "body" => $body,
    //         ]
    //     ];
    //     $dataString = json_encode($data);

    //     $headers = [
    //         'Authorization: key=' . $SERVER_API_KEY,
    //         'Content-Type: application/json',
    //     ];

    //     $ch = curl_init();

    //     curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    //     $response = curl_exec($ch);

    //     dd($response);
    // }






    public function getNotification_facility(){
        $notifications = notification::where('type','facility')
        ->where('id_type', Auth()->user()->id)
        ->orWhere('type','all')
        ->orWhere('type','facility')->where('id_type', '-')
        ->orderBy('id','desc')
        ->paginate(10);

        return response()->json(['success' => true, 'notifications' => $notifications], 200);
    }

    public function getNotification_facility_not_read(){
        $user_id = \auth()->user()->id;
        $notifications = DB::select("
            SELECT notifications.* FROM notifications
            LEFT JOIN notefication_reads ON notefication_reads.notefication_id = notifications.id
            WHERE notifications.id_type = $user_id
            AND notefication_reads.id IS NULL

            OR notifications.type = 'all'
            AND notefication_reads.id IS NULL

            OR notifications.type = 'facility'
            AND notifications.id_type = '-'
            AND notefication_reads.id IS NULL
            ORDER BY notifications.id DESC
     ");

        //عشان لمن يفتح الاشعارات يروحن على جدول الاشعارات المقروءة
        foreach ($notifications as $key => $value) {
            $noteficationRead = new notefication_read();
            $noteficationRead->notefication_id = $value->id;
            $noteficationRead->user_id = $user_id;
            $noteficationRead->save();
        }
     return response()->json(['success' => true, 'notifications' => $notifications], 200);

    }

    public function getCountNoteficationNotRead_facility(){
        $user_id = \auth()->user()->id;
        $notifications = DB::select("
            SELECT notifications.* FROM notifications
            LEFT JOIN notefication_reads ON notefication_reads.notefication_id = notifications.id
            WHERE notifications.id_type = $user_id
            AND notefication_reads.id IS NULL

            OR notifications.type = 'all'
            AND notefication_reads.id IS NULL

            OR notifications.type = 'facility'
            AND notifications.id_type = '-'
            AND notefication_reads.id IS NULL

            ORDER BY notifications.id DESC
        ");
        return response()->json(['success' => true, 'count' => count($notifications)], 200);
    }


    //بتجيب الاشعارات المقروءة والغير مقروءة وبتخليها مقروءه
    public function getnotification_facility_read_and_noteRead(){
        try {
            $user_id = \auth()->user()->id;
            $company_data = company_data::where('id_facility_owner',$user_id)->first();
            $id_city = $company_data->id_city;
            $id_country = $company_data->id_country;
            //code...
            // $note = DB::select("SELECT notifications.*, notefication_reads.id AS id_notefication_reads FROM `notifications`
            // LEFT JOIN notefication_reads ON notifications.id = notefication_reads.notefication_id AND notefication_reads.user_id = $user_id
            // WHERE notifications.type='facility' AND notifications.id_city = '-' AND notifications.id_country = '-'
            // OR notifications.type='facility' AND notifications.id_city='$id_city' AND notifications.id_country = '-'
            // OR notifications.type='facility' AND notifications.id_city='-' AND notifications.id_country = '$id_country'");
            $note = DB::table('notifications')
            ->leftJoin('notefication_reads', 'notifications.id', '=', 'notefication_reads.notefication_id', 'AND', 'notefication_reads.user_id', '=', $user_id)
            ->select('notifications.*', 'notefication_reads.id AS id_notefication_reads')
            ->where('notifications.type','facility')
            ->where('notifications.id_city','-')
            ->where('notifications.id_country','-')
            ->orWhere('notifications.type','facility')
            ->where('notifications.id_city',$id_city)
            ->where('notifications.id_country','-')
            ->orWhere('notifications.type','facility')
            ->where('notifications.id_city','-')
            ->where('notifications.id_country',$id_country)
            ->orderBy('notifications.id','DESC')
            ->paginate(10);

            foreach ($note as $key => $value) {
                if($value->id_notefication_reads == null){
                    $noteficationRead = new notefication_read();
                    $noteficationRead->notefication_id = $value->id;
                    $noteficationRead->user_id = \auth()->user()->id;
                    $noteficationRead->save();
                }
            }
            return response()->json(['success' => true, 'data'=>$note], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['success' => false, 'message'=>$th->getMessage()], 200);
        }

    }
}

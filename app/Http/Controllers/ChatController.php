<?php

namespace App\Http\Controllers;

use App\Models\Model\Chat;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Model\Father;
use App\Models\Model\facility_owner;
use DataTables;

use Illuminate\Support\Facades\DB;


class ChatController extends Controller
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
    public function sendChat(Request $request){
        try {
            //code...
            $chat = new Chat();
            $chat->id_company = $request->id_company;
            $chat->id_father = $request->id_father;
            $chat->message = $request->message;
            $chat->sender = $request->sender;
            $isSave = $chat->save();

            //send notification
            $facilityOwnerController = new FacilityOwnerController();
            $company = $facilityOwnerController->getName_corporation($request->id_company);
            $companyDeviceToken = $facilityOwnerController->getDevice_token($request->id_company);

            $father = Father::where('id',$request->id_father)->first();


            if($request->sender == 'company'){
                    $notificationControler = new NotificationController();
                    $nn =  $notificationControler->sendNotification('رسالة جديدة', "يوجد رسالة جديدة من $company->name_corporation", $father->device_token, '2');
            }else{
                $notificationControler = new NotificationController();
                $nn =  $notificationControler->sendNotification('رسالة جديدة', "يوجد رسالة جديدة من $father->name", $companyDeviceToken->device_token, '2');
            }
                return response()->json(['success' => true, 'message_en' => 'Chat saved successfully.', 'message_ar' => 'تم حفظ الرسالة بنجاح.', 'notification'=>$nn]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['success' => false, 'message_en' => 'Chat not saved.', 'message_ar' => 'لم يتم حفظ الرسالة.', 'error'=>$th->getMessage()]);
        }
    }

    public function myChat($id_company, $id_father){
        try {
            //code...
            $myChat = Chat::where('id_company', $id_company)->where('id_father', $id_father)->orderBy('id','DESC')->get();
            if(auth()->user()->name_corporation){ //user facility
                $readingMEssage = Chat::where('id_company', $id_company)->where('id_father', $id_father)->where('sender','father')->where('is_read',0)->get();
            }else{ //user father
                $readingMEssage = Chat::where('id_company', $id_company)->where('id_father', $id_father)->where('sender','company')->where('is_read',0)->get();
            }

            foreach ($readingMEssage as $itm) {
                # code...
                $itm->is_read = 1;
                $itm->save();
            }
            return response()->json(['success' => true, 'message_en' => 'success', 'message_ar' => 'تم جلب الرسالة بنجاح.', 'data' => $myChat, 'readingMessage'=>$readingMEssage]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['success' => false, 'message_en' => 'Chat not get.', 'message_ar' => 'لم يتم جلب الرسالة.', 'error'=> $th->getMessage()]);
        }
    }

    //عدد الرسائل الغير مقروءة في محادثه
    public function count_not_reading($id_company, $id_father){
        try {
            //code...
            if(auth()->user()->name_corporation){ //user facility
                $readingMEssage = Chat::where('id_company', $id_company)->where('id_father', $id_father)->where('sender','father')->where('is_read',0)->count();
            }else{ //user father
                $readingMEssage = Chat::where('id_company', $id_company)->where('id_father', $id_father)->where('sender','company')->where('is_read',0)->count();
            }
    
            return response()->json(['success' => true, 'message_en' => 'Get Success.', 'message_ar' => 'تم الجلب بنجاح.', 'data'=> $readingMEssage]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['success' => false, 'message_en' => 'Error.', 'message_ar' => 'خطأ.', 'data'=> $th]);

        }


    }

    //عدد المحادثات الغير مقروءة
    public function countChatMainNotRead(){
        try {
            //code...
            if(auth()->user()->name_corporation){
                $chat = Chat::where('id_company', auth()->user()->id)->where('sender','father')->where('is_read', 0)->count();
            }else{
                $chat = Chat::where('id_father', auth()->user()->id)->where('sender','company')->where('is_read', 0)->count();
            }
            return response()->json(['success' => true, 'message_en' => 'Get Success.', 'message_ar' => 'تم الجلب بنجاح.', 'data'=> $chat]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['success' => false, 'message_en' => 'Error.', 'message_ar' => 'خطأ.', 'data'=> $th]);
        }


    }

    public function myMainChats(){
        $id_user = Auth::user()->id;
        try {
            //code...
            // $main_chats = DB::select('SELECT DISTINCT `id_company`,`id_father` FROM `chats` WHERE `id_father` = 1 ORDER BY `id_company` DESC');
            // $main_chats = DB::select('SELECT `id_company`,`id_father`,`message`,`sender`,`created_at` FROM chats WHERE `id_father` = 1 GROUP BY `id_company`,`id_father` ORDER BY id DESC');
             if(isset(auth()->user()->name_corporation)){//if user is a company
                $main_chats = DB::select("SELECT fahter.name,chat.* FROM chats AS chat INNER JOIN 
                (SELECT `id_company`,MAX(`id`) AS id FROM `chats` WHERE `id_company` = $id_user  GROUP BY `id_father`) T ON T.id = chat.id
                INNER JOIN fathers AS fahter ON fahter.id = chat.id_father");

                $user = 'company';
             }else{//if user is a father
                 $main_chats = DB::select("SELECT chat.*,company.logo,fac_own.name_corporation, fac_own.name_corporation_ar FROM chats AS chat INNER JOIN
                 (SELECT `id_company` AS id_company,MAX(`id`) AS id FROM `chats` WHERE `id_father` = $id_user GROUP BY `id_company`) T ON T.id = chat.id
                 INNER JOIN company_datas AS company ON company.id = T.id_company
                 INNER JOIN facility_owners AS fac_own ON fac_own.id = company.id_facility_owner");

                $user = 'father';
             }

            return \response()->json(['success' => true, 'message_en' => 'success', 'message_ar' => 'تم جلب الرسالة بنجاح.', 'data' => $main_chats, 'user' => $user]);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json(['success' => false, 'message_en' => 'Chat not get.', 'message_ar' => 'لم يتم جلب الرسالة.', 'error'=> $th->getMessage()]);
        }
    }

    public function pageAdminMainChat(){
        return view('/admin/chat/main');
    }
    public function adminMainChats(Request $request){

        try {
            //code...
            if($request->ajax()){

                $mainChat = DB::select('SELECT chat.*,company.logo,fac_own.name_corporation, fac_own.name_corporation_ar, father.name AS fatherName FROM chats AS chat 
                INNER JOIN
                (SELECT `id_company` AS id_company,MAX(`id`) AS id FROM `chats` GROUP BY `id_company`) T ON T.id = chat.id
                INNER JOIN company_datas AS company ON company.id = T.id_company
                INNER JOIN facility_owners AS fac_own ON fac_own.id = company.id_facility_owner
                INNER JOIN fathers AS father ON father.id = chat.id_father '    
            );
                return Datatables::of($mainChat)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.URL('/admin/page/private/chat').'/'.$row->id_father.'/'.$row->id_company.'"class="btn btn-sm btn-primary">فتح</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    
            }
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }


    }

    public function pageAdminPrivateChat($id_father, $id_company){
        try {
            //code...
            $myChat = Chat::where('id_company', $id_company)->where('id_father', $id_father)->orderBy('id','ASC')->get();
            $father = Father::find($id_father);
            $facility_owner = facility_owner::where('id', $id_company)->first(['name_corporation']);
            return view('admin.chat.private', compact('myChat','father','facility_owner'));

        } catch (\Throwable $th) {
            //throw $th;
            return view('admin.chat.private')->with("error",$th);
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
     * @param  \App\Http\Requests\StoreChatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChatRequest  $request
     * @param  \App\Models\Model\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChatRequest $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}

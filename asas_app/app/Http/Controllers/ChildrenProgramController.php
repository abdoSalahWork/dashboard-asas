<?php

namespace App\Http\Controllers;

use App\Models\Model\Children_program;
use App\Http\Requests\StoreChildren_programRequest;
use App\Http\Requests\UpdateChildren_programRequest;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Model\Company_data;
use App\Models\Model\Reservation_status;
use App\Models\Model\Program;
use App\Models\Model\Fahter_children;
use App\Models\Model\Father;
use DataTables;

class ChildrenProgramController extends Controller
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
     * @param  \App\Http\Requests\StoreChildren_programRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChildren_programRequest $request)
    {
        //
    }

    public function storeApi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_child' => 'required',
            'id_program' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message_en' => 'Please fill in all the data', 'message_ar' => 'الرجاء تعبئة جميع البيانات', 'error' => $validator->errors()], 401);
        }
        try {
            //code...
            // [1,2,3]
            $childrens = \explode(',', $request->id_child);
            $services = \explode(',', $request->id_service);

            $message_ar = 'تم الاضافة بنجاح"';
            $message_en = 'created successfully.';
            $childrenProgramServiceController = new ChildrenProgramServiceController();
            for ($i = 0; $i < count($childrens); $i++) {
                $is_book = Children_program::where('id_child', $childrens[$i])->where('id_program', $request->id_program)->where('is_deleted', '0')->count();
                if ($is_book > 0) {
                    $childName = Fahter_children::where('id', $childrens[$i])->first(['name']);
                    $message_ar .= '{' . $childName->name . ': تم تسجيل هذا الطالب مسبقا ' . '}';
                    $message_en .= 'Can not add the child ' . $childName->name . ' to the program because he is already subscribed to the program';
                } else {
                    $children_program = new Children_program();
                    $children_program->id_child = $childrens[$i];
                    $children_program->id_program = $request->id_program;
                    $children_program->save();
                    if ($services[0] != '-') {
                        for ($j = 0; $j < count($services); $j++) {
                            $childrenProgramServiceController->storeWithChildProgram($children_program->id, $services[$j]);
                        }
                    }
                }
            }
            //send notification
            $facility_id = Program::where('id', $request->id_program)->first('id_facility_owner');

            $facilityOwnerController = new FacilityOwnerController();
            $companyDeviceToken = $facilityOwnerController->getDevice_token($facility_id->id_facility_owner);

            $nameChildern = Fahter_children::where('id', $request->id_child)->first('name');

            $notificationControler = new NotificationController();
            $nn =  $notificationControler->sendNotification('لديك حجز جديد', "يوجد لديك حجز جديد الى الطالب: $nameChildern->name", $companyDeviceToken->device_token, '3');

            return \response()->json(['status' => true, 'message_en' => $message_en, 'message_ar' => $message_ar, 'notification' => $nn], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json(['status' => false, 'message_en' => 'Error in creating.', 'message_ar' => "خطأ في الاضافة", $th->getMessage()], 200);
        }
    }


    // كي يتم عرضها في الادمن
    public function getAllReservations()
    {

        $reservations = DB::table('children_programs AS childProg')
            ->join('fahter_childrens AS fatheChild', 'fatheChild.id', '=', 'childProg.id_child')
            ->join('programs AS program', 'program.id', '=', 'childProg.id_program')
            ->join('facility_owners AS facility', 'facility.id', '=', 'program.id_facility_owner')
            ->join('reservation_statuses AS reservationStatus', 'reservationStatus.id', '=', 'childProg.id_reservation_statuses')
            ->join('company_datas AS company', 'company.id_facility_owner', '=', 'facility.id')
            ->leftjoin('rate_father_companies', 'rate_father_companies.id_company', '=', 'company.id', 'AND', 'rate_father_companies.id_father', '=', 'fatheChild.id')
            ->select(
                'childProg.id AS childProg_id',
                'childProg.created_at',
                'company.id AS company_id',
                'fatheChild.name AS child_name',
                'fatheChild.id AS child_id',
                'program.name_ar AS program_name_ar',
                'program.name_en AS program_name_en',
                'facility.name_corporation AS name_company',
                'facility.name_corporation_ar AS name_company_ar',
                'reservationStatus.status_ar AS reservationStatus_status_ar',
                'reservationStatus.status_en AS reservationStatus_status_en',
                'reservationStatus.id AS reservationStatus_id',
                'rate_father_companies.id AS rate_father_companiesid'
            )
            ->where('childProg.is_deleted', '=', 0)
            ->get();

        return \view("admin.BeastFacilityYourCity.main", compact('data', 'facility_owner', 'cities'));
    }

    //حجوزات طلابي
    public function my_reservations()
    {
        try {
            //code...
            $my_reservation = DB::table('children_programs AS childProg')
                ->join('fahter_childrens AS fatheChild', 'fatheChild.id', '=', 'childProg.id_child')
                ->join('programs AS program', 'program.id', '=', 'childProg.id_program')
                ->join('facility_owners AS facility', 'facility.id', '=', 'program.id_facility_owner')
                ->join('reservation_statuses AS reservationStatus', 'reservationStatus.id', '=', 'childProg.id_reservation_statuses')
                ->join('company_datas AS company', 'company.id_facility_owner', '=', 'facility.id')
                ->leftjoin('rate_father_companies', 'rate_father_companies.id_company', '=', 'company.id', 'AND', 'rate_father_companies.id_father', '=', 'fatheChild.id')
                ->select(
                    'childProg.id AS childProg_id',
                    'childProg.created_at',
                    'company.id AS company_id',
                    'fatheChild.name AS child_name',
                    'fatheChild.id AS child_id',
                    'program.name_ar AS program_name_ar',
                    'program.name_en AS program_name_en',
                    'facility.name_corporation AS name_company',
                    'facility.name_corporation_ar AS name_company_ar',
                    'reservationStatus.status_ar AS reservationStatus_status_ar',
                    'reservationStatus.status_en AS reservationStatus_status_en',
                    'reservationStatus.id AS reservationStatus_id',
                    'rate_father_companies.id AS rate_father_companiesid'
                )
                ->where('fatheChild.id_father', '=', Auth()->user()->id)->where('childProg.is_deleted', '=', 0)
                ->paginate(10);

            // $my_reservation_paginate = $my_reservation;

            // $my_reservation = $my_reservation->unique('child_id');
            // $my_reservation = array_slice($my_reservation->values()->all(), 0, 5, true);



            return \response()->json(['status' => true,  'data' => $my_reservation], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json(['status' => false, 'message_en' => 'Error in view.', 'message_ar' => "خطأ في العرض", $th->getMessage()], 200);
        }
    }

    // بتجيب عدد لكل حالة حجز
    public function my_reservations_count($id_satus, $id_facility_owner)
    {
        try {
            //code...
            $count_reservation = DB::table('children_programs AS childProg')
                ->join('programs AS program', 'program.id', '=', 'childProg.id_program')
                ->select('childProg.id AS childProg_id')
                ->where('program.id_facility_owner', '=', $id_facility_owner)
                ->where('childProg.id_reservation_statuses', '=', $id_satus)
                ->where('childProg.is_deleted', '=', 0)
                ->count();
            return $count_reservation;
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    //بتجيب البرامج حسب الحالة
    public function my_reservations_data($id_satus)
    {
        try {
            //code...
            $my_reservation = DB::table('children_programs AS childProg')
                ->join('fahter_childrens AS fatheChild', 'fatheChild.id', '=', 'childProg.id_child')
                ->join('programs AS program', 'program.id', '=', 'childProg.id_program')
                ->join('facility_owners AS facility', 'facility.id', '=', 'program.id_facility_owner')
                ->join('reservation_statuses AS reservationStatus', 'reservationStatus.id', '=', 'childProg.id_reservation_statuses')
                ->select(
                    'childProg.id AS childProg_id',
                    'childProg.created_at',
                    'fatheChild.name AS child_name',
                    'program.name_ar AS program_name_ar',
                    'program.name_en AS program_name_en',
                    'facility.name_corporation AS name_company',
                    'facility.name_corporation_ar AS name_company_ar',
                    'reservationStatus.status_ar AS reservationStatus_status_ar',
                    'reservationStatus.status_en AS reservationStatus_status_en',
                    'reservationStatus.id AS reservationStatus_id'
                )
                ->where('childProg.is_deleted', '=', 0)
                ->where('facility.id', '=', Auth()->user()->id)
                ->where('childProg.id_reservation_statuses', '=', $id_satus)
                ->paginate(10);
            return \response()->json(['status' => true,  'data' => $my_reservation], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json(['status' => false, 'message_en' => 'Error in view.', 'message_ar' => "خطأ في العرض", $th->getMessage()], 200);
        }
    }

    //طلبات الحجز
    public function my_request_book_count($id_facility_owner)
    {
        try {
            //code...
            $count_req_book = DB::table('children_programs AS childProg')
                ->join('programs AS program', 'program.id', '=', 'childProg.id_program')
                ->select('childProg.id AS childProg_id')
                ->where('program.id_facility_owner', '=', $id_facility_owner)
                ->count();
            return $count_req_book;
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }



    //حجوازت الطلاب الخاص بالشركة
    public function my_reservations_company($search = null)
    {
        try {
            //code...
            if ($search == null) {
                $my_reservation = DB::table('children_programs AS childProg')
                    ->join('fahter_childrens AS fatheChild', 'fatheChild.id', '=', 'childProg.id_child')
                    ->join('programs AS program', 'program.id', '=', 'childProg.id_program')
                    ->join('facility_owners AS facility', 'facility.id', '=', 'program.id_facility_owner')
                    ->join('reservation_statuses AS reservationStatus', 'reservationStatus.id', '=', 'childProg.id_reservation_statuses')
                    ->select(
                        'childProg.id AS childProg_id',
                        'childProg.created_at',
                        'fatheChild.name AS child_name',
                        'program.name_ar AS program_name_ar',
                        'program.name_en AS program_name_en',
                        'facility.name_corporation AS name_company',
                        'facility.name_corporation_ar AS name_company_ar',
                        'reservationStatus.status_ar AS reservationStatus_status_ar',
                        'reservationStatus.status_en AS reservationStatus_status_en',
                        'reservationStatus.id AS reservationStatus_id'
                    )
                    ->where('childProg.is_deleted', '=', 0)
                    ->where('facility.id', '=', Auth()->user()->id)
                    ->paginate(10);
            } else {
                $my_reservation = DB::table('children_programs AS childProg')
                    ->join('fahter_childrens AS fatheChild', 'fatheChild.id', '=', 'childProg.id_child')
                    ->join('programs AS program', 'program.id', '=', 'childProg.id_program')
                    ->join('facility_owners AS facility', 'facility.id', '=', 'program.id_facility_owner')
                    ->join('reservation_statuses AS reservationStatus', 'reservationStatus.id', '=', 'childProg.id_reservation_statuses')
                    ->select(
                        'childProg.id AS childProg_id',
                        'childProg.created_at',
                        'fatheChild.name AS child_name',
                        'program.name_ar AS program_name_ar',
                        'program.name_en AS program_name_en',
                        'facility.name_corporation AS name_company',
                        'facility.name_corporation_ar AS name_company_ar',
                        'reservationStatus.status_ar AS reservationStatus_status_ar',
                        'reservationStatus.status_en AS reservationStatus_status_en',
                        'reservationStatus.id AS reservationStatus_id'
                    )
                    ->where('childProg.is_deleted', '=', 0)
                    ->where('facility.id', '=', Auth()->user()->id)
                    ->where('fatheChild.name', 'like', '%' . $search . '%')
                    ->paginate(10);
            }

            $count_under_studying = $this->my_reservations_count(1, Auth()->user()->id);
            $count_acceptable = $this->my_reservations_count(2, Auth()->user()->id);
            $count_rejected = $this->my_reservations_count(3, Auth()->user()->id);
            $count_canceled = $this->my_reservations_count(4, Auth()->user()->id);
            $count_batch_confirmed = $this->my_reservations_count(5, Auth()->user()->id);

            $req_book = $this->my_request_book_count(Auth()->user()->id);

            $arr_count_status = [
                'count_req_book' => $req_book,
                'count_under_studying' => $count_under_studying,
                'count_acceptable' => $count_acceptable,
                'count_rejected' => $count_rejected,
                'count_canceled' => $count_canceled,
                'count_batch_confirmed' => $count_batch_confirmed
            ];



            return \response()->json(['status' => true,  'count_status' => $arr_count_status, 'data' => $my_reservation, 'count_status' => $arr_count_status], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json(['status' => false, 'message_en' => 'Error in view.', 'message_ar' => "خطأ في العرض", $th->getMessage()], 200);
        }
    }


    public function my_reservations_company_dashboard()
    {
        try {
            //code...
            $my_reservation = DB::table('children_programs AS childProg')
                ->join('fahter_childrens AS fatheChild', 'fatheChild.id', '=', 'childProg.id_child')
                ->join('programs AS program', 'program.id', '=', 'childProg.id_program')
                ->join('facility_owners AS facility', 'facility.id', '=', 'program.id_facility_owner')
                ->join('reservation_statuses AS reservationStatus', 'reservationStatus.id', '=', 'childProg.id_reservation_statuses')
                ->join('fathers AS father', 'father.id', '=', 'fatheChild.id_father')
                ->select(
                    'childProg.id AS childProg_id',
                    'childProg.created_at',
                    'fatheChild.name AS child_name',
                    'fatheChild.name_father AS father_name2',
                    'father.name AS father_name',
                    'program.name_ar AS program_name_ar',
                    'program.name_en AS program_name_en',
                    'facility.name_corporation AS name_company',
                    'facility.name_corporation_ar AS name_company_ar',
                    'reservationStatus.status_ar AS reservationStatus_status_ar',
                    'reservationStatus.status_en AS reservationStatus_status_en'
                )
                ->where('program.id_facility_owner', '=', \session('facility')->id)->where('childProg.is_deleted', '=', 0)
                ->where('childProg.is_deleted', '=', 0)
                // ->where('childProg.id' , '=', 1)
                ->paginate(10);
            return \view('/facility_owner.programs.my_reservations', \compact('my_reservation'));
        } catch (\Throwable $th) {
            //throw $th;
            return \view('/facility_owner.programs.my_reservations')->with('error', 'يوجد خطا في العرض');
        }
    }

    public function reservations_company_dashboard_admin()
    {
        try {
            $reservation_statuses = Reservation_status::all();
            return \view('/admin.programs.reservations', ['reservation_statuses' => $reservation_statuses]);
        } catch (\Throwable $th) {
            //throw $th;
            return \view('/admin.programs.reservations')->with('error', 'يوجد خطا في العرض');
        }
    }

    public function reservations_company_dashboard_admin_list(Request $request)
    {
        try {
            //code...


            if ($request->ajax()) {
                $reservations = DB::table('children_programs AS childProg')
                    ->join('fahter_childrens AS fatheChild', 'fatheChild.id', '=', 'childProg.id_child')
                    ->join('programs AS program', 'program.id', '=', 'childProg.id_program')
                    ->join('facility_owners AS facility', 'facility.id', '=', 'program.id_facility_owner')
                    ->join('reservation_statuses AS reservationStatus', 'reservationStatus.id', '=', 'childProg.id_reservation_statuses')
                    ->join('fathers AS father', 'father.id', '=', 'fatheChild.id_father')
                    ->select(
                        'childProg.id AS childProg_id',
                        'childProg.created_at',
                        'fatheChild.name AS child_name',
                        'fatheChild.name_father AS father_name2',
                        'father.name AS father_name',
                        'program.name_ar AS program_name_ar',
                        'program.name_en AS program_name_en',
                        'facility.name_corporation AS name_company',
                        'facility.name_corporation_ar AS name_company_ar',
                        'reservationStatus.status_ar AS reservationStatus_status_ar',
                        'reservationStatus.status_en AS reservationStatus_status_en'
                    )
                    ->where('childProg.is_deleted', '=', 0)
                    ->where('childProg.is_deleted', '=', 0)
                    ->get();
                return Datatables::of($reservations)
                    ->addIndexColumn()

                    ->addColumn('action', function ($row) {
                        $actionBtn = '<a href="reservations_single/' . $row->childProg_id . '"class="btn btn-sm btn-primary">فتح</a>  <a class="btn btn-primary edit-record" data-record-id="' . $row->childProg_id . '"> تعديل الحالة</a>';

                        return $actionBtn;
                    })

                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return \view('/admin.programs.reservations')->with('error', 'يوجد خطا في العرض');
        }
    }



    //تحديث الحالة الحالية للحجز
    public function update_reservation_status(Request $request)
    {
        try {
            //code...
            $children_program = Children_program::find($request->id_children_program);
            $children_program->id_reservation_statuses = $request->id_reservation_statuses;
            $children_program->save();

            //notification
            $fater_childern = Fahter_children::find($children_program->id_child);
            $father = Father::find($fater_childern->id_father);

            $notificationControler = new NotificationController();
            $nn =  $notificationControler->sendNotification('تم تحديث حالة الحجز', "تم تحديث حالة الحجز لطالب: $fater_childern->name", $father->device_token, '4');

            return \response()->json(['status' => true,  'message_en' => 'updated successfully.', 'message_ar' => "تم التعديل بنجاح", 'notification' => $nn], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json(['status' => false, 'message_en' => 'Error in updating.', 'message_ar' => "خطأ في التعديل", $th->getMessage()], 200);
        }
    }

    //طلابي الغير مسجلين في هذا البرنامج
    public function my_child_not_resrvation_this_program($id_program)
    {
        //code...
        // $child = DB::table('fahter_childrens AS fathChild')
        // ->join('children_programs AS childProgram', 'fathChild.id', '=', 'childProgram.id_child')
        // ->select('fathChild.*')
        // ->where('fathChild.id_father', '=', Auth()->user()->id)
        // ->where('childProgram.id_program', '!=', $id_program)
        // ->where('childProgram.is_deleted', '=', 0)
        // ->orWhere('childProgram.id_child', '!=', 'fathChild.id')
        // ->where('fathChild.id_father', '=', Auth()->user()->id)
        // ->where('childProgram.id_program', '!=', $id_program)
        // ->orwhere('childProgram.is_deleted', '=', 1)
        // ->where('fathChild.id_father', '=', Auth()->user()->id)
        // ->get();

        $child = DB::table('fahter_childrens AS fathChild')
            ->join('children_programs AS childProgram', 'fathChild.id', '=', 'childProgram.id_child')
            // ->leftJoin('')
            ->select('fathChild.*', 'childProgram.id_child AS id_child_program')
            ->where('fathChild.id_father', '=', Auth()->user()->id)
            ->where('fathChild.is_deleted', '=', 0)
            ->where('fathChild.id', '!=', 'childProgram.id_child')
            ->where('childProgram.id_program', '!=', $id_program)
            // ->where('fathChild.is_deleted','=',0)

            ->orWhere('childProgram.is_deleted', '=', 1)
            ->where('fathChild.id_father', '=', Auth()->user()->id)
            ->where('fathChild.id', '!=', 'childProgram.id_child')
            ->where('fathChild.is_deleted', '=', 0)

            ->groupBy('fathChild.id')
            ->get();

        $id_user = Auth()->user()->id;
        $child2 = DB::select("
            SELECT fathChild.* FROM fahter_childrens AS fathChild
            LEFT JOIN children_programs AS childProgram ON fathChild.id = childProgram.id_child
            WHERE fathChild.id_father = $id_user AND childProgram.id_child IS NULL AND fathChild.is_deleted = 0
        ");





        return \response()->json(['status' => true,  'data' => $child, 'data2' => $child2], 200);

        // return \response()->json(['status'=>true,  'data'=>$child], 200);

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Children_program  $children_program
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            //code...
            $my_reservation = DB::table('children_programs AS childProg')
                ->join('fahter_childrens AS fatheChild', 'fatheChild.id', '=', 'childProg.id_child')
                ->join('programs AS program', 'program.id', '=', 'childProg.id_program')
                ->join('facility_owners AS facility', 'facility.id', '=', 'program.id_facility_owner')
                ->join('reservation_statuses AS reservationStatus', 'reservationStatus.id', '=', 'childProg.id_reservation_statuses')
                ->join('fathers AS father', 'father.id', '=', 'fatheChild.id_father')
                ->select(
                    'childProg.id AS childProg_id',
                    'childProg.created_at',
                    'fatheChild.name AS child_name',
                    'fatheChild.name_father AS father_name2',
                    'father.name AS father_name',
                    'program.name_ar AS program_name_ar',
                    'program.name_en AS program_name_en',
                    'program.price_main AS price',
                    'program.id AS id_program',
                    'facility.name_corporation AS name_company',
                    'facility.name_corporation_ar AS name_company_ar',
                    'reservationStatus.status_ar AS reservationStatus_status_ar',
                    'reservationStatus.status_en AS reservationStatus_status_en',
                    'reservationStatus.id AS reservationStatus_id'

                )
                ->where('program.id_facility_owner', '=', \session('facility')->id)->where('childProg.is_deleted', '=', 0)
                ->where('childProg.is_deleted', '=', 0)
                ->where('childProg.id', '=', $id)
                ->first();

            $discountController = new ProgramDiscountController();
            $discount = $discountController->get_my_discount($my_reservation->created_at, $my_reservation->id_program);

            $id_coin_copmany = Company_data::where('id_facility_owner', '=', \session('facility')->id)->first(['id_coins']);
            $setionCoinsController = new SettingCoinsController();
            $coins = $setionCoinsController->get_coin_company($id_coin_copmany->id_coins);

            $childrenProgramServiceController = new ChildrenProgramServiceController();
            $more_service = $childrenProgramServiceController->getChildrenProgramService($my_reservation->childProg_id);

            $reservationStatusController = new ReservationStatusController();
            $reservationStatus = $reservationStatusController->getReservation_status();

            return \view('/facility_owner.programs.my_reservations_single', \compact('my_reservation', 'discount', 'coins', 'more_service', 'reservationStatus'));
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    public function show_admin($id)
    {
        try {
            //code...
            $reservation = DB::table('children_programs AS childProg')
                ->join('fahter_childrens AS fatheChild', 'fatheChild.id', '=', 'childProg.id_child')
                ->join('programs AS program', 'program.id', '=', 'childProg.id_program')
                ->join('facility_owners AS facility', 'facility.id', '=', 'program.id_facility_owner')
                ->join('reservation_statuses AS reservationStatus', 'reservationStatus.id', '=', 'childProg.id_reservation_statuses')
                ->join('fathers AS father', 'father.id', '=', 'fatheChild.id_father')
                ->select(
                    'childProg.id AS childProg_id',
                    'childProg.created_at',
                    'fatheChild.name AS child_name',
                    'fatheChild.name_father AS father_name2',
                    'father.name AS father_name',
                    'program.name_ar AS program_name_ar',
                    'program.name_en AS program_name_en',
                    'program.price_main AS price',
                    'program.id AS id_program',
                    'facility.name_corporation AS name_company',
                    'facility.name_corporation_ar AS name_company_ar',
                    'facility.id AS id_facility',
                    'reservationStatus.status_ar AS reservationStatus_status_ar',
                    'reservationStatus.status_en AS reservationStatus_status_en',
                    'reservationStatus.id AS reservationStatus_id'

                )
                ->where('childProg.is_deleted', '=', 0)
                ->where('childProg.is_deleted', '=', 0)
                ->where('childProg.id', '=', $id)
                ->first();

            $discountController = new ProgramDiscountController();
            $discount = $discountController->get_my_discount($reservation->created_at, $reservation->id_program);

            $id_coin_copmany = Company_data::where('id_facility_owner', '=', $reservation->id_facility)->first(['id_coins']);
            $setionCoinsController = new SettingCoinsController();
            $coins = $setionCoinsController->get_coin_company($id_coin_copmany->id_coins);

            $childrenProgramServiceController = new ChildrenProgramServiceController();
            $more_service = $childrenProgramServiceController->getChildrenProgramService($reservation->childProg_id);

            $reservationStatusController = new ReservationStatusController();
            $reservationStatus = $reservationStatusController->getReservation_status();

            return \view('/admin.programs.reservations_single', \compact('reservation', 'discount', 'coins', 'more_service', 'reservationStatus'));
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    public function singleApi($id)
    {
        try {
            //code...
            $my_reservation = DB::table('children_programs AS childProg')
                ->join('fahter_childrens AS fatheChild', 'fatheChild.id', '=', 'childProg.id_child')
                ->join('programs AS program', 'program.id', '=', 'childProg.id_program')
                ->join('facility_owners AS facility', 'facility.id', '=', 'program.id_facility_owner')
                ->join('reservation_statuses AS reservationStatus', 'reservationStatus.id', '=', 'childProg.id_reservation_statuses')
                ->join('fathers AS father', 'father.id', '=', 'fatheChild.id_father')
                ->leftjoin('program_discounts', 'program_discounts.id_program', '=', 'program.id')
                ->select(
                    'childProg.id AS childProg_id',
                    'childProg.created_at',
                    'fatheChild.name AS child_name',
                    'fatheChild.name_father AS father_name2',
                    'fatheChild.date_of_birth AS date_of_birth',
                    'fatheChild.gender AS gender',
                    'father.name AS father_name',
                    'father.phone AS phone',
                    'program.price_note_en',
                    'program.price_note_ar',
                    'program.name_ar AS program_name_ar',
                    'program.name_en AS program_name_en',
                    'program.price_main AS price',
                    'program.id AS id_program',
                    'facility.name_corporation AS name_company',
                    'facility.name_corporation_ar AS name_company_ar',
                    'reservationStatus.status_ar AS reservationStatus_status_ar',
                    'reservationStatus.status_en AS reservationStatus_status_en',
                    'reservationStatus.id AS reservationStatus_id',
                    'program_discounts.price_rate_discount',
                    'program_discounts.start_discount',
                    'program_discounts.end_discount'

                )
                ->where('program.id_facility_owner', '=', Auth()->user()->id)->where('childProg.is_deleted', '=', 0)
                ->where('childProg.is_deleted', '=', 0)
                ->where('childProg.id', '=', $id)
                ->first();

            $discountController = new ProgramDiscountController();
            $discount = $discountController->get_my_discount($my_reservation->created_at, $my_reservation->id_program);

            $id_coin_copmany = Company_data::where('id_facility_owner', '=', Auth()->user()->id)->first(['id_coins']);
            $setionCoinsController = new SettingCoinsController();
            $coins = $setionCoinsController->get_coin_company($id_coin_copmany->id_coins);

            $childrenProgramServiceController = new ChildrenProgramServiceController();
            $more_service = $childrenProgramServiceController->getChildrenProgramService($my_reservation->childProg_id);

            // $reservationStatusController = new ReservationStatusController();
            // $reservationStatus = $reservationStatusController->getReservation_status();

            return \response()->json(['status' => true,  'data' => $my_reservation, 'discount' => $discount, 'coins' => $coins, "more_service" => $more_service], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json(['status' => false, 'message_ar' => 'تحقق من صلاحية الوصول الى هذا المستخدم', 'message_en' => 'Verify the accessibility of this user',  'data' => $th->getMessage(), 'error_dev' => $th], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Children_program  $children_program
     * @return \Illuminate\Http\Response
     */
    public function edit(Children_program $children_program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChildren_programRequest  $request
     * @param  \App\Models\Model\Children_program  $children_program
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChildren_programRequest $request, Children_program $children_program)
    {
        //
    }

    public function update_reservation_status_dashboard(Request $request, $id)
    {
        //code...
        $children_program = Children_program::find($id);
        $children_program->id_reservation_statuses = $request->id_reservation_statuses;
        $isUpdate = $children_program->save();

        //notification
        $fater_childern = Fahter_children::find($children_program->id_child);
        $father = Father::find($fater_childern->id_father);

        $notificationControler = new NotificationController();
        $nn =  $notificationControler->sendNotification('تم تحديث حالة الحجز', "تم تحديث حالة الحجز لطالب: $fater_childern->name", $father->device_token, '4');

        if ($isUpdate) {
            return back()->with('success', 'تم تحديث الحالة بنجاح');
        } else {
            return back()->with('error', 'حدث خطأ ما');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Children_program  $children_program
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $children_program = Children_program::find($id);
        $children_program->is_deleted = 1;
        $iSdelete = $children_program->save();
        if ($iSdelete) {
            return back()->with('success', 'تم الحذف بنجاح');
        }
        return back()->with('error', 'حدث خطأ أثناء الحذف');
    }
    public function destroyApi($id)
    {
        try {
            //code...
            $children_program = Children_program::find($id);
            $children_program->is_deleted = 1;
            $children_program->save();
            return \response()->json(['status' => true, 'message_en' => 'deleted successfully.', 'message_ar' => "تم الحذف بنجاح"], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json(['status' => false, 'message_en' => 'Error in deleting.', 'message_ar' => "خطأ في الحذف", $th->getMessage()], 200);
        }
    }


    public function getOnereservations($id)
    {
        $record = Children_program::find($id);
        //   $record = DB::table('select * from children_programs where children_programs.id='.$id);

        if (!$record) {
            // Handle the case where the record does not exist
            return response()->json(['error' => 'Record not found'], 404);
        }

        return response()->json($record);
    }

    public function updateeservations(Request $request)
    {
        $rules = [
            'id_reservation_statuses' => 'required',
            ];
             $messages = [
            'id_reservation_statuses' => ' حقل النوع مطلوب',
            ];
              $validation = $request->validate($rules, $messages);
            
            $aqar = Children_program::find($request->record_id);
            
             $aqar->update([
            'id_reservation_statuses' => $request->input('id_reservation_statuses'),
             ]);
                 return redirect()->back()->with('success', 'تم تعديل العقار بنجاح');
                
    }
}

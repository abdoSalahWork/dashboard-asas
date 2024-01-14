<?php

namespace App\Http\Controllers;

use App\Models\Model\Reservation_status;
use App\Http\Requests\StoreReservation_statusRequest;
use App\Http\Requests\UpdateReservation_statusRequest;
use Illuminate\Http\Request;
use Validator;

class ReservationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservation_status = Reservation_status::orderBy('id', 'desc')->get();
        return view('admin.reservation_status.main',compact('reservation_status'));
    }

    public function showApi(){
        try {
            //code...
            $reservation_status = Reservation_status::orderBy('id', 'desc')->get();
            return response()->json(["status"=>true ,"reservation_status"=>$reservation_status]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["status"=>false ,"message"=>"حدث خطأ أثناء عرض الحالات"]);
        }
       
    }

    public function getReservation_status(){
        //code...
        $reservation_status = Reservation_status::orderBy('id', 'desc')->get();
        return $reservation_status;
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
     * @param  \App\Http\Requests\StoreReservation_statusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status_en' => 'required|string|max:255',
            'status_ar' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $reservation_status = new Reservation_status();
        $reservation_status->status_en = $request->status_en;
        $reservation_status->status_ar = $request->status_ar;
        $isSave = $reservation_status->save();
        if($isSave)
            return redirect()->back()->with('success', 'تم اضافة الحالة بنجاح');
        return \redirect()->back()->with('error', 'لم يتم اضافة الحالة بنجاح');    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Reservation_status  $reservation_status
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation_status $reservation_status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Reservation_status  $reservation_status
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation_status $reservation_status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservation_statusRequest  $request
     * @param  \App\Models\Model\Reservation_status  $reservation_status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status_en' => 'required|string|max:255',
            'status_ar' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($id == 1)
            return back()->with('error', 'لا يمكن تعديل هذه الحالة');

        $reservation_status = Reservation_status::find($id);
        $reservation_status->status_en = $request->status_en;
        $reservation_status->status_ar = $request->status_ar;
        $isSave = $reservation_status->save();
        if($isSave)
            return redirect()->back()->with('success', 'تم تعديل الحالة بنجاح');
        return back()->with('fail', 'لم يتم تعديل الحالة بنجاح');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Reservation_status  $reservation_status
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id <= 5)
            return back()->with('error', 'لا يمكن حذف هذه الحالة');
        $reservation_status = Reservation_status::find($id);
        $isDelete = $reservation_status->delete();
        if($isDelete)
            return redirect()->back()->with('success', 'تم حذف الحالة بنجاح');
        return back()->with('faild', 'لم يتم حذف الحالة بنجاح');
    }
}

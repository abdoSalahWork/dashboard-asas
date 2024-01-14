<?php

namespace App\Http\Controllers;

use App\Models\Model\Media;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use Illuminate\Http\Request;
use Validator;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type = null)
    {
        $medias = false;
        if($type == 'company'){
            $medias = Media::where('table_name', 'company')->where('id_','-')->orderBy('id','DESC')->paginate(20);
        }else if($type == 'programs'){
            $medias = Media::where('table_name', 'programs')->where('id_','-')->orderBy('id','DESC')->paginate(20);
        }
        return view('admin.gallery.index', \compact('medias', 'type'));
    }

    public function addImageFromExcil($iamges_arr, $id_){
        $images = \explode(',', $iamges_arr);
        foreach ($images as $key => $value) {
            $media = Media::find($value);
            $media->id_ = $id_;
            $media->save();
        }
        return true;

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
     * @param  \App\Http\Requests\StoreMediaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        try {
            //code...
            $validator = Validator::make($request->all(), [
                'media' => 'required', 
                'id_' => 'required',
                'table_name'=>'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            foreach($request->media as $file){
                $img = time().$file->getClientOriginalName();
                $img = trim($img, ' ');
                $file->move("assets/image/$request->table_name/",$img);
                $media = new Media();
                $media->media = $img;
                $media->id_ = $request->id_;
                $media->table_name = $request->table_name;
                $isSave=$media->save();
            }
            if($isSave)
                return back()->with('success', 'تم الصورة الملف بنجاح');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }

    }
    public function storeApi(Request $request){
        $validator = Validator::make($request->all(), [
            'media' => 'required', 
            'id_' => 'required',
            'table_name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>false, 'message_en'=>'Please fill in all the data', 'message_ar'=>'الرجاء تعبئة جميع البيانات' ,'error'=>$validator->errors()], 401);
        }
        foreach($request->file("media") as $file){
            $img = time().$file->getClientOriginalName();
            $img = trim($img, ' ');
            $file->move("assets/image/$request->table_name/",$img);
            $media = new Media();
            $media->media = $img;
            $media->id_ = $request->id_;
            $media->table_name = $request->table_name;
            $isSave=$media->save();
         
        }
        if($isSave){
            return response()->json(['status'=>true,'message_en'=>'Program created successfully','message_ar'=>'تم رفع صورة بنجاح'], 200);
        }
        return \response()->json([
            'status' => false,
            'message_en' => 'Error in creating program',
            'message_ar' => 'خطأ في انشاء الملف',
        ], 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMediaRequest  $request
     * @param  \App\Models\Model\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMediaRequest $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //code...
            $media = Media::find($id);
            if($media){
                $isDelete = $media->delete();
                if($isDelete){
                    unlink("assets/image/$media->table_name/$media->media");
                    return \back()->with('success', 'تم الحذف بنجاح');
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            return \back()->with('error', $th->getMessage());
        }

    }
    public function destroyApi($id){
        $media = Media::find($id);
        if($media){
            $media->delete();
            unlink("assets/image/$media->table_name/$media->media");
            return response()->json(['status'=>true,'message_en'=>'Media deleted successfully','message_ar'=>'تم حذف الملف بنجاح','data'=>$media], 200);
        }
        return \response()->json([
            'status' => false,
            'message_en' => 'Error in deleting media',
            'message_ar' => 'خطأ في حذف الملف',
        ], 401);
    }
}

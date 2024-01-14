<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\import_F_C_P;
use App\Imports\import_program;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Model\Company_data;
use App\Models\Model\facility_owner;
use App\Models\Model\Program;
use Illuminate\Support\Facades\Hash;
use App\Models\Model\Media;

class ImportExcelController extends Controller
{
    public function main(){
        return view('admin.import_excel.main');
    }
    public function import(){
        $arr_id_facility_owner = [];
        $isImport_facility = Excel::toArray(new import_F_C_P, request()->file('file'));
        try {
            //code...
            if($isImport_facility){
                foreach ($isImport_facility[0] as $key => $value) {
                    if($value[0] != "الاسم"){
                        $facility_owner = new facility_owner;
                        $facility_owner->name = $value[0];
                        $facility_owner->name_corporation = $value[1];
                        $facility_owner->phone = $value[2];
                        $facility_owner->password = Hash::make($value[3]);
                        $facSave = $facility_owner->save();
                        array_push($arr_id_facility_owner, $facility_owner->id);
                        if($facSave){
                            $company_data = new Company_data;
                            $company_data->id_facility_owner = $facility_owner->id;
                            $company_data->logo = $value[4];
                            $company_data->desception_en = $value[5];
                            $company_data->desception_ar = $value[6];
                            $company_data->latitude = $value[7];
                            $company_data->longitude = $value[8];
                            $company_data->id_coins = $value[9];
                            $company_data->id_country = $value[10];
                            $company_data->id_city = $value[11];
                            $company_data->id_company_type = $value[12];
                            $comSave = $company_data->save();
                        }

                        $mediaController = new MediaController();
                        $mediaController->addImageFromExcil($value[13], $company_data->id);
                  
                    }
                }
                $this->import_programs($arr_id_facility_owner);
                // $result1 = ['success' => 'Data imported successfully.', 'id_facility_owner' => $arr_id_facility_owner];
                return back()->with('success', 'تم تصدير البيانات بنجاح');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'حدث خطأ أثناء تصدير البيانات '.$th->getMessage());
            // return \response()->json(['error'=>$th->getMessage() ]);
        }
        

    
    }

    public function import_programs($arr){
        $arr_id_facility_owner = $arr;
        $importPRogram = Excel::toArray(new import_program, request()->file('file_program'));
        foreach ($importPRogram[0] as $key => $value) {
            if($value[1] != "name_en"){
                $program = new Program;
                $program->id_facility_owner = $arr_id_facility_owner[(int)$value[0]];
                $program->name_en = $value[1];
                $program->name_ar = $value[2];
                $program->description_en = $value[3];
                $program->description_ar = $value[4];
                $program->id_timeType = $value[5];
                $program->id_typeProgram = $value[6];
                $program->price_main = \doubleval($value[7]);
                $program->age_conditions_en = $value[8];
                $program->age_conditions_ar = $value[9];
                $program->other_conditions_en = $value[10];
                $program->other_conditions_ar = $value[11];
                $program->image = '-';
                $program->other_fute = $value[13];
                $program->url_viedo = $value[14];
                $program->id_curriculum_type = $value[15];
                $program->price_note_en = $value[16];
                $program->price_note_ar = $value[17];
                $progSave = $program->save();

                // $program->image = $value[12];
                $mediaController = new MediaController();
                $mediaController->addImageFromExcil($value[12], $program->id);
            }
        }

    }
}

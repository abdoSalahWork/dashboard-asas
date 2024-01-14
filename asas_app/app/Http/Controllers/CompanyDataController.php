<?php

namespace App\Http\Controllers;

use App\Models\Model\Company_data;
use App\Models\Model\Media;
use App\Models\Model\Setting_languege;
use App\Models\Model\Setting_coins;
use App\Models\Model\facility_owner;
use App\Models\Model\Company_rate;
use App\Models\Model\Company_type;
use App\Http\Requests\StoreCompany_dataRequest;
use App\Http\Requests\UpdateCompany_dataRequest;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Model\LocationFather;
use App\Models\Favorite;


class CompanyDataController extends Controller
{

    function __construct()
    {
    }
    // فحص هل الذي يقوم بالتعديل هو صاحب المركز ؟
    function chek_is_myUser()
    {
        // return auth()->user()->id;
        $is_myuser = Company_data::where('id_facility_owner', auth()->user()->id)->where('is_deleted', 0)->get();
        // return \response()->json(['s'=>$is_myuser, 'd'=>auth()->user()]);
        if (!isset($is_myuser[0]->id_facility_owner)) {
            return false;
        } elseif (auth()->user()->id != $is_myuser[0]->id_facility_owner) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_data = Company_data::orderBy('sort', 'asc')->get();
        return $company_data;
    }

    public function sinbleApi($id, $id_father = null)
    {
        try {
            $result_arr = [];
            $company_data = Company_data::find($id);
            if ($company_data) {
                $result_arr += ['company_data' => $company_data];

                $facility_owner = facility_owner::find($company_data->id_facility_owner);

                $media = Media::where('id_', $company_data->id)->where('table_name', 'company')->get();
                if (isset($media[0]->id)) {
                    $result_arr += ['media' => $media];
                }
                // $languege = Setting_languege::where('id', $company_data->id_languege)->get();
                $coins = Setting_coins::where('id', $company_data->id_coins)->get();
                if (isset($coins[0]->id)) {
                    $result_arr += ['coins' => $coins];
                }

                $company_rate = Company_rate::where('id_company', $company_data->id)->get();
                if (isset($company_rate[0]->id)) {
                    $result_arr += ['company_rate' => $company_rate];
                }

                $company_type = Company_type::where('id', $company_data->id_company_type)->get();
                if (isset($company_type[0]->id)) {
                    $result_arr += ['company_type' => $company_type];
                }

                $addToFav = false;
                $fav = null;
                if ($id_father) {
                    $fav = Favorite::where('company_id', $id)->where('father_id', $id_father)->get();
                    if (!$fav->isEmpty()) {
                        $addToFav = true;
                    }
                }
                return response()->json(
                    [
                        // 'status'=>true,
                        // 'message_en'=>'Company data found successfully',
                        // 'message_ar'=>'تم العثور على بينات الشركة بنجاح',
                        // 'data'=>$result_arr,
                        // // 'media'=>$media,
                        // // // 'languege'=>$languege[0]->languege_name,
                        // // 'coins'=>$coins[0]->coins_name,
                        // // 'company_rate'=>$company_rate,
                        // // 'company_type'=>$company_type[0]->type_name_en,
                        'status' => true,
                        'message_en' => 'Company data found successfully',
                        'message_ar' => 'تم العثور على بينات الشركة بنجاح',
                        'data' => $company_data,
                        'facility_owner' => $facility_owner,
                        'media' => $media,
                        // 'languege'=>$languege[0]->languege_name,
                        'coins' => $coins,
                        'company_rate' => $company_rate,
                        'company_type' => $company_type,
                        'addToFav' => $addToFav,
                        'favoraite' => $fav,
                    ],
                    200
                );
            }
            return \response()->json([
                'status' => false,
                'message_en' => 'Error in finding Company data',
                'message_ar' => 'خطأ في العثور على بينات الشركة',
            ], 401);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json([
                'status' => 'error',
                'message_en' => 'Error in finding Company data',
                'message_ar' => 'خطأ في العثور على بينات الشركة',
                'error' => $th->getMessage()
            ], 401);
        }
    }

    public function single_with_token()
    {
        try {
            $result_arr = [];
            $company_data = Company_data::where('id_facility_owner', Auth()->user()->id)->get();
            if ($company_data) {

                $facility_owner = facility_owner::where('id', Auth()->user()->id)->get();


                $result_arr += ['company_data' => $company_data];
                $media = Media::where('id_', $company_data[0]->id)->where('table_name', 'company')->get();
                if (isset($media[0]->id)) {
                    $result_arr += ['media' => $media];
                }
                // $languege = Setting_languege::where('id', $company_data->id_languege)->get();
                $coins = Setting_coins::where('id', $company_data[0]->id_coins)->get();
                if (isset($coins[0]->id)) {
                    $result_arr += ['coins' => $coins];
                }

                $company_rate = Company_rate::where('id_company', $company_data[0]->id)->get();
                if (isset($company_rate[0]->id)) {
                    $result_arr += ['company_rate' => $company_rate];
                }

                $company_type = Company_type::where('id', $company_data[0]->id_company_type)->get();
                if (isset($company_type[0]->id)) {
                    $result_arr += ['company_type' => $company_type];
                }

                $addToFav = Favorite::where('company_id', $company_data[0]->id)->where('father_id', Auth()->user()->id)->get();
                return response()->json(
                    [
                        'status' => true,
                        'message_en' => 'Company data found successfully',
                        'message_ar' => 'تم العثور على بينات الشركة بنجاح',
                        'facility_owner' => $facility_owner,
                        'data' => $company_data,
                        'media' => $media,
                        // 'languege'=>$languege[0]->languege_name,
                        'coins' => $coins,
                        'company_rate' => $company_rate,
                        'company_type' => $company_type,
                    ],
                    200
                );
            }
            return \response()->json([
                'status' => false,
                'message_en' => 'Error in finding Company data',
                'message_ar' => 'خطأ في العثور على بينات الشركة',
            ], 401);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json([
                'status' => 'error',
                'message_en' => 'Error in finding Company data',
                'message_ar' => 'خطأ في العثور على بينات الشركة',
                'error' => $th->getMessage()
            ], 401);
        }
    }

    public function search_company_with_cuntry_and_city($id_country, $id_city,Request $request)
    {

        try {
            //code...
            // $company_data = Company_data::where('id_country',$id_country)->where('id_city',$id_city)->paginate(10);
            $company_data = DB::table('company_datas')
                ->join('company_rates', 'company_rates.id_company', '=', 'company_datas.id')
                ->join('facility_owners', 'facility_owners.id', '=', 'company_datas.id_facility_owner')
                ->select('company_datas.*', 'company_rates.rate_total', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
                ->where('company_datas.id_country', $id_country)->Where('company_datas.id_city', $id_city)
                ->where('facility_owners.is_deleted', '=', 0);
                // ->where('company_datas.id_district', $request->id_district);
                // ->latest();
                //  ->paginate(10);

            
                if (count($company_data->get()) == 0) {
                    $company_data = DB::table('company_datas')
                    ->join('company_rates', 'company_rates.id_company', '=', 'company_datas.id')
                    ->join('facility_owners', 'facility_owners.id', '=', 'company_datas.id_facility_owner')
                    ->select('company_datas.*', 'company_rates.rate_total', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
                    ->where('facility_owners.is_deleted', '=', 0);
                    // ->where('company_datas.id_district', $request->id_district);

                    // ->latest();
                    // ->paginate(10);
            }



            if ($request->sort == 5) {
                // Sort by  (newest to lowest)
                $company_data = DB::table('company_datas')
                ->join('company_rates', 'company_rates.id_company', '=', 'company_datas.id')
                ->join('facility_owners', 'facility_owners.id', '=', 'company_datas.id_facility_owner')
                ->where('company_datas.id_country', $id_country)->Where('company_datas.id_city', $id_city)

                ->select('company_datas.*', 'company_rates.rate_total', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
                ->where('facility_owners.is_deleted', '=', 0)
                ->where('company_datas.id_district', $request->id_district);
                $company_data = $company_data->orderBy('created_at', 'DESC');
                $company_data= $company_data->paginate(10);

                return response()->json(
                    [
                        'status' => true,
                        'message_en' => 'Company data found successfully',
                        'message_ar' => 'تم العثور على بينات الشركة بنجاح',
                        'data' => $company_data,
                    ],
                    200
                );

            } 
            elseif ($request->sort == 4) {

                $company_datas = DB::table('company_datas')
                ->join('company_rates', 'company_rates.id_company', '=', 'company_datas.id')
                ->join('facility_owners', 'facility_owners.id', '=', 'company_datas.id_facility_owner')
                ->where('company_datas.id_country', $id_country)->Where('company_datas.id_city', $id_city)

                ->select('company_datas.*', 'company_rates.rate_total', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
                ->where('facility_owners.is_deleted', '=', 0)
                ->where('company_datas.id_district', $request->id_district);

                if ($request->latitude && $request->longitude) {
                    $company_datas->select('*', DB::raw('(6371 * 2 * ASIN(SQRT(POWER(SIN((RADIANS(' . request()->latitude . ') - RADIANS(latitude)) / 2), 2) + COS(RADIANS(' . request()->latitude . ')) * COS(RADIANS(latitude)) * POWER(SIN((RADIANS(' . request()->longitude . ') - RADIANS(longitude)) / 2), 2)))) AS distance'))
                    ->orderBy('distance', 'ASC');
                }
                $company= $company_datas->paginate(10);
                return response()->json(
                    [
                        'status' => true,
                        'message_en' => 'Company data found successfully',
                        'message_ar' => 'تم العثور على بينات الشركة بنجاح',
                        'data' => $company,
                    ],
                    200
                );
            }
            $company_data= $company_data->paginate(10);

        


            return response()->json(
                [
                    'status' => true,
                    'message_en' => 'Company data found successfully',
                    'message_ar' => 'تم العثور على بينات الشركة بنجاح',
                    'data' => $company_data,
                ],
                200
            );
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json([
                'status' => 'error',
                'message_en' => 'Error in finding Company data',
                'message_ar' => 'خطأ في العثور على بينات الشركة',
                'error' => $th->getMessage()
            ], 401);
        }
    }

    // public function searchCompanyWithCountryAndCity($idCountry, $idCity, Request $request)
    // {
    //     try {
    //             //         $company_data = DB::table('company_datas')

    //         $query =  DB::table('company_datas')->join('company_rates', 'company_rates.id_company', '=', 'company_datas.id')
    //             ->join('facility_owners', 'facility_owners.id', '=', 'company_datas.id_facility_owner')
    //             ->select(
    //                 'company_datas.*',
    //                 'company_rates.rate_total',
    //                 'facility_owners.name_corporation',
    //                 'facility_owners.name_corporation_ar'
    //             )
    //             ->where('company_datas.id_country', $idCountry)
    //             ->where('company_datas.id_city', $idCity)
    //             ->where('facility_owners.is_deleted', 0)
    //             ->where('company_datas.id_district', $request->id_district);

    //         if ($request->sort) {
    //             switch ($request->sort) {
    //                 case 5:
    //                     $query->latest();
    //                     break;
    //                 case 3:
    //                     if ($request->latitude && $request->longitude) {
    //                         $query->selectRaw(
    //                             '*, (6371 * 2 * ASIN(SQRT(POWER(SIN((RADIANS(?) - RADIANS(latitude)) / 2), 2) + COS(RADIANS(?)) * COS(RADIANS(latitude)) * POWER(SIN((RADIANS(?) - RADIANS(longitude)) / 2), 2)))) AS distance)',
    //                             [$request->latitude, $request->latitude, $request->longitude]
    //                         )->orderBy('distance', 'DESC');
    //                     }
    //                     break;
    //                 // Add more cases if needed
    //             }
    //         }

    //         $companyData = $query->paginate(10);

    //         return response()->json([
    //             'status' => true,
    //             'message_en' => 'Company data found successfully',
    //             'message_ar' => 'تم العثور على بيانات الشركة بنجاح',
    //             'data' => $companyData,
    //         ], 200);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message_en' => 'Error in finding Company data',
    //             'message_ar' => 'خطأ في العثور على بيانات الشركة',
    //             'error' => $th->getMessage(),
    //         ], 401);
    //     }
    // }
    public function search_company_with_cuntry_and_city_token()
    {
        try {
            //code...
            $company_data_temp = Company_data::where('id_facility_owner', Auth()->user()->id)->first(['id_country', 'id_city',]);
            $company_data = DB::table('company_datas')
                ->join('company_rates', 'company_rates.id_company', '=', 'company_datas.id')
                ->join('facility_owners', 'facility_owners.id', '=', 'company_datas.id_facility_owner')
                ->select('company_datas.*', 'company_rates.rate_total', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
                ->where('company_datas.id_country', $company_data_temp->id_country)->orWhere('company_datas.id_city', $company_data_temp->id_city)
                ->paginate(10);
            if (count($company_data) == 0) {
                $company_data = DB::table('company_datas')
                    ->join('company_rates', 'company_rates.id_company', '=', 'company_datas.id')
                    ->join('facility_owners', 'facility_owners.id', '=', 'company_datas.id_facility_owner')
                    ->select('company_datas.*', 'company_rates.rate_total', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
                    ->paginate(10);
            }
            return response()->json(
                [
                    'status' => true,
                    'message_en' => 'Company data found successfully',
                    'message_ar' => 'تم العثور على بينات الشركة بنجاح',
                    'data' => $company_data,
                ],
                200
            );
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json([
                'status' => 'error',
                'message_en' => 'Error in finding Company data',
                'message_ar' => 'خطأ في العثور على بينات الشركة',
                'error' => $th->getMessage()
            ], 401);
        }
    }

    public function search_company_with_company_type($id_company_type, $id_city)
    {
        try {
            //code...
            $company_data = DB::table('company_datas')
                ->join('company_rates', 'company_rates.id_company', '=', 'company_datas.id')
                ->join('facility_owners', 'facility_owners.id', '=', 'company_datas.id_facility_owner')
                ->select('company_datas.*', 'company_rates.rate_total', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
                ->where('company_datas.id_company_type', $id_company_type)
                ->where('company_datas.id_city', $id_city)
                ->paginate(10);
            return response()->json(
                [
                    'status' => true,
                    'message_en' => 'Company data found successfully',
                    'message_ar' => 'تم العثور على بينات الشركة بنجاح',
                    'data' => $company_data,
                ],
                200
            );
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json([
                'status' => 'error',
                'message_en' => 'Error in finding Company data',
                'message_ar' => 'خطأ في العثور على بينات الشركة',
                'error' => $th->getMessage()
            ], 401);
        }
    }

    public function GetCompany()
    {
        try {
            //code...
            $company_data = DB::table('company_datas')
                ->join('company_rates', 'company_rates.id_company', '=', 'company_datas.id')
                ->join('facility_owners', 'facility_owners.id', '=', 'company_datas.id_facility_owner')
                ->select('company_datas.*', 'company_rates.rate_total', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
                // ->where('company_datas.id_company_type',$id_company_type)
                // ->where('company_datas.id_city',$id_city)
                ->where("facility_owners.is_deleted", '=', 0)
                ->paginate(10);
            return response()->json(
                [
                    'status' => true,
                    'message_en' => 'Company data found successfully',
                    'message_ar' => 'تم العثور على بينات الشركة بنجاح',
                    'data' => $company_data,
                ],
                200
            );
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json([
                'status' => 'error',
                'message_en' => 'Error in finding Company data',
                'message_ar' => 'خطأ في العثور على بينات الشركة',
                'error' => $th->getMessage()
            ], 401);
        }
    }

    public function showApi($id_city, $type_sort = null, Request $request)
    {
        if ($type_sort == null) {

            $company_data = DB::table('company_datas')
                ->join('company_rates', 'company_datas.id', '=', 'company_rates.id_company')
                ->join('facility_owners', 'company_datas.id_facility_owner', '=', 'facility_owners.id')
                ->select('company_datas.*', 'company_rates.rate_total', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
                ->where('company_datas.id_city', $id_city)
                // ->where('company_datas.id_district', $request->id_district)
                ->where('facility_owners.is_deleted', '0')
                ->orderBy('company_datas.id', 'DESC')
                ->paginate(10);


        } else if ($type_sort == 'rate') {
            $company_data = DB::table('company_datas')
                ->join('company_rates', 'company_datas.id', '=', 'company_rates.id_company')
                ->join('facility_owners', 'company_datas.id_facility_owner', '=', 'facility_owners.id')
                ->select('company_datas.*', 'company_rates.rate_total', 'facility_owners.name_corporation', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar')
                ->where('company_datas.id_city', $id_city)
                // ->where('company_datas.id_district', $request->id_district)
                ->where('facility_owners.is_deleted', '0')
                ->orderBy('company_rates.rate_total','DESC')
            ->paginate(10);
         }


        //     if ($request->sort == 5) {
        //         // Sort by rate in descending order (highest to lowest)
        //         $company_data->orderBy('company_rates.rate_total', 'DESC');
        //     } elseif ($request->sort == 4) {
        //         $company_data->orderBy('company_rates.rate_total', 'ASC');

        //     }
        //     elseif ($request->sort == 3) {
        //         if ($request->latitude && $request->longitude) {
        //             $company_data->select('*', DB::raw('(6371 * 2 * ASIN(SQRT(POWER(SIN((RADIANS(' . request()->latitude . ') - RADIANS(latitude)) / 2), 2) + COS(RADIANS(' . request()->latitude . ')) * COS(RADIANS(latitude)) * POWER(SIN((RADIANS(' . request()->longitude . ') - RADIANS(longitude)) / 2), 2)))) AS distance'))
        //             ->orderBy('distance', 'DESC');
        //         }
        //     }
        //     elseif ($request->sort == 2) {
        //         if ($request->latitude && $request->longitude) {
        //             $company_data->select('*', DB::raw('(6371 * 2 * ASIN(SQRT(POWER(SIN((RADIANS(' . request()->latitude . ') - RADIANS(latitude)) / 2), 2) + COS(RADIANS(' . request()->latitude . ')) * COS(RADIANS(latitude)) * POWER(SIN((RADIANS(' . request()->longitude . ') - RADIANS(longitude)) / 2), 2)))) AS distance'))
        //             ->orderBy('distance', 'ASC');
        //         }
        //     }
        // }

        // $company_data = $company_data->paginate(10);



        return response()->json(['status' => true, 'message_en' => 'Company data found successfully', 'message_ar' => 'تم العثور على بينات الشركة بنجاح', 'data' => $company_data], 200);
    }

    //لترتيب حسب قرب مكان المنزل او العمل
    public function sortLocation(Request $request, $type_sort, $id_city)
    {
        try {
            //code...
            // if($request->latitude && $request->longitude){
            $company_data = Company_data::distance($request->latitude, $request->longitude)->where('id_city', $id_city)->orderBy('distance', 'ASC')->paginate(5);
            // }else{
            //     $father_location = LocationFather::where('id_father', Auth()->user()->id)->where('type', $type_sort)->first();
            //     $company_data = Company_data::distance($father_location->latitude, $father_location->longitude)->orderBy('distance', 'ASC')->paginate(5);
            // }
            $company_data_array = [];
            $companyRateController = new CompanyRateController();
            $facilityController = new FacilityOwnerController();
            foreach ($company_data as $key => $value) {
                $isNotDeletedfacility = $facilityController->isNotDeletedfacility($value->id);
                if ($isNotDeletedfacility == '1') {

                    $company_rate = $companyRateController->getRateCompany($value->id);

                    $name_corporation = $facilityController->getName_corporation($value->id_facility_owner);
                    $object = new \stdClass();
                    $object->id = $value->id;
                    $object->logo = $value->logo;
                    $object->desception_en = $value->desception_en;
                    $object->desception_ar = $value->desception_ar;
                    $object->longitude = $value->longitude;
                    $object->latitude = $value->latitude;
                    $object->id_facility_owner = $value->id_facility_owner;
                    $object->is_deleted = $value->is_deleted;
                    $object->id_coins = $value->id_coins;
                    $object->id_country = $value->id_country;
                    $object->id_city = $value->id_city;
                    $object->id_company_type = $value->id_company_type;
                    $object->created_at = $value->created_at;
                    $object->updated_at = $value->updated_at;
                    $object->distance = $value->distance;
                    $object->name_corporation = $name_corporation->name_corporation;
                    $object->name_corporation_ar = $name_corporation->name_corporation_ar;
                    $object->rate_total = $company_rate;
                    array_push($company_data_array, $object);
                }
            }

            return response()->json(['status' => true, 'message_en' => 'Company data found successfully', 'message_ar' => 'تم العثور على بينات الشركة بنجاح', 'data' => $company_data_array, 'pegn' => $company_data], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return \response()->json([
                'status' => false,
                'message_en' => 'Error in finding Company data',
                'message_ar' => 'خطأ في العثور على بينات الشركة',
                'error' => $th->getMessage()
            ], 401);
        }
    }

    public function getDistance($lat1, $lon1, $lat2, $lon2)
    {
        // $lat1 = $request->lat1;
        // $lon1 = $request->lon1;

        // $lat2 = $request->lat2;
        // $lon2 = $request->lon2;

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $km = $miles * 1.609344;
        return $km . " KM";
    }

    // public function showApi_sort($type, $sort = null){
    //     /**
    //      * type = [2=>rate, 3=>the_closest الاقرب]
    //      *
    //      */
    //     if($type == 2){
    //         $company_data = DB::table('company_datas')
    //         ->join('company_rates', 'company_datas.id', '=', 'company_rates.id_company')
    //         ->select('company_datas.*', 'company_rates.rate_total')
    //         ->orderBy('company_rates.rate_total','DESC')
    //         ->paginate(10);
    //     }elseif($type == 3){

    //     }
    //     return response()->json(['status'=>true,'message_en'=>'Company data found successfully','message_ar'=>'تم العثور على بينات الشركة بنجاح','data'=>$company_data], 200);
    // }

    public function search_like($search, $city, $type_company = null)
    {
        try {
            if ($type_company == null) {
                $company_data = DB::table('company_datas AS companyData')
                    ->join('facility_owners AS facilityOwner', 'companyData.id_facility_owner', '=', 'facilityOwner.id')
                    ->join('company_rates AS companyRate', 'companyData.id', '=', 'companyRate.id_company')
                    ->select('companyData.*', 'facilityOwner.name_corporation', 'facilityOwner.name_corporation_ar', 'companyRate.rate_total')
                    ->where('facilityOwner.name_corporation', 'like', '%' . $search . '%')
                    ->where('companyData.id_city', $city)
                    ->where('facilityOwner.is_deleted', '0')

                    ->orwhere('facilityOwner.name_corporation_ar', 'like', '%' . $search . '%')
                    ->where('companyData.id_city', $city)
                    ->where('facilityOwner.is_deleted', '0')

                    ->orWhere('companyData.desception_en', 'like', '%' . $search . '%')
                    ->where('companyData.id_city', $city)
                    ->where('facilityOwner.is_deleted', '0')

                    ->orWhere('companyData.desception_ar', 'like', '%' . $search . '%')
                    ->where('companyData.id_city', $city)
                    ->where('facilityOwner.is_deleted', '0')


                    ->paginate(10);
            } else {
                //code...
                $company_data = DB::table('company_datas AS companyData')
                    ->join('facility_owners AS facilityOwner', 'companyData.id_facility_owner', '=', 'facilityOwner.id')
                    ->join('company_rates AS companyRate', 'companyData.id', '=', 'companyRate.id_company')
                    ->select('companyData.*', 'facilityOwner.name_corporation', 'facilityOwner.name_corporation_ar', 'companyRate.rate_total')
                    ->where('facilityOwner.name_corporation', 'like', '%' . $search . '%')
                    ->where('facilityOwner.name_corporation_ar', 'like', '%' . $search . '%')

                    ->where('companyData.id_company_type', '=', $type_company)
                    ->where('companyData.id_city', $city)
                    ->where('facilityOwner.is_deleted', '0')

                    ->orwhere('facilityOwner.name_corporation_ar', 'like', '%' . $search . '%')
                    ->where('companyData.id_city', $city)
                    ->where('facilityOwner.is_deleted', '0')

                    ->orWhere('companyData.desception_en', 'like', '%' . $search . '%')
                    ->where('companyData.id_company_type', '=', $type_company)
                    ->where('companyData.id_city', $city)
                    ->where('facilityOwner.is_deleted', '0')

                    ->orWhere('companyData.desception_ar', 'like', '%' . $search . '%')
                    ->where('companyData.id_company_type', '=', $type_company)
                    ->where('companyData.id_city', $city)
                    ->where('facilityOwner.is_deleted', '0')
                    ->paginate(10);
            }
            return response()->json(['status' => true, 'message_en' => 'Company data found successfully', 'message_ar' => 'تم العثور على بينات الشركة بنجاح', 'data' => $company_data], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => true, 'message_en' => 'Error in finding Company data', 'message_ar' => 'خطأ في العثور على بينات الشركة', 'error' => $th->getMessage()], 401);
        }
    }

    public function search_like2($search, $city, $type_company)
    {
        try {

            $company_data = DB::table('company_datas AS companyData')
                ->join('facility_owners AS facilityOwner', 'companyData.id_facility_owner', '=', 'facilityOwner.id')
                ->join('company_rates AS companyRate', 'companyData.id', '=', 'companyRate.id_company')
                ->select('companyData.*', 'facilityOwner.name_corporation', 'facilityOwner.name_corporation_ar', 'companyRate.rate_total');


            if ($search != "-") {
                $company_data = $company_data
                    ->where(function ($query) use ($search) {
                        $query
                            ->where('facilityOwner.name_corporation', 'like', '%' . $search . '%')
                            ->orwhere('facilityOwner.name_corporation_ar', 'like', '%' . $search . '%')
                            ->orwhere('companyData.desception_en', 'like', '%' . $search . '%')
                            ->orwhere('companyData.desception_ar', 'like', '%' . $search . '%');
                    });
            }

            if ($city != '-') {
                $company_data = $company_data->where('companyData.id_city', $city);
            }

            if ($type_company != '-') {
                $company_data = $company_data->where('companyData.id_company_type', '=', $type_company);
            }


            $company_data = $company_data->where('facilityOwner.is_deleted', '0')->paginate(10);

            return response()->json(['status' => true, 'message_en' => 'Company data found successfully', 'message_ar' => 'تم العثور على بينات الشركة بنجاح', 'data' => $company_data], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => true, 'message_en' => 'Error in finding Company data', 'message_ar' => 'خطأ في العثور على بينات الشركة', 'error' => $th->getMessage()], 401);
        }
    }

    // public function addRate(Request $request, $id){
    //     $validator = Validator::make($request->all(),[
    //         'rate' => 'required',
    //         'id' => 'required',
    //     ]);

    //     $company_data = Company_data::find($id);
    //     // return $company_data->rate;
    //     if($company_data->rate == 0){
    //         $company_data->rate = $request->rate;
    //     }else{
    //         $company_data->rate = ($company_data->rate + $request->rate)/2;
    //     }
    //     $isSave = $company_data->save();
    //     if($isSave){
    //         return response()->json(['status'=>true,'message_en'=>'Successfully evaluated','message_ar'=>' تك التقييم بنجاح','data'=>$company_data], 200);
    //     }
    //     return response()->json(['status'=>'error','message_en'=>'Error in evaluating','message_ar'=>'خطأ في التقييم'], 401);



    // }

    public function updateCompanyLanguege_And_coins(Request $request)
    {
        // $validator = Validator::make($request->all(),[
        //     'id_languege' => 'required',
        // ]);


        try {
            //code...
            $company_data = Company_data::where('id_facility_owner', Auth()->user()->id)->get();
            // if($request->id_languege){
            //     $company_data->id_languege = $request->id_languege;
            // }

            if ($request->id_coins) {
                $company_data[0]->id_coins = $request->id_coins;
            }
            $isSave = $company_data[0]->save();
            if ($isSave) {
                return response()->json(['status' => true, 'message_en' => 'Successfully updated', 'message_ar' => ' تم التحديث بنجاح', 'data' => $company_data], 200);
            }
            return response()->json(['status' => false, 'message_en' => 'Error in updating', 'message_ar' => 'خطأ في التحديث'], 401);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => false, 'message_en' => 'Error in updating', 'message_ar' => 'خطأ في التحديث', 'error' => $th->getMessage()], 401);
        }
    }

    public function count_company()
    {
        $count_company = Company_data::count();
        return $count_company;
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
     * @param  \App\Http\Requests\StoreCompany_dataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    public function storeApi(Request $request)
    {

        $validator = Validator::make($request->all(), [
            // 'name_en' => 'required|string|max:255',
            // 'name_ar' => 'required|string|max:255',
            'images' => 'required',
            'logo' => 'required',
            'desception_en' => 'required|string',
            'desception_ar' => 'required|string',
            'id_country' => 'required',
            'id_city' => 'required',
            'id_district' => 'required',
            'id_company_type' => 'required',
            'id_coins' => "required",
            // 'id_facility_owner' => 'required|unique:company_datas',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'validator' => $validator->errors()]);
        }

        if (Company_data::where('id_facility_owner', Auth()->user()->id)->count() > 0) {
            return \response()->json(['status' => false, 'validator' => 'لايمكن اضافة اكثر من شركة للشخص']);
        }

        $company_data = new Company_data();
        // $company_data->name_en = $request->name_en;
        // $company_data->name_ar = $request->name_ar;
        $company_data->desception_en = $request->desception_en;
        $company_data->desception_ar = $request->desception_ar;
        $company_data->latitude = $request->lat;
        $company_data->longitude = $request->lng;
        $company_data->id_facility_owner = auth()->user()->id;
        $company_data->id_country = $request->id_country;
        $company_data->id_city = $request->id_city;
        $company_data->id_district = $request->id_district;
        $company_data->id_company_type = $request->id_company_type;
        $company_data->id_coins = $request->id_coins;
        // $company_data->main_img = $request->main_img;
        // $company_data->logo = $request->logo;


        $file = $request->file('logo');
        $img = time() . $file->getClientOriginalName();
        $img = trim($img, ' ');
        $file->move('assets/image/company/', $img);
        $company_data->logo = $img;

        $isSave = $company_data->save();
        if ($isSave) {
            //upload img
            if ($request->file("images")) {
                foreach ($request->file("images") as $file) {
                    $img = time() . $file->getClientOriginalName();
                    $img = trim($img, ' ');
                    $file->move('assets/image/company/', $img);
                    $media = new Media();
                    $media->media = $img;
                    $media->id_ = $company_data->id;
                    $media->table_name = "company";
                    $media->save();
                }
            }

            $company_rate = new CompanyRateController();
            $result_company_rate = $company_rate->storeApi($company_data->id);
            return response()->json(['status' => true, 'message_en' => 'success add data', 'message_ar' => 'تم إضافة البيانات بنجاح', 'data' => $company_data, 'company_rate' => $result_company_rate], 200);
        }
        return \response()->json([
            'status' => false,
            'message_en' => 'faild add data',
            'message_ar' => 'فشل حفظ البيانات',
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model\Company_data  $company_data
     * @return \Illuminate\Http\Response
     */
    public function show(Company_data $company_data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Model\Company_data  $company_data
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompany_dataRequest  $request
     * @param  \App\Models\Model\Company_data  $company_data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'desception_ar' => 'required',
            'desception_en' => 'required',
            'id_country' => 'required',
            'id_city' => 'required',
            'id_coins' => 'required',
            'id_company_type' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            //code...
            $company_data = Company_data::find($id);
            $company_data->desception_ar = $request->desception_ar;
            $company_data->desception_en = $request->desception_en;
            $company_data->id_country = $request->id_country;
            $company_data->id_city = $request->id_city;
            $company_data->id_coins = $request->id_coins;
            $company_data->id_company_type = $request->id_company_type;

            $company_data->longitude = $request->longitude;
            $company_data->latitude = $request->latitude;
            $company_data->save();

            return back()->with('success', 'تم تعديل البيانات بنجاح');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->Message());
        }
    }
    public function customeUpdate(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'desception_ar' => 'required',
            'desception_en' => 'required',
            'id_country' => 'required',
            'id_city' => 'required',
            'id_coins' => 'required',
            'id_company_type' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {

            //code...
            $company_data = Company_data::find($id);
            $company_data->desception_ar = $request->desception_ar;
            $company_data->desception_en = $request->desception_en;
            $company_data->id_country = $request->id_country;
            $company_data->id_city = $request->id_city;
            $company_data->id_coins = $request->id_coins;
            $company_data->id_company_type = $request->id_company_type;

            $company_data->longitude = $request->longitude;
            $company_data->latitude = $request->latitude;

            if ($request->file('logo')) {
                $file = $request->file('logo');
                $img = time() . $file->getClientOriginalName();
                $img = trim($img, ' ');
                $file->move('assets/image/company/', $img);
                $company_data->logo = $img;
            }

            $company_data->URL_WEBSITE = $request->URL_WEBSITE;
            $company_data->FACEBOOK = $request->FACEBOOK;
            $company_data->INSTEGRAM = $request->INSTEGRAM;
            $company_data->OTHER_TITLE = $request->OTHER_TITLE;
            $company_data->NOTES_1 = $request->NOTES_1;
            $company_data->NOTES_2 = $request->NOTES_2;
            $company_data->NOTES_3 = $request->NOTES_3;


            $company_data->save();

            return back()->with('success', 'تم تعديل البيانات بنجاح');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->Message());
        }
    }

    public function updateApi(Request $request, $id)
    {
        // $theck_user = $this->chek_is_myUser();
        // if($theck_user == 0 ){
        //     return response()->json([
        //         'status'=>false,
        //         'message_en'=>'you are not my user',
        //         'message_ar'=>'ليس لديك صلاحية تعديل هذا المركز',
        //     ]);
        // }

        $validator = Validator::make($request->all(), [
            // 'name_en' => 'required|string|max:255',
            // 'name_ar' => 'required|string|max:255',
            'desception_en' => 'required|string',
            'desception_ar' => 'required|string',
            'id_country' => 'required',
            'id_city' => 'required',
            'id_district' => 'required',
            'id_coins' => "required",

        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message_en' => 'Please fill in all the data', 'message_ar' => 'الرجاء تعبئة جميع البيانات', 'error' => $validator->errors()], 401);
        }


        $company_data = Company_data::find($id);
        // $company_data->name_en = $request->name_en;
        // $company_data->name_ar = $request->name_ar;
        $company_data->desception_en = $request->desception_en;
        $company_data->desception_ar = $request->desception_ar;
        $company_data->latitude = $request->lat;
        $company_data->longitude = $request->lng;
        $company_data->id_country = $request->id_country;
        $company_data->id_city = $request->id_city;
        $company_data->id_district = $request->id_district;
        $company_data->id_company_type = $request->id_company_type;
        $company_data->id_coins = $request->id_coins;

        if ($request->name_corporation) {
            $facility_owner = Facility_owner::find($company_data->id_facility_owner);
            $facility_owner->name_corporation = $request->name_corporation;
            $isSave = $facility_owner->save();
            if (!$isSave) {
                return response()->json([
                    'status' => false,
                    'message_en' => 'faild update data',
                    'message_ar' => 'فشل تعديل اسم المؤسسة',
                ]);
            }
        }

        if ($request->name_corporation_ar) {
            $facility_owner = Facility_owner::find($company_data->id_facility_owner);
            $facility_owner->name_corporation_ar = $request->name_corporation_ar;
            $isSave = $facility_owner->save();
            if (!$isSave) {
                return response()->json([
                    'status' => false,
                    'message_en' => 'faild update data',
                    'message_ar' => 'ar فشل تعديل اسم المؤسسة',
                ]);
            }
        }


        if ($request->logo) {
            $file = $request->file('logo');
            $img = time() . $file->getClientOriginalName();
            $img = trim($img, ' ');
            $file->move('assets/image/company/', $img);
            $company_data->logo = $img;
        }

        $isSave = $company_data->save();
        if ($isSave) {
            return response()->json(['status' => true, 'message_en' => 'success update data', 'message_ar' => 'تم تعديل البيانات بنجاح', 'data' => $company_data]);
        }
        return \response()->json([
            'status' => false,
            'message_en' => 'faild update data',
            'message_ar' => 'فشل تعديل البيانات',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Model\Company_data  $company_data
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company_data $company_data)
    {
        //
    }
    public function destroyApi($id)
    {

        $theck_user = $this->chek_is_myUser();
        // return $theck_user;
        if ($theck_user == 0) {
            return response()->json([
                'status' => false,
                'message_en' => 'you are not my user',
                'message_ar' => 'ليس لديك صلاحية تعديل هذا المركز',
            ]);
        }
        $company_data = Company_data::find($id);
        $company_data->is_deleted = 1;
        $isSave = $company_data->save();
        return \response()->json([
            'status' => true,
            'message_en' => 'success delete data',
            'message_ar' => 'تم حذف البيانات بنجاح',
        ]);
    }

    public function companiesLocations()
    {
        //        $companies = Company_data::select('id' ,'longitude' ,'latitude')->get();

        $companies = DB::table('company_datas')
            ->select('company_datas.id', 'company_datas.longitude', 'company_datas.latitude', 'facility_owners.name_corporation', 'facility_owners.name_corporation_ar', DB::raw('ROUND(company_rates.rate_total) as rounded_rate'))
            ->join('facility_owners', 'company_datas.id_facility_owner', '=', 'facility_owners.id')
            ->leftJoin('company_rates', 'company_datas.id', '=', 'company_rates.id_company')
            ->get();



        return response()->json([
            'status' => true,
            'companies' => $companies
        ], 200);
    }
}

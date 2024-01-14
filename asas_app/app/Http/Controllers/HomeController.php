<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $settingCountryCityController = new SettingCountryCityController();
        $arr_count_cityCountry = $settingCountryCityController->count_country_city();

        $companyDataController = new CompanyDataController();
        $count_company = $companyDataController->count_company();

        $fatherController = new FatherController();
        $count_father = $fatherController->count_father();
        
        $fatherCountry = $fatherController->fatherCountry();
        
        return view('index', compact('arr_count_cityCountry', 'count_company', 'count_father', 'fatherCountry'));
    }
}

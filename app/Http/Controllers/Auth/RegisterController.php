<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
// use Validator;
use Auth;   

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    function customRegister(Request $request)
    {
        try {
            //code...
            $validator = request()->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
    
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->type = $request->type;
            $isSave = $user->save();
            if($isSave){
                return \back()->with('success', 'تم حفظ المستخدم بنجاح');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return \back()->with('error', 'حدث خطأ أثناء حفظ المستخدم');
        }

    }

    function show(){
        $users = User::orderBy('id','DESC')->paginate(10);
        return view('auth.show')->with('users', $users);
    }
    function update(Request $request, $id){
        if($id == 1)
            return \back()->with('error','لايمكن العديل على هذا الحساب');
        $validator = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $isSave = $user->save();
        if($isSave){
            return \back()->with('success', 'تم تعديل البيانات بنجاح');
        }
    }
    function delete($id){
        if($id == 1){
            return \back()->with('error', 'لا يمكن حذف المستخدم الاول');
        }
        $user = User::find($id);
        $isDelete = $user->delete();
        if($isDelete){
            return \back()->with('success', 'تم حذف المستخدم بنجاح');
        }
    }
    
}

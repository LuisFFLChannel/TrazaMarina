<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\Attendance;
use Auth;
use Carbon\Carbon;
use App\Models\AttendanceDetail;
use Config;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */


    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    public function getLogout()
    {
       if(Auth::user()->role_id == 2 ){ // solo lo hago si soy vendedor


            $dateToday  =   new Carbon() ;
            $dateToday =  $dateToday->toDateString();
            $dateTimeToday  =   new Carbon() ;
            $id = Auth::user()->id;

          //  sleep(0.1);

            $Attendance = Attendance::where('datetime',$dateToday  )->where('salesman_id',$id)->get();
        //    $assitancedetail  =   new AttendanceDetail() ;
       //     $assitancedetail->datetime  =         $dateTimeToday ;
          //  $assitancedetail->tipo =   Config::get('constants.out')     ; // ya que se trata de una salida
          //  $assitancedetail->attendance_id =  $Attendance[0]->id;
           // $assitancedetail->save();

//Busco la fecha y actualizo lafecha de salida .

            $updateAttendance = AttendanceDetail::where( 'attendance_id'  , $Attendance[0]->id )->get()->last();
            $updateAttendance->datetime = $dateTimeToday;
            $updateAttendance->save();




        $AttendancetoSave = Attendance::find($updateAttendance->attendance_id );

        $AttendancetoSave->datetimeend    =     $dateTimeToday;
        $salesman = User::find( $AttendancetoSave->salesman_id );
        $detailsAttendances = AttendanceDetail::where('attendance_id' , $updateAttendance->attendance_id)->get();
        $index = 0 ;

        $AttendancetoSave->save();


         //   sleep(0.1);

        }
        Auth::logout();


        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
    protected $redirectAfterLogout = '/';

    protected $loginPath = '/auth/login';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'name' => 'required|max:32',
            'email' => 'required|email|max:64|unique:users',
            'password' => 'required|confirmed|min:6',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        
        $role = 1;
        if (isset($data['role_id']))
            $role = $data['role_id'];
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $role
            ]);
    }
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */

    public function redirectPath()
    {
        switch (\Auth::user()->role_id) {
            case '8':
            return '/clientMaster/home';
            break;
            case '7':
            return '/usuarioValidacion';
            break;
            case '6':
            return '/usuarioIntermediario';
            break;
            case '5':
            return '/usuarioPesca';
            break;
            case '4':
            return '/admin';
            break;
            case '3':
            return '/promoter';
            break;
            case '2':

//aqui agregamos una entrada a la asistencia

            $dateToday  =   new Carbon() ;
            $dateToday =  $dateToday->toDateString();

            $dateTimeToday  =   new Carbon() ;
            $id = Auth::user()->id;
            $Attendance = Attendance::where('datetime', $dateToday  )->where('salesman_id',$id)->get();

     if($Attendance->count() == 0 ) { // si no lo encuentro creo la fecha
       $assitance  =   new Attendance() ;
       $assitance->datetime = $dateToday ;
       $assitance->salesman_id  =  $id  ;
       $assitance->datetimestart  =     $dateTimeToday ;
       $assitance->save();

      // sleep(0.1);
   }
     else {              // si lo encuentro actualizo la fecha de finalizacion de sesion a null

       $assitance = Attendance::find($Attendance[0]->id);
       $assitance->datetimeend = NULL ;
       $assitance->save();
   }
////////////////////////////////////////////////////////////////////////////////////////////////////////
      //ahora creo el detalle de la asistencia. esto es si o si
////////////////////////////////////////////////////////////////////////////////////////////////////////
   $assitancedetail  =   new AttendanceDetail() ;
   $assitancedetail->datetime  =         $dateTimeToday ;
    $assitancedetail->tipo = Config::get('constants.in')     ;  ; // ya que se trata de un ingreso


    $id = Auth::user()->id;


    $Attendance = Attendance::where('datetime',$dateToday  )->where('salesman_id',$id)->get();

    $assitancedetail->attendance_id =  $Attendance[0]->id;
    $assitancedetail->save();

//tambien agregamos una salida



     $assitancedetail  =   new AttendanceDetail() ;

    $assitancedetail->tipo = 2  ; // ya que se trata de un ingreso


    $id = Auth::user()->id;


    $Attendance = Attendance::where('datetime',$dateToday  )->where('salesman_id',$id)->get();

    $assitancedetail->attendance_id =  $Attendance[0]->id;

     $assitancedetail->datetime = NULL;
    $assitancedetail->save();




    return '/salesman';
    break;
    case '1':
    return '/client/home';
    break;
    default:
    return '/';
    break;
}
}
}

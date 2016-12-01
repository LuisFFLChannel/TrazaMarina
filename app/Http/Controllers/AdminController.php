<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreAdminRequest;
use App\Http\Requests\User\UpdateAdminRequest;
use App\user;
use Carbon\Carbon;
use App\Services\FileService;
use App\Models\ModuleAssigment;
use App\Http\Requests\Client\PasswordClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use Auth;
use Session;

class AdminController extends Controller
{
    public function __construct(){
        $this->file_service = new FileService();
    }

    public function client()
    {
        return view('internal.admin.client');
    }
    public function salesman()
    {

        $vendedores = User::where('role_id',2)->paginate(10);
        $vendedores->setPath('salesman');

        return view('internal.admin.salesman',compact('vendedores'));
    }
    public function usuarioPesca()
    {

        $users = User::where('role_id',5)->paginate(10);
        $users->setPath('usuarioPesca');

        return view('internal.admin.usuarioPesca',compact('users'));
    }
    public function usuarioIntermediario()
    {

        $users = User::where('role_id',6)->paginate(10);
        $users->setPath('usuarioIntermediario');

        return view('internal.admin.usuarioIntermediario',compact('users'));
    }
    public function validador()
    {

        $users = User::where('role_id',7)->paginate(10);
        $users->setPath('validador');

        return view('internal.admin.validador',compact('users'));
    }
    public function editUsuarioPesca($id)
    {
        $user = User::find($id);
        if ($user==null){
            return response()->view('errors.503', [], 404);
        }
        return view('internal.admin.editUsuarioPesca',compact('user'));
    }
    public function editUsuarioIntermediario($id)
    {
        $user = User::find($id);
        if ($user==null){
            return response()->view('errors.503', [], 404);
        }
        return view('internal.admin.editUsuarioIntermediario',compact('user'));
    }
    public function editValidador($id)
    {
        $user = User::find($id);
        if ($user==null){
            return response()->view('errors.503', [], 404);
        }
        return view('internal.admin.editValidador',compact('user'));
    }



    public function editSalesman($id)
    {
        $user = User::find($id);
        return view('internal.admin.editSalesman',compact('user'));
    }


    public function updateSalesman(UpdateAdminRequest $request, $id)
    {

        $input = $request->all();

        $user = User::find($id);
        $user->name         =   $input['name'];
        $user->lastName     =   $input['lastname'];
        /*
        if ($input['password'] != null )
            $user->password     =   bcrypt($input['password']);*/

        $user->di_type      =   $input['di_type'];
        $user->di           =   $input['di'];
        $user->address      =   $input['address'];
        $user->phone        =   $input['phone'];
        $user->email        =   $input['email'];
        $user->birthday     =   new Carbon($input['birthday']);
        $user->role_id      =   $input['role_id'];

        $birthday =  new \DateTime ($input['birthday']);
        $currentDate = new \DateTime('now');
        $interval = $birthday->diff($currentDate);
        if($interval->format('%y') < 18){ 
            //return back()->withInput($request->except('seats'))->withErrors(['El asiento '. $seat_id.' no esta libre']);
            return back()->withErrors(['El usuario debe tener más de 18 años']);
        }
        /*
        if($request->file('image')!=null)
           $user->image        =   $this->file_service->upload($request->file('image'),'user');
        */
        $user->save();

        return redirect('admin/salesman');
    }

    public function promoter()
    {
        $promoters = User::where('role_id',3)->paginate(10);
        $promoters->setPath('promoter');
        return view('internal.admin.promoter', compact('promoters'));
    }

    public function editPromoter($id)
    {

        $user = User::find($id);
        return view('internal.admin.editPromoter',compact('user'));
    }

    public function updatePromoter(UpdateAdminRequest $request, $id)
    {

        $input = $request->all();

        $user = User::find($id);
        $user->name         =   $input['name'];
        $user->lastName     =   $input['lastname'];
        /*
        if ($input['password'] != null )
            $user->password     =   bcrypt($input['password']);*/

        $user->di_type      =   $input['di_type'];
        $user->di           =   $input['di'];
        $user->address      =   $input['address'];
        $user->phone        =   $input['phone'];
        $user->email        =   $input['email'];
        $user->birthday     =   new Carbon($input['birthday']);
        $user->role_id      =   $input['role_id'];

        $birthday =  new \DateTime ($input['birthday']);
        $currentDate = new \DateTime('now');
        $interval = $birthday->diff($currentDate);
        if($interval->format('%y') < 18){ 
            //return back()->withInput($request->except('seats'))->withErrors(['El asiento '. $seat_id.' no esta libre']);
            return back()->withErrors(['El usuario debe tener más de 18 años']);
        }
        /*
        if($request->file('image')!=null)
           $user->image        =   $this->file_service->upload($request->file('image'),'user');
        */
        $user->save();

        return redirect('admin/promoter');
    }

    public function admin()
    {
        $users = User::where('role_id',4)->paginate(10);
        $users->setPath('admin');
        return view('internal.admin.admin', compact('users'));
    }

    public function editAdmin($id)
    {
        $user = User::find($id);
        if ($user==null){
            return response()->view('errors.503', [], 404);
        }

        return view('internal.admin.editAdmin', compact('user'));
    }

    public function updateAdmin(UpdateAdminRequest $request, $id)
    {
        $input = $request->all();

        $user = User::find($id);
        $user->name         =   $input['name'];
        $user->lastName     =   $input['lastname'];
        /*

        if ($input['password'] != null )
            $user->password     =   bcrypt($input['password']);*/

        $user->di_type      =   1;
        $user->di           =   $input['di'];
        $user->address      =   $input['address'];
        $user->phone        =   $input['phone'];
        $user->email        =   $input['email'];
        $user->birthday     =   new Carbon($input['birthday']);
        $user->role_id      =   $input['role_id'];

        $birthday =  new \DateTime ($input['birthday']);
        $currentDate = new \DateTime('now');
        $interval = $birthday->diff($currentDate);
        if($interval->format('%y') < 18){ 
            //return back()->withInput($request->except('seats'))->withErrors(['El asiento '. $seat_id.' no esta libre']);
            return back()->withErrors(['El usuario debe tener más de 18 años']);
        }
        /*
        if($request->file('image')!=null)
           $user->image        =   $this->file_service->upload($request->file('image'),'user');
        */
        $user->save();

        return redirect('admin/admin');
    }

    public function updateUsuarioPesca(UpdateAdminRequest $request, $id)
    {
        $input = $request->all();

        $user = User::find($id);
        $user->name         =   $input['name'];
        $user->lastName     =   $input['lastname'];
        /*

        if ($input['password'] != null )
            $user->password     =   bcrypt($input['password']);*/

        $user->di_type      =   1;
        $user->di           =   $input['di'];
        $user->address      =   $input['address'];
        $user->phone        =   $input['phone'];
        $user->email        =   $input['email'];
        $user->birthday     =   new Carbon($input['birthday']);
        $user->role_id      =   $input['role_id'];

        $birthday =  new \DateTime ($input['birthday']);
        $currentDate = new \DateTime('now');
        $interval = $birthday->diff($currentDate);
        if($interval->format('%y') < 18){ 
            //return back()->withInput($request->except('seats'))->withErrors(['El asiento '. $seat_id.' no esta libre']);
            return back()->withErrors(['El usuario debe tener más de 18 años']);
        }
        /*
        if($request->file('image')!=null)
           $user->image        =   $this->file_service->upload($request->file('image'),'user');
        */
        $user->save();

        return redirect('admin/usuarioPesca');
    }

    public function updateUsuarioIntermediario(UpdateAdminRequest $request, $id)
    {
        $input = $request->all();

        $user = User::find($id);
        $user->name         =   $input['name'];
        $user->lastName     =   $input['lastname'];
        /*

        if ($input['password'] != null )
            $user->password     =   bcrypt($input['password']);*/

        $user->di_type      =   1;
        $user->di           =   $input['di'];
        $user->address      =   $input['address'];
        $user->phone        =   $input['phone'];
        $user->email        =   $input['email'];
        $user->birthday     =   new Carbon($input['birthday']);
        $user->role_id      =   $input['role_id'];

        $birthday =  new \DateTime ($input['birthday']);
        $currentDate = new \DateTime('now');
        $interval = $birthday->diff($currentDate);
        if($interval->format('%y') < 18){ 
            //return back()->withInput($request->except('seats'))->withErrors(['El asiento '. $seat_id.' no esta libre']);
            return back()->withErrors(['El usuario debe tener más de 18 años']);
        }
        /*
        if($request->file('image')!=null)
           $user->image        =   $this->file_service->upload($request->file('image'),'user');
        */
        $user->save();

        return redirect('admin/usuarioIntermediario');
    }
    public function updateValidador(UpdateAdminRequest $request, $id)
    {
        $input = $request->all();

        $user = User::find($id);
        $user->name         =   $input['name'];
        $user->lastName     =   $input['lastname'];
        /*

        if ($input['password'] != null )
            $user->password     =   bcrypt($input['password']);*/

        $user->di_type      =   1;
        $user->di           =   $input['di'];
        $user->address      =   $input['address'];
        $user->phone        =   $input['phone'];
        $user->email        =   $input['email'];
        $user->birthday     =   new Carbon($input['birthday']);
        $user->role_id      =   $input['role_id'];

        $birthday =  new \DateTime ($input['birthday']);
        $currentDate = new \DateTime('now');
        $interval = $birthday->diff($currentDate);
        if($interval->format('%y') < 18){ 
            //return back()->withInput($request->except('seats'))->withErrors(['El asiento '. $seat_id.' no esta libre']);
            return back()->withErrors(['El usuario debe tener más de 18 años']);
        }
        /*
        if($request->file('image')!=null)
           $user->image        =   $this->file_service->upload($request->file('image'),'user');
        */
        $user->save();

        return redirect('admin/validador');
    }



    public function newUser()
    {
        return view('internal.admin.newUser');

    }


    public function store(StoreAdminRequest $request)
    {
        $input = $request->all();

        $user               =   new User ;
        $user->name         =   $input['name'];
        $user->lastName     =   $input['lastname'];
        $user->password     =   bcrypt($input['password']);
        $user->di_type      =   1;
        $user->di           =   $input['di'];
        $user->address      =   $input['address'];
        $user->phone        =   $input['phone'];
        $user->email        =   $input['email'];

        $user->birthday     =   new Carbon($input['birthday']);


        $user->role_id      =   $input['role_id'];
        if($request->file('image')!=null)
           $user->image        =   $this->file_service->upload($request->file('image'),'user');

        // validate la edad del usuario 

        $birthday =  new \DateTime ($input['birthday']);
        $currentDate = new \DateTime('now');
        $interval = $birthday->diff($currentDate);
        if($interval->format('%y') < 18){ 
            //return back()->withInput($request->except('seats'))->withErrors(['El asiento '. $seat_id.' no esta libre']);
            return back()->withErrors(['El usuario debe tener más de 18 años']);
        }

        $user->save();

        if($user->role_id == '4')
             return redirect('admin/admin');
        elseif ($user->role_id == '5')
            return redirect('admin/usuarioPesca');
        elseif ($user->role_id == '6')
            return redirect('admin/usuarioIntermediario');
        elseif ($user->role_id == '7')
            return redirect('admin/validador');

    }

        public function destroy($id)
    {
        $user = User::find($id);
        if ($user==null){
            return response()->view('errors.503', [], 404);
        }
        $user->delete();
        return redirect('admin/admin');

   }
   public function destroyUsuarioPesca($id)
    {
        $user = User::find($id);
        if ($user==null){
            return response()->view('errors.503', [], 404);
        }
        $user->delete();
        return redirect('admin/usuarioPesca');

   }
   public function destroyUsuarioIntermediario($id)
    {
        $user = User::find($id);
        if ($user==null){
            return response()->view('errors.503', [], 404);
        }
        $user->delete();
        return redirect('admin/usuarioIntermediario');

   }
   public function destroyValidador($id)
    {
        $user = User::find($id);
        if ($user==null){
            return response()->view('errors.503', [], 404);
        }
        $user->delete();
        return redirect('admin/validador');

   }

    public function destroyPromoter($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('admin/promoter');
    }

    public function destroySalesman($id)
    {
        $moduleassigment = ModuleAssigment::where('salesman_id',$id)->where('status',1)->get();

        if ($moduleassigment->count()==0){
            $user = User::find($id);
            $user->delete();

        }else{
            return back()->withErrors(['Debe primero desasociar el vendedor del punto de venta']);
        }

        return redirect('admin/salesman');
    }


    public function passwordAdmin()
    {
        return view('internal.admin.password');
    }
    public function passwordUsuarioPesca()
    {
        return view('internal.usuarioPesca.password');
    }
    public function passwordUsuarioIntermediario()
    {
        return view('internal.usuarioIntermediario.password');
    }
    public function passwordUsuarioValidacion()
    {
        return view('internal.usuarioValidacion.password');
    }



    public function passwordUpdateAdmin(PasswordClientRequest $request)
    {

        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        $auth = Auth::attempt( array(
            'email' => $obj->email,
            'password' => $request->input('password')
            ));
        if ($auth)
        {
            $newPassword = bcrypt($request->input('new_password'));
            $obj->password = $newPassword;
            $obj->save();
            //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
            Session::flash('message', 'Su contraseña fue actualizada!');
            Session::flash('alert-class','alert-success');
        } else {
            Session::flash('message', 'Contraseña Incorrecta!');
            Session::flash('alert-class','alert-danger');
        }
        return redirect('admin');
    }
    public function passwordUpdateUsuarioPesca(PasswordClientRequest $request)
    {

        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        $auth = Auth::attempt( array(
            'email' => $obj->email,
            'password' => $request->input('password')
            ));
        if ($auth)
        {
            $newPassword = bcrypt($request->input('new_password'));
            $obj->password = $newPassword;
            $obj->save();
            //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
            Session::flash('message', 'Su contraseña fue actualizada!');
            Session::flash('alert-class','alert-success');
        } else {
            Session::flash('message', 'Contraseña Incorrecta!');
            Session::flash('alert-class','alert-danger');
        }
        return redirect('usuarioPesca');
    }
    public function passwordUpdateUsuarioIntermediario(PasswordClientRequest $request)
    {

        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        $auth = Auth::attempt( array(
            'email' => $obj->email,
            'password' => $request->input('password')
            ));
        if ($auth)
        {
            $newPassword = bcrypt($request->input('new_password'));
            $obj->password = $newPassword;
            $obj->save();
            //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
            Session::flash('message', 'Su contraseña fue actualizada!');
            Session::flash('alert-class','alert-success');
        } else {
            Session::flash('message', 'Contraseña Incorrecta!');
            Session::flash('alert-class','alert-danger');
        }
        return redirect('usuarioIntermediario');
    }
    public function passwordUpdateUsuarioValidacion(PasswordClientRequest $request)
    {

        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        $auth = Auth::attempt( array(
            'email' => $obj->email,
            'password' => $request->input('password')
            ));
        if ($auth)
        {
            $newPassword = bcrypt($request->input('new_password'));
            $obj->password = $newPassword;
            $obj->save();
            //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
            Session::flash('message', 'Su contraseña fue actualizada!');
            Session::flash('alert-class','alert-success');
        } else {
            Session::flash('message', 'Contraseña Incorrecta!');
            Session::flash('alert-class','alert-danger');
        }
        return redirect('usuarioValidacion');
    }

}
    
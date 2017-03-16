<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\PasswordClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Http\Requests\Client\StoreClientMasterRequest;
use App\Http\Requests\Client\PasswordClientMasterRequest;
use App\Http\Requests\Client\UpdateClientMasterRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Models\Preference;
use App\Models\Category;
use Auth;
use Session;
use Carbon\Carbon;
use App\Services\FileService;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->file_service = new FileService();
    }
    public function index()
    {
        $clients = User::where('role_id','1')->paginate(10);
        return view('internal.admin.client.clients', ['clients' => $clients]);
    }
    public function indexMaster()
    {
        $clientsMaster = User::where('role_id','8')->paginate(10);
        return view('internal.admin.client.clientsMaster', ['clientsMaster' => $clientsMaster]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function desactive(Request $request)
    {
        $input = $request->all();
        if(isset($input['client_id']))
        {
            $user = User::findOrFail($input['client_id']);
            $user->delete();
            //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
            Session::flash('message', 'Cliente Borrado!');
            Session::flash('alert-class','alert-success');
        } else {
            Session::flash('message', 'Cliente no encontrado!');
            Session::flash('alert-class','alert-danger');
        }
        return redirect('/admin/client');
    }

    public function desactiveMaster(Request $request)
    {
        $input = $request->all();
        if(isset($input['client_id']))
        {
            $user = User::findOrFail($input['client_id']);
            $user->delete();
            //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
            Session::flash('message', 'Cliente Borrado!');
            Session::flash('alert-class','alert-success');
        } else {
            Session::flash('message', 'Cliente no encontrado!');
            Session::flash('alert-class','alert-danger');
        }
        return redirect('/admin/clientMaster');
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
    public function createClientMaster()
    {
        //
        return view('internal.admin.client.newClientMaster');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $users = User::where('email',$request['email'])->get();
        if (count($users)!=0){
            return back()->withErrors(['Ya Registro este email']);
        }
        $input = $request->all();
        $user = new User ;
        $user->name = $input['name'];
        $user->lastName = $input['lastname'];
        $user->password = bcrypt($input['password']);
        $user->di_type = 1;
        $user->di = $input['di'];
        $user->address = $input['address'];
        $user->phone = $input['phone'];
        $user->email = $input['email'];
        $user->image = "images/avatar_2x.png";
        $user->points = 0;
        $user->birthday = new Carbon($input['birthday']);
        $user->role_id = Role::where('description','client')->get()->first()->id;
        $user->save();

        Session::flash('message', 'Su cuenta se ha creado. Puede iniciar sesión');
        Session::flash('alert-class','alert-success');
        return redirect('/');
    }

    public function storeClientMaster(StoreClientMasterRequest $request)
    {
        $users = User::where('email',$request['email'])->get();
        if (count($users)!=0){
            return back()->withErrors(['Ya Registro este email']);
        }
        $input = $request->all();
        $user = new User ;
        $user->name = $input['name'];
        $user->lastName = $input['lastname'];
        $user->password = bcrypt($input['password']);
        $user->di_type = 1;
        $user->di = $input['di'];
        $user->address = $input['address'];
        $user->phone = $input['phone'];
        $user->email = $input['email'];
        $user->image = "images/avatar_2x.png";
        $user->points = 0;
        $user->birthday = new Carbon($input['birthday']);
        $user->role_id      =   8;
        $user->save();

        

        return redirect('admin/clientMaster');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        
        //return view('internal.client.edit', ['obj' => $obj]);
        //return $categories;
        return view('internal.client.edit', compact('obj'));
    }
    public function editClientMaster()
    {
        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        
        //return view('internal.client.edit', ['obj' => $obj]);
        //return $categories;
        return view('internal.clientMaster.edit', compact('obj'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request)
    {
        $id = Auth::user()->id;
        $obj = User::findOrFail($id);

        $input = $request->all();

        $obj->name = $input['name'];
        $obj->lastname = $input['lastname'];
        $obj->address = $input['address'];
        $obj->phone = $input['phone'];
        $obj->email = $input['email'];
        $obj->di_type = 1;
        $obj->di = $input['di'];
        $obj->save();

        
        Session::flash('message', 'Información de perfil actualizada!');
        Session::flash('alert-class','alert-success');
        return redirect('client');
    }

    public function updateClientMaster(UpdateClientMasterRequest $request)
    {
        $id = Auth::user()->id;
        $obj = User::findOrFail($id);

        $input = $request->all();

        $obj->name = $input['name'];
        $obj->lastname = $input['lastname'];
        $obj->address = $input['address'];
        $obj->phone = $input['phone'];
        $obj->email = $input['email'];
        $obj->di_type = 1;
        $obj->di = $input['di'];
        $obj->save();

        
        Session::flash('message', 'Información de perfil actualizada!');
        Session::flash('alert-class','alert-success');
        return redirect('clientMaster');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Client profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $id = Auth::user()->id;
        $client = User::findOrFail($id);
        $birthday = strtotime($client->birthday);
        return view('internal.client.profile', ['client' => $client,'birthday'=>$birthday]);
    }
    public function profileMaster()
    {
        $id = Auth::user()->id;

        $client = User::findOrFail($id);
        $birthday = strtotime($client->birthday);
        return view('internal.clientMaster.profile', ['client' => $client,'birthday'=>$birthday]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return view('internal.client.password');
    }
    public function passwordClientMaster()
    {
        return view('internal.clientMaster.password');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordUpdate(PasswordClientRequest $request)
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
            Session::flash('message', 'Contraseña incorrecta!');
            Session::flash('alert-class','alert-danger');
        }
        return redirect('client');
    }
    public function passwordUpdateClientMaster(PasswordClientMasterRequest $request)
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
            Session::flash('message', 'Contraseña incorrecta!');
            Session::flash('alert-class','alert-danger');
        }
        return redirect('clientMaster');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function photoEdit()
    {
        return view('internal.client.photo');
    }
    public function photoEditClientMaster()
    {
        return view('internal.clientMaster.photo');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function photoUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        $this->validate($request, [
            'image' => 'required|image'
        ]);
        $obj->image = $this->file_service->upload($request->file('image'),'client');
        $obj->save();
        //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
        Session::flash('message', 'Su imagen se actualizo!');
        Session::flash('alert-class','alert-success');
        return redirect('clientMaster');
    }
    public function photoUpdateClientMaster(Request $request)
    {
        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        $this->validate($request, [
            'image' => 'required|image'
        ]);
        $obj->image = $this->file_service->upload($request->file('image'),'clientMaster');
        $obj->save();
        //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
        Session::flash('message', 'Su imagen se actualizo!');
        Session::flash('alert-class','alert-success');
        return redirect('clientMaster');
    }
}

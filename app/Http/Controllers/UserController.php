<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with([
                'roles',
            ])
            ->orderBy('id', 'desc')
            ->where(function($query) use ($request){
                if($request->has('name')){
                    $name = $request->get('name');
                    $query->where('name', 'like', "%{$name}%");
                }

                if($request->has('email')){
                    $email = $request->get('email');
                    $query->where('email', 'like', "%{$email}%");
                }
            })
            ->paginate(20);
        
        return view('users.index', [
            'users' => $users,
            'filter' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            return view('users.create_modal'); 
        }
        
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);

        if($request->ajax()){
            return [
                'urlRedirect' => url('/users'),
            ];
        }
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
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit_modal', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if($request->has('password')){
            $user->password = bcrypt($request->get('password'));
        }

        $user->save();

        if($request->ajax()){
            return [
                'urlRedirect' => url('/users'),
            ];
        }
    }

    public function assignRole($id)
    {
        $user = User::with([
                'roles'
            ])
            ->findOrFail($id);

        $userRoles = $user->roles()
            ->lists('role_id');

        $roles = Role::orderBy('sort', 'asc')->get();

        return view('users.assign_role', compact('user', 'userRoles', 'roles'));
    }

    public function storeAssignRole(Request $request, $id)
    {
        $user = User::with(['roles'])
            ->whereId($id)
            ->firstOrFail();

        if($user->roles != null){
            $user->roles()->detach();
        }

        if($request->has('roles')){

            foreach($request->get('roles') as $role){
                $role = Role::find($role);

                if(! is_null($role)){
                    $user->assignRole($role->name);
                }
            }

            flash()->success(
                trans('user.label.name'),
                trans('user.message_alert.assign_role_success')
            );

            return redirect('/users');
        }   

        flash()->success(
            trans('user.label.name'),
            trans('user.message_alert.assign_role_error')
        );

        return redirect('/users');       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $response = User::deleteByCondition($id);

        if($request->ajax())
            return $response;

        if($response['status']){
            flash()
                ->success(
                    trans('user.label.name'),
                    $response['message']
                );
        }else{
            flash()
                ->success(
                    trans('user.label.name'),
                    $response['message']
                );
        }

        return redirect('/users');
    }
}

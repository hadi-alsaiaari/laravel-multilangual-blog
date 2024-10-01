<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if (auth()->user()->can('viewAny', User::class)) {
            $users = User::get();
        } else {
            $users = User::where('id', $user->id)->get();
        }
        
        return view('dashboard.users.index',['users' => $users]);
    }

    public function getUsersDatatable()
    {
        $data = User::select('*');
        return   $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $user = new User();
        return view('dashboard.users.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $validatedData)
    {
        $this->authorize('create', User::class);

        $password = Str::password();
        $user = User::create([
            'name' => $validatedData['name'],
            'status' => $validatedData['status'],
            'email' => $validatedData['email'],
            'password' => Hash::make($password),
        ]);
        
        // event(new CreateNewUser($user, $password));
        return redirect()->route('dashboard.users.index')->with('success', __('words.success_create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('dashboard.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $validatedData, User $user)
    {
        $this->authorize('update', $user);

        $user->update([
            'name' => $validatedData['name'],
            'status' => $validatedData['status'],
            'email' => $validatedData['email'],
        ]);
        
        return redirect()->route('dashboard.users.index')->with('success', __('words.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        $message = __('deleted successfully');
        if (Auth::user()->id != $id) {
            $user->delete();
            return[
                'message' => $message,
                'is_he' => false,
            ];
        }
        $user->delete();
        return[
            'message' => $message,
            'is_he' => true,
        ];
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $this->authorize('delete', $user);

        if (!empty($user)) {
            $user->delete();
        return Redirect::route('dashboard.users.index')
            ->with('success', __('words.success_delete'));
        } 
        return Redirect::route('dashboard.users.index')
            ->with('danger', __('words.success_error'));
    }
}

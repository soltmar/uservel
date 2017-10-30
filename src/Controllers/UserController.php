<?php

namespace marsoltys\uservel\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use User;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $select = config('uservel.displayProperties');
        $select[] = 'id';
        $users = \User::select($select)->get();
        return view('uservel::list')->with([
            'user'  => Auth::user(),
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uservel::edit', [
            'title' => 'Create User'
        ]);
    }

    /**
     * Store a newly created user in database.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$data = $request->only('name', 'username', 'email', 'password', 'confirm-password');
        $data = $request->validate([
            'username' => 'required|unique:users|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'nullable',
            'confirm-password' => 'same:password'
        ]);
        if (User::create($data)) {
            return redirect()->route('user.index');
        }
    }

    /**
     * Display the specified user.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('uservel::edit', [
            'user'=>$user,
            'title' => 'Update '. $user->name
            ]);
    }

    /**
     * Update the specified user in database.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified user from database.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    function index() {
        return User::all();
    }

    function store(UserRequest $request) {
        $data = $request->validated();
        $sites = $data['sites'];
        unset($data['sites']);
        $user = User::create($data);
        if (count($sites) > 0)
            $user->sites()->sync($sites);
        return $user;
    }

    function show($id) {
    }

    function update(Request $request, $id) {
    }

    function destroy(User $user) {
        $user->delete();
        return $user;
    }

    function me() {
        $user = Auth::user();
        return $user;
    }

    function auth(Request $request, User $user) {
        return response()->json($user->auth($request->get('password')));
    }
}

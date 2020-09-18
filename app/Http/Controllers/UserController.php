<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\User;

class UserController extends Controller
{

    public function index()
    {

        $users = User::all();

        return Response(
            [
                "total" => count($users),
                "users" => $users,
                "status" => 200
            ],
            200
        );
    }


    public function create()
    {

        // **check if user already exists
        $user = User::get()->where("email", "client2@mail.com");

        if ($user) {
            return Response(
                [
                    "message" => "email already exists",
                    "status" => 400,
                ],
                400
            );
        }

        $data = [
            "name" => "client2",
            "email" => "client2@mail.com",
            "password" => "client1234"
        ];

        User::create($data);


        return Response(
            [
                "message" => "user created succesfully",
                "status" => 201,
            ],
            201
        );
    }


    // **UPLOAD AVATAR
    public function uploadAvatar(Request $request)
    {

        if ($request->hasFile('avatar')) {

            $this->deleteOldAvatar();

            $filename = $request->avatar->getClientOriginalName();
            $request->avatar->storeAs('images', $filename, 'public');
            auth()->user()->update(['avatar' => $filename]);

            return redirect('home')->with('success', 'Avatar updated');
        }

        return redirect('home')->with('error', 'Update failed');
    }


    protected function deleteOldAvatar()
    {

        // *DELETE OLD AVATAR FROM STORAGE IF EXISTS
        if (auth()->user()->avatar) {
            Storage::delete('/public/images/' . auth()->user()->avatar);
        }
    }
}

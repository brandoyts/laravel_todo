<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{   
    // **FETCH ALL USERS
    public function index() {

        $users = User::all();
        
        return Response(
            [
                "total"=> count($users), 
                "users"=> $users,
                "status"=> 200
            ], 
                200);
    }


    // **CREATE A USER
    public function create() {
        
        // **check if user already exists
        $user = User::get()->where("email", "client2@mail.com");
        
        if($user) {
            return Response(
                [
                    "message"=> "user already exists",
                    "status"=> 400,
                ],
                400
            );
        } 

        $data = [
            "name"=> "client2",
            "email"=> "client2@mail.com",
            "password"=> "client1234"
        ];

        User::create($data);
        

        return Response(
            [
                "message"=> "user created succesfully",
                "status"=> 201,
            ],
            201
        );
    }
}

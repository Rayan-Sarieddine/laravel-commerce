<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UsersController extends Controller
{
    public function signIn(Request $req){
        $validatedData = $req->validate([
            'user_email' => 'required|string',
            'password' => 'required|string',
        ]);
        $user = User::where('user_email', $validatedData['user_email'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials']);
        }
        else{
            return response()->json(['message' => 'Logged In']);
        }

    }
    public function signUp(Request $req){
        $validatedData = $req->validate([
            'user_name' => 'required|string',
            'user_email' => 'required|unique:users|string',
            'password' => 'required|string|min:10|max:15',
            'user_role' => 'required|string',
        ]);

        $user=User::create([
            'user_name'=>$validatedData['user_name'],
            'user_email'=>$validatedData['user_email'],
            'password'=>Hash::make($validatedData['password']),
            'user_role'=>$validatedData['user_role'],
        ]);
        return response()->json(['message'=>"signed up"]);
    }
    public function getUser(Request $req){
      
        $id=$req->id;
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['user' => $user]);
        }
    
    public function getAllUsers(){
$users=User::all();
return response()->json(['users'=> $users]);
    }
    public function updateUser(Request $req){
        $id=$req->id;
        $user = User::find($id);
    
        if (!$user) {
            return response()->json(['message' => 'User not found']);
        }
        $validatedData = $req->validate([
            'user_name' => 'required|string',
            'user_email' => 'required|unique:users,user_email,'.$id.',id|string',
            'password' => 'nullable|string|min:10|max:15',
            'user_role' => 'required|string',
        ]);
        $user->user_name = $validatedData['user_name'];
        $user->user_email = $validatedData['user_email'];
        $user->user_role = $validatedData['user_role'];
    
        if (isset($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
    
        $user->save();
    
        return response()->json(['message' => 'User updated successfully']);
    }
    public function deleteUser(Request $req){
        $id= $req->id;
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message'=> 'user not found']);
        }
        $user->delete();


    }
}

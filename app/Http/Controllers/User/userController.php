<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class userController extends Controller
{
    // Halaman utama
    public function index()
    {
        $user = User::orderBy('created_at', 'desc')->paginate(7);
        return view('user', compact(
            'user'
        )); // View Blade Anda
    }

    public function addData(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:4',
            'role' => 'required',
        ]);

        $saveData = new User();
        $saveData->name = $request->username;
        $saveData->email = $request->email;
        $saveData->password = Hash::make($request->password);
        $saveData->role = $request->role;
        $saveData->save();

        return redirect()->back()->with(
            'message',
            'Save Data Success'
        );
    }



    // Data untuk DataTables
    public function getData(Request $request)
    {
        Log::info('getData function called'); 
        $users = User::query();

        return DataTables::of($users)
            ->addIndexColumn() // Nomor otomatis
            ->make(true);

            // dd($users->get());
    }
}

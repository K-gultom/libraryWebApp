<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\bookCategory;
use Illuminate\Http\Request;

class categoryBookController extends Controller
{
    public function index()
    {
        $getCategory = bookCategory::orderBy('created_at', 'desc')->paginate(5);
        return view('add-category', compact('getCategory'));
    }
    
    public function addProcess(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'nomor_rak' => 'required',
        ]);

        $saveData = new bookCategory();
        $saveData-> category = $request->category;
        $saveData-> nomor_rak = $request->nomor_rak;
        $saveData->save();

        return redirect()->back()->with(
            'message',
            'Save Data Success'
        );
    }
    
}

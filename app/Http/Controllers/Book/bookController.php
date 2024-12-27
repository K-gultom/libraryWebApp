<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\book;
use App\Models\bookCategory;
use Illuminate\Http\Request;

class bookController extends Controller
{
    public function index()
    {
        $getBookInfo = book::with('getCategory')->orderBy('created_at', 'desc')->paginate(5);

        $getCategory = bookCategory::all();
        return view('add-book', compact('getBookInfo', 'getCategory'));
    }
    
    public function addProcess(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
        ]);

        $saveData = new book();
        $saveData-> category_id = $request->category_id;
        $saveData-> judul = $request->judul;
        $saveData-> pengarang = $request->pengarang;
        $saveData-> penerbit = $request->penerbit;
        $saveData-> tahun_terbit = $request->tahun_terbit;
        $saveData->save();

        return redirect()->back()->with(
            'message',
            'Save Data Success'
        );
    }
}

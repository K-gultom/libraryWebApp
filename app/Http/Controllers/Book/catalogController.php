<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\book;
use App\Models\keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class catalogController extends Controller
{
    public function index()
    {
        $infoCatalog = book::all();
        return view('catalog', compact('infoCatalog'));
    }

    public function checkoutKeranjang(Request $request)
    {

        $order = $request->id_order;

        $saveKeranjang = new keranjang();
        $saveKeranjang->id_buku = $order;
        $saveKeranjang->user_id = Auth::user()->id;
        $saveKeranjang->save();

        return redirect()->back()->with(
            'message',
            'Item add to chart'
        );
    }
}

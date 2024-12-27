<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Models\keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class keranjangController extends Controller
{
    public function index()
    {
        // Ambil ID User yang sedang login
        $idUser = Auth::user()->id;

        // Ambil data keranjang dan relasi dengan buku berdasarkan user_id
        $getData = keranjang::with('getBook')
            ->where('user_id', $idUser)
            ->whereHas('getBook', function ($query) {
                $query->whereNotNull('id'); // Memastikan id_buku tidak null
            })
            ->get();

        // Kelompokkan berdasarkan id_buku dan jumlahkan item yang sama
        $groupedData = $getData->groupBy(function($item) {
            return $item->getBook->id; // Kelompokkan berdasarkan id_buku
        });

        // dd($groupedData);

        // Kirim data ke view
        return view('keranjang', compact('groupedData'));
    }

    public function addCart(Request $request)
    {
        $bookId = $request->id_order;

        // Validasi bahwa ID buku tidak kosong
        if (!$bookId) {
            return redirect()->back()->with('error', 'ID Buku tidak valid.');
        }

        // Tambahkan item ke keranjang
        $saveKeranjang = new keranjang();
        $saveKeranjang->id_buku = $bookId;
        $saveKeranjang->user_id = Auth::user()->id;
        $saveKeranjang->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('message', 'Item berhasil ditambahkan ke keranjang.');

    }

    public function cancelCheckout(Request $request)
    {
        // Ambil ID yang diterima dari formulir
        $cancelId = $request->id_order_cancel;

        // Cari keranjang berdasarkan ID
        $cancelBorrow = keranjang::find($cancelId);

        // Pastikan data ditemukan dan id_buku tidak null
        if ($cancelBorrow && $cancelBorrow->id_buku !== null) {
            $cancelBorrow->delete(); // Hapus data jika valid
            return redirect()->back()->with('message', 'Buku dihapus dari Cart');
        }

        // Tampilkan pesan error jika data tidak valid
        return redirect()->back()->with('error', 'Data tidak valid atau sudah dihapus.');
    }




    
}

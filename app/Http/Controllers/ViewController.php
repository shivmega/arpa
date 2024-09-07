<?php

namespace App\Http\Controllers;

use App\Models\Bumdesa;
use App\Models\Desa;
use App\Models\Laporan;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ViewController extends Controller
{
    //Halaman Desa
    public function desa(Request $request)
    {
        if ($request->keyword) {
            $desas = Desa::search($request->keyword)->paginate(7);
        } else {
            $desas = Desa::paginate(7);
        }
        return view('desa', ['desas' => $desas]);
    }
    //Halaman Edit Desa
    public function edit_desa(Desa $desa)
    {
        return view('edit_desa', ['desa' => $desa]);
    }
    //Halaman Tambah Desa
    public function tambah_desa()
    {
        return view('tambah_desa');
    }

    //Halaman Umkm, Desa xor All
    public function umkm_desa_xor_all()
    {
        if (Auth::user()->role == 'desa') {
            return redirect('/umkm_desa');
        } else {
            return redirect('/umkm');
        }
    }
    //Halaman Umkm All
    public function umkm(Request $request)
    {
        $desa = $request->desa;
        if ($desa) {
            $desas = Desa::find($desa)->get();
            $umkms = Umkm::where('desa', $desa)->paginate(5)->appends(['desa' => $desa]);
            return view('umkm', ['desas' => $desas, 'umkms' => $umkms]);
        } else {
            $umkms = Umkm::paginate(5);
            $desas = Desa::all();
            return view('umkm', ['desas' => $desas, 'umkms' => $umkms]);
        }
    }
    //Halaman Umkm Desa
    public function umkm_desa()
    {
        $desa = Auth::user()->desa;
        $umkms = Umkm::where('desa', $desa)->paginate(5);
        $desas = Desa::all();
        return view('umkm_desa', ['desas' => $desas, 'umkms' => $umkms]);
    }
    //Halaman Rincian Desa
    public function rincian_desa(Desa $desa)
    {
        return view('rincian_desa', ['desa' => $desa]);
    }
    //Halaman Tambah Umkm
    public function tambah_umkm()
    {
        $desa_pengguna = Desa::find(Auth::user()->desa);
        $desas = Desa::all();
        return view('tambah_umkm', ['desas' => $desas, 'desa_pengguna' => $desa_pengguna]);
    }
    //Halaman Tambah Bumdesa
    public function tambah_bumdesa()
    {
        $desa_pengguna = Desa::find(Auth::user()->desa);
        $desas = Desa::all();
        return view('tambah_bumdesa', ['desas' => $desas, 'desa_pengguna' => $desa_pengguna]);
    }
    //Halaman Edit Umkm
    public function edit_umkm(Umkm $umkm)
    {
        if (Auth::user()->role == 'desa' && Auth::user()->desa != $umkm->desa) {
            return redirect()->back()->with('error', "Anda Tidak Memiliki Akses Ini!!!");
        }
        $desa_pengguna = Desa::find(Auth::user()->desa);
        $desas = Desa::all();
        $pasar_online = explode(', ', $umkm->pasar_online);
        return view('edit_umkm', ['umkm' => $umkm, 'desas' => $desas, 'pasar_online' => $pasar_online, 'desa_pengguna' => $desa_pengguna]);
    }
    //Halaman Edit Bumdesa
    public function edit_bumdesa(Bumdesa $bumdesa)
    {
        if (Auth::user()->role == 'desa' && Auth::user()->desa != $bumdesa->desa) {
            return redirect()->back()->with('error', "Anda Tidak Memiliki Akses Ini!!!");
        }
        $desa_pengguna = Desa::find(Auth::user()->desa);
        $desas = Desa::all();
        $aktifitas = ['Pelayanan Umum', 'Penyewaan barang', 'Produksi dan/atau Perdagangan', 'Keuangan', 'Pertanian', 'Pariwisata'];
        $kategori = ['Rintisan', 'Tumbuh', 'Mandiri'];
        return view('edit_bumdesa', ['bumdesa' => $bumdesa, 'desas' => $desas, 'aktifitas' => $aktifitas, 'kategori' => $kategori, 'desa_pengguna' => $desa_pengguna]);
    }
    //Halaman Edit Laporan
    public function edit_laporan(Laporan $laporan)
    {
        if (Auth::user()->role == 'desa' && Auth::user()->desa != $laporan->desa) {
            return redirect()->back()->with('error', "Anda Tidak Memiliki Akses Ini!!!");
        }
        $desa = Desa::find($laporan->desa);

        return view('edit_laporan', ['laporan' => $laporan, 'desa' => $desa]);
    }
    public function tambah_laporan()
    {
        $user = Auth::user();
        if ($user->role == 'desa') {
            $desa_pengguna = Desa::find($user->desa);
            $umkms = Umkm::where('desa', $desa_pengguna->id)->get();
            $bumdesas = Bumdesa::where('desa', $desa_pengguna->id)->get();
            $desas = Desa::all();
            return view('tambah_laporan', ['umkms' => $umkms, 'bumdesas' => $bumdesas, 'desa_pengguna' => $desa_pengguna, 'desas' => $desas]);
        } else {
            $umkms = Umkm::all();
            $desas = Desa::all();
            $bumdesas = Bumdesa::all();
            return view('tambah_laporan', ['umkms' => $umkms, 'bumdesas' => $bumdesas, 'desas' => $desas]);
        }
    }
    //Halaman Laporan, Desa xor All
    public function laporan_desa_xor_all(Request $request)
    {
        $desa = $request->desa;
        $user = Auth::user();
        if ($user->role == 'desa') {
            $desas = Desa::find($user->desa);
            $laporans = Laporan::where('desa', $user->desa)->paginate(7);
            return view('laporan', ['laporans' => $laporans, 'desas' => $desas]);
        } elseif ($desa) {
            $desas = Desa::find($desa)->get();
            $laporans = Laporan::where('desa', $desa)->paginate(7)->appends(['desa' => $desa]);
            return view('laporan', ['laporans' => $laporans, 'desas' => $desas]);
        } else {
            $desas = Desa::all();
            $laporans = Laporan::paginate(7);
            return view('laporan', ['laporans' => $laporans, 'desas' => $desas]);
        }
    }
    //Halaman Rincian or Edit, Laporan
    public function laporan_details(Laporan $laporan)
    {
        if (Auth::user()->role == 'super_admin'||Auth::user()->role == 'desa' && Auth::user()->desa == $laporan->desa) {
            return redirect()->route('halaman.edit.laporan', ['laporan' => $laporan]);
        } elseif (Auth::user()->role =='admin') {
            return redirect()->route('halaman.rincian.laporan', ['laporan' => $laporan]);
        } else {
            return redirect()->back()->with('error', "Anda Tidak Memiliki Akses Ini!!!");
        }
    }
    //Halaman Rincian Laporan
    public function rincian_laporan(Laporan $laporan){
        $desa = Desa::find($laporan->desa);
        return view('rincian_laporan',['laporan'=>$laporan, 'desa'=>$desa]);
    }

    //Halaman Rincian atau Edit, Umkm
    public function umkm_details(Umkm $umkm)
    {
        if (Auth::user()->role == 'super_admin'||Auth::user()->role == 'desa' && Auth::user()->desa == $umkm->desa) {
            return redirect()->route('halaman.edit.umkm', ['umkm' => $umkm]);
        } {
            return redirect()->route('halaman.rincian.umkm', ['umkm' => $umkm]);
        }
    }
    //Halaman Rincian atau Edit, Bumdesa
    public function bumdesa_details(Bumdesa $bumdesa)
    {
        if (Auth::user()->role == 'super_admin'||Auth::user()->role == 'desa' && Auth::user()->desa == $bumdesa->desa) {
            return redirect()->route('halaman.edit.bumdesa', ['bumdesa' => $bumdesa]);
        } {
            return redirect()->route('halaman.rincian.bumdesa', ['bumdesa' => $bumdesa]);
        }
    }
    //Halaman Rincian Umkm
    public function rincian_umkm(Umkm $umkm)
    {
        $desas = Desa::all();
        $pasar_online = explode(', ', $umkm->pasar_online);
        return view('rincian_umkm', ['umkm' => $umkm, 'desas' => $desas, 'pasar_online' => $pasar_online]);
    }
    //Halaman Bumdesa, Desa xor All
    public function bumdesa_desa_xor_all()
    {
        if (Auth::user()->role == 'desa') {
            return redirect('/bumdesa_desa');
        } else {
            return redirect('/bumdesa');
        }
    }
    //Halaman Bumdesa All
    public function bumdesa(Request $request)
    {
        $desa = $request->desa;
        if ($desa) {
            $desas = Desa::find($desa)->get();
            $bumdesas = Bumdesa::where('desa', $desa)->paginate(5);
            return view('bumdesa', ['desas' => $desas, 'bumdesas' => $bumdesas->appends(['desa' => $desa])]);
        } else {
            $bumdesas = Bumdesa::paginate(5);
            $desas = Desa::all();
            return view('bumdesa', ['desas' => $desas, 'bumdesas' => $bumdesas]);
        }
    }
    public function bumdesa_desa()
    {
        $desa = Auth::user()->desa;
        $bumdesas = Bumdesa::where('desa', $desa)->paginate(5);
        $desas = Desa::all();
        return view('bumdesa_desa', ['desas' => $desas, 'bumdesas' => $bumdesas]);
    }
    public function rincian_bumdesa(Bumdesa $bumdesa)
    {
        $desa = Desa::find($bumdesa->desa);
        $aktifitas = ['Pelayanan Umum', 'Penyewaan barang', 'Produksi dan/atau Perdagangan', 'Keuangan', 'Pertanian', 'Pariwisata'];
        $kategori = ['Rintisan', 'Tumbuh', 'Mandiri'];
        return view('rincian_bumdesa', ['bumdesa' => $bumdesa, 'desa' => $desa, 'aktifitas' => $aktifitas, 'kategori' => $kategori]);
    }
}

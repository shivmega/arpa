<?php

namespace App\Http\Controllers;

use App\Exports\DesaExport;
use App\Exports\UmkmExport;
use App\Exports\BumdesaExport;
use App\Exports\DesaBumdesaExport;
use App\Exports\DesaLaporanExport;
use App\Exports\LaporanExport;
use App\Exports\DesaUmkmExport;
use App\Models\Bumdesa;
use App\Models\Desa;
use App\Models\Laporan;
use App\Models\Umkm;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class ContentController extends Controller
{

    public function create_desa(Request $request)
    {
        $data = $request->validate([
            'nama_desa' => 'required',
            'nama_kades' => 'required',
            'nama_sekdes' => 'nullable',
            'nama_perangkat_desa' => 'nullable',
            'kecamatan' => 'nullable',
            'kabupaten' => 'nullable',
            'jumlah_penduduk' => 'nullable',
            'alamat' => 'nullable',
            'keterangan' => 'nullable'
        ]);
        $newDesa = Desa::create($data);
        return redirect('/desa')->with('success', 'Desa baru berhasil dibuat.');
    }
    public function create_bumdesa(Request $request)
    {
        $data = $request->validate([
            'nama_bumdesa' => 'required',
            'nama_direktur' => 'required',
            'aktifitas' => 'required',
            'tahun_berdiri' => 'nullable',
            'status_hukum' => 'nullable',
            'kategori' => 'nullable',
            'desa' => 'nullable',
            'jumlah_pekerja' => 'nullable',
            'alamat' => 'nullable'
        ]);

        $newBumdesa = Bumdesa::create($data);
        if (Auth::user()->role == 'desa') {
            return redirect()->route('bumdesa_desa')->with('success', 'BUMDesa baru berhasil dibuat.');
        } else {
            return redirect()->route('bumdesa')->with('success', 'BUMDesa baru berhasil dibuat.');
        }
    }
    public function create_umkm(Request $request)
    {
        // $pasar_online = implode(", ", $_POST['pasar_online']);
        //$pasar_online = implode(', ', $request->input('pasar_online'));
        $data = $request->validate([
            'nama_umkm' => 'required',
            'pemilik_umkm' => 'nullable',
            'tahun_berdiri' => 'nullable',
            'produk' => 'required',
            'desa' => 'required',
            'foto_produk' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'jangkauan_pasar' => 'nullable',
            'jumlah_pekerja' => 'nullable',
            'alamat' => 'nullable',
            'omset' => 'nullable',
            'pasar_online' => 'nullable',
            'kontak' => 'nullable',
            'keterangan' => 'nullable'
        ]);
        if ($request->pasar_online) {
            $data['pasar_online'] = implode(', ', $data['pasar_online']);
        } else {
            $data['pasar_online'] = "belum";
        }

        if ($request->file('foto_produk')) {
            $foto = $request->file('foto_produk');
            $filename = date('Y-m-d') . $foto->getClientOriginalName();
            $path = 'foto-produk/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($foto));
            $data['foto_produk'] = $filename;
        }
        //dd($data);
        Umkm::create($data);
        if (Auth::user()->role == 'desa') {
            return redirect()->route('umkm_desa')->with('success', 'UMKM baru berhasil dibuat.');
        } else {
            return redirect()->route('umkm')->with('success', 'UMKM baru berhasil dibuat.');
        }
    }
    public function create_laporan(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'institusi' => 'required',
            'periode' => 'required',
            'desa' => 'required',
            'penyertaan_modal' => 'nullable',
            'omzet' => 'nullable',
            'pendapatan_bersih' => 'nullable',
            'kontribusi_pades' => 'nullable',
        ]);

        Laporan::create($data);
        return redirect('/halaman_laporan')->with('success', 'Laporan baru berhasil dibuat.');
    }
    public function edit_desa(Request $request, Desa $desa)
    {
        $data = $request->validate([
            'nama_desa' => 'required',
            'nama_kades' => 'required',
            'nama_sekdes' => 'nullable',
            'nama_perangkat_desa' => 'nullable',
            'kecamatan' => 'nullable',
            'kabupaten' => 'nullable',
            'jumlah_penduduk' => 'nullable',
            'alamat' => 'nullable',
            'keterangan' => 'nullable'
        ]);

        $desa->update($data);
        return redirect('/desa')->with('success', 'Desa berhasil diubah');
    }
    public function edit_bumdesa(Request $request, Bumdesa $bumdesa)
    {
        $data = $request->validate([
            'nama_bumdesa' => 'required',
            'nama_direktur' => 'required',
            'aktifitas' => 'required',
            'tahun_berdiri' => 'nullable',
            'status_hukum' => 'nullable',
            'kategori' => 'nullable',
            'desa' => 'nullable',
            'jumlah_pekerja' => 'nullable',
            'alamat' => 'nullable'
        ]);

        $bumdesa->update($data);
        if (Auth::user()->role == 'desa') {
            return redirect()->route('bumdesa_desa')->with('success', 'BUMDesa baru berhasil dibuat.');
        } else {
            return redirect()->route('bumdesa')->with('success', 'BUMDesa baru berhasil dibuat.');
        }
    }
    public function edit_umkm(Request $request, Umkm $umkm)
    {
        $data = $request->validate([
            'nama_umkm' => 'required',
            'pemilik_umkm' => 'nullable',
            'tahun_berdiri' => 'nullable',
            'produk' => 'required',
            'desa' => 'required',
            'foto_produk' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'jangkauan_pasar' => 'nullable',
            'jumlah_pekerja' => 'nullable',
            'alamat' => 'nullable',
            'omset' => 'nullable',
            'pasar_online' => 'nullable',
            'kontak' => 'nullable',
            'keterangan' => 'nullable'
        ]);
        if ($request->pasar_online) {
            $data['pasar_online'] = implode(', ', $data['pasar_online']);
        } else {
            $data['pasar_online'] = "belum";
        }

        if ($request->file('foto_produk')) {
            $foto = $request->file('foto_produk');
            $filename = date('Y-m-d') . $foto->getClientOriginalName();
            $path = 'foto-produk/' . $filename;
            if ($umkm->foto_produk) {
                Storage::disk('public')->delete('foto-produk/' . $umkm->foto_produk);
            };
            Storage::disk('public')->put($path, file_get_contents($foto));
            $data['foto_produk'] = $filename;
        }
        $umkm->update($data);
        if (Auth::user()->role == 'desa') {
            return redirect()->route('umkm_desa')->with('success', 'UMKM baru berhasil dibuat.');
        } else {
            return redirect()->route('umkm')->with('success', 'UMKM baru berhasil dibuat.');
        }
    }
    public function edit_laporan(Request $request, Laporan $laporan)
    {
        $data = $request->validate([
            'penyertaan_modal' => 'nullable',
            'omzet' => 'nullable',
            'pendapatan_bersih' => 'nullable',
            'kontribusi_pades' => 'nullable',
        ]);
        // dd($data);
        $laporan->update($data);
        return redirect()->route('halaman_laporan');
    }

    public function delete_desa(Desa $desa)
    {
        $desa->delete();
        return redirect('/desa')->with('success', 'Desa Berhasil dihapus');
    }
    public function delete_bumdesa(Bumdesa $bumdesa)
    {
        $bumdesa->delete();
        if (Auth::user()->role == 'desa') {
            return redirect()->route('bumdesa_desa')->with('success', 'BUMDesa baru berhasil dibuat.');
        } else {
            return redirect()->route('bumdesa')->with('success', 'BUMDesa baru berhasil dibuat.');
        }
    }
    public function delete_umkm(Umkm $umkm)
    {
        $umkm->delete();
        if (Auth::user()->role == 'desa') {
            return redirect()->route('umkm_desa')->with('success', 'UMKM baru berhasil dibuat.');
        } else {
            return redirect()->route('umkm')->with('success', 'UMKM baru berhasil dibuat.');
        }
    }
    public function delete_laporan(Laporan $laporan)
    {
        $laporan->delete();
        return redirect()->route('halaman_laporan');
    }

    public function desa_details(Desa $desa)
    {
        if (Auth::user()->role == 'desa') {
            return redirect()->route('halaman.rincian.desa', ['desa' => $desa]);
        } else {
            return redirect()->route('halaman.edit.desa', ['desa' => $desa]);
        }
    }

    public function export_pdf_desa()
    {
        $desas = Desa::all();
        $pdf = Pdf::loadView('exported.desa', ['desas' => $desas])->setPaper('landscape');
        return $pdf->download('data-desa-' . Carbon::now()->timestamp . '.pdf');
    }

    public function export_pdf_umkm()
    {
        $desas = Desa::all();
        $umkms = Umkm::all();
        $pdf = Pdf::loadView('exported.umkm', ['umkms' => $umkms, 'desas' => $desas])->setPaper([0, 0, 612, 936], 'landscape');
        return $pdf->download('data-umkm-' . Carbon::now()->timestamp . '.pdf');
    }
    public function export_pdf_bumdesa()
    {
        $desas = Desa::all();
        $bumdesas = Bumdesa::all();
        $pdf = Pdf::loadView('exported.bumdesa', ['bumdesas' => $bumdesas, 'desas' => $desas]);
        return $pdf->download('data-bumdesa-' . Carbon::now()->timestamp . '.pdf');
    }
    public function export_pdf_laporan()
    {
        $desas = Desa::all();
        $laporans = Laporan::all();
        $pdf = Pdf::loadView('exported.laporan', ['laporans' => $laporans, 'desas' => $desas ]);
        return $pdf->download('data-laporan-' . Carbon::now()->timestamp . '.pdf');
    }

    public function export_excel_desa()
    {
        return Excel::download(new DesaExport, 'desa' . Carbon::now()->timestamp . '.xlsx');
    }
    public function export_excel_umkm()
    {
        return Excel::download(new UmkmExport, 'umkm' . Carbon::now()->timestamp . '.xlsx');
    }
    public function export_excel_bumdesa()
    {
        return Excel::download(new BumdesaExport, 'bumdesa' . Carbon::now()->timestamp . '.xlsx');
    }
    public function export_excel_laporan()
    {
        return Excel::download(new LaporanExport, 'laporan' . Carbon::now()->timestamp . '.xlsx');
    }
    public function export_pdf_umkm_desa()
    {
        $desas = Desa::all();
        $umkms = Umkm::where('desa', Auth::user()->desa)->get();
        $pdf = Pdf::loadView('exported.umkm', ['umkms' => $umkms, 'desas' => $desas])->setPaper([0, 0, 612, 936], 'landscape');
        return $pdf->download('data-umkm-' . Desa::find(Auth::user()->desa)->nama_desa . '-' . Carbon::now()->timestamp . '.pdf');
    }
    public function export_excel_umkm_desa()
    {
        return Excel::download(new DesaUmkmExport, 'data-umkm-desa-'.Desa::find(Auth::user()->desa)->nama_desa. '-'. Carbon::now()->timestamp . '.xlsx');
    }
    public function export_pdf_bumdesa_desa()
    {
        $desas = Desa::all();
        $bumdesas = Bumdesa::where('desa', Auth::user()->desa)->get();
        $pdf = Pdf::loadView('exported.bumdesa', ['bumdesas' => $bumdesas, 'desas' => $desas]);
        return $pdf->download('data-bumdesa-' . Desa::find(Auth::user()->desa)->nama_desa . '-' . Carbon::now()->timestamp . '.pdf');
    }
    public function export_excel_bumdesa_desa()
    {
        return Excel::download(new DesaBumdesaExport, 'data-bumdesa-desa-'.Desa::find(Auth::user()->desa)->nama_desa. '-'. Carbon::now()->timestamp . '.xlsx');
    }

    public function export_pdf_laporan_desa()
    {
        $desas = Desa::all();
        $laporans = Laporan::where('desa', Auth::user()->desa)->get();
        $pdf = Pdf::loadView('exported.laporan', ['laporans' => $laporans, 'desas' => $desas ]);
        return $pdf->download('data-laporan-' . Desa::find(Auth::user()->desa)->nama_desa . '-' . '.pdf');
    }
    public function export_excel_laporan_desa()
    {
        return Excel::download(new DesaLaporanExport, 'laporan-desa-'.Desa::find(Auth::user()->desa)->nama_desa. '-'. Carbon::now()->timestamp . '.xlsx');    }
}

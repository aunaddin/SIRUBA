<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Bidang;
use App\Models\Ruang;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Update status setiap kali halaman dibuka
        $this->updateStatusAutomatically();

        // Hanya ambil peminjaman dengan status pending atau ongoing
        $peminjamans = Peminjaman::with('bidang', 'ruang')
            ->whereIn('status', ['pending', 'ongoing'])
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $bidangs = Bidang::all();
        $ruangs = Ruang::all();
        return view('peminjaman.create', compact('bidangs', 'ruangs'));
    }

    public function store(Request $request)
    {
        $this->validateData($request);

        if ($this->checkConflict($request)) {
            return back()->withErrors(['Ruang sudah dipinjam pada jam tersebut.'])->withInput();
        }

        if ($this->checkCapacity($request)) {
            return back()->withErrors(['Jumlah peserta melebihi kapasitas ruang. Silakan pilih ruang lain.'])->withInput();
        }

        Peminjaman::create($request->all());
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $bidangs = Bidang::all();
        $ruangs = Ruang::all();
        return view('peminjaman.edit', compact('peminjaman', 'bidangs', 'ruangs'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $this->validateData($request, $peminjaman->id);

        if ($this->checkConflict($request, $peminjaman->id)) {
            return back()->withErrors(['Ruang sudah dipinjam pada jam tersebut.'])->withInput();
        }

        if ($this->checkCapacity($request)) {
            return back()->withErrors(['Jumlah peserta melebihi kapasitas ruang. Silakan pilih ruang lain.'])->withInput();
        }

        $peminjaman->update($request->all());
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }

    public function history(Request $request)
    {
        $this->updateStatusAutomatically();

        $query = Peminjaman::with('bidang', 'ruang')
            ->where('status', 'completed')
            ->orderBy('tanggal', 'desc');

        // Filter berdasarkan tanggal (jika diisi)
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Filter berdasarkan ruang (jika diisi)
        if ($request->filled('ruang_id')) {
            $query->where('ruang_id', $request->ruang_id);
        }

        // Pagination 10 data per halaman
        $peminjamans = $query->paginate(10)->withQueryString();

        // Kirim daftar ruang ke view
        $ruangs = Ruang::all();

        return view('peminjaman.history', compact('peminjamans', 'ruangs'));
    }


    private function validateData($request)
    {
        $request->validate([
            'bidang_id' => 'nullable|exists:bidangs,id',
            'bidang_manual' => 'nullable|string',
            'ruang_id' => 'required|exists:ruangs,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'nama_acara' => 'required|string',
            'jumlah_peserta' => 'required|integer',
            'penanggung_jawab' => 'required|string',
        ]);
    }

    private function checkConflict($request, $ignoreId = null)
    {
        $query = Peminjaman::where('ruang_id', $request->ruang_id)
            ->where('tanggal', $request->tanggal)
            ->where(function ($q) use ($request) {
                $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            });

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }

    private function checkCapacity($request)
    {
        $ruang = Ruang::find($request->ruang_id);
        return $request->jumlah_peserta > $ruang->kapasitas;
    }

    private function updateStatusAutomatically()
    {
        $now = now();

        // Update ongoing jika acara sedang berjalan
        Peminjaman::where('status', 'pending')
            ->whereDate('tanggal', $now->toDateString())
            ->where('jam_mulai', '<=', $now->format('H:i:s'))
            ->where('jam_selesai', '>=', $now->format('H:i:s'))
            ->update(['status' => 'ongoing']);

        // Update completed jika waktu sudah lewat
        Peminjaman::whereIn('status', ['pending', 'ongoing'])
            ->where(function ($q) use ($now) {
                $q->whereDate('tanggal', '<', $now->toDateString())
                    ->orWhere(function ($sub) use ($now) {
                        $sub->whereDate('tanggal', $now->toDateString())
                            ->where('jam_selesai', '<', $now->format('H:i:s'));
                    });
            })
            ->update(['status' => 'completed']);
    }
}
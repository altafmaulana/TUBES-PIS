<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    // INDEX: Menampilkan daftar semua pengumuman (Halaman Admin)
    public function index()
    {
        // Mengambil data terbaru paling atas
        $announcements = Announcement::latest()->get();
        return view('announcements.index', compact('announcements'));
    }

    //2. CREATE: Menampilkan Formulir Pembuatan Pengumuman
    public function create()
    {
        // Mengarah ke file view: resources/views/announcements/create.blade.php
        return view('announcements.create');
    }

    //3. STORE: Menyimpan data dari Form ke Database
    public function store(Request $request)
    {
        // A. Validasi Input
        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'type'    => 'required|in:info,urgent,warning',
        ]);

        // C. Simpan Pengumuman Baru
        Announcement::create([
            'title'     => $request->title,
            'content'   => $request->content,
            'type'      => $request->type,
            'is_active' => true, // Default langsung aktif
        ]);

        // D. Redirect kembali ke Dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Pengumuman berhasil diterbitkan!');
    }

    //5. EDIT: Menampilkan form edit pengumuman
    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', compact('announcement'));
    }

    //6. UPDATE: Memperbarui data pengumuman di database
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'type'    => 'required|in:info,urgent,warning',
        ]);

        $announcement->update([
            'title'     => $request->title,
            'content'   => $request->content,
            'type'      => $request->type,
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    //4. DESTROY: Menghapus pengumuman
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->back()->with('success', 'Pengumuman dihapus');
    }
}
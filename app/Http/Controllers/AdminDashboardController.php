<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil data dosen yang terdaftar di kegiatan (baik internal maupun eksternal) beserta jabatan
        $dosen = DB::table('m_pengguna')
            ->leftJoin('t_kegiatan_user', 'm_pengguna.id_pengguna', '=', 't_kegiatan_user.id_pengguna')
            ->leftJoin('t_kegiatan_eksternal', 'm_pengguna.id_pengguna', '=', 't_kegiatan_eksternal.id_pengguna')
            ->leftJoin('t_kegiatan', 't_kegiatan_user.id_kegiatan', '=', 't_kegiatan.id_kegiatan')
            ->leftJoin('m_jabatan_kegiatan', 't_kegiatan_user.id_jabatan_kegiatan', '=', 'm_jabatan_kegiatan.id_jabatan_kegiatan')
            ->select(
                'm_pengguna.id_pengguna', 
                'm_pengguna.nama_pengguna', 
                't_kegiatan.nama_kegiatan', 
                'm_jabatan_kegiatan.nama_jabatan_kegiatan'
            )
            ->whereNotNull('t_kegiatan_user.id_kegiatan') // Hanya dosen yang terdaftar di kegiatan internal
            ->orWhereNotNull('t_kegiatan_eksternal.id_pengguna') // Atau dosen yang terdaftar di kegiatan eksternal
            ->groupBy(
                'm_pengguna.id_pengguna', 
                'm_pengguna.nama_pengguna', 
                't_kegiatan.nama_kegiatan', 
                'm_jabatan_kegiatan.nama_jabatan_kegiatan'
            )
            ->get();

        // Mengelompokkan data berdasarkan dosen
        $groupedDosen = $dosen->groupBy('id_pengguna');

        return view('admin.index', compact('groupedDosen'));
    }

    public function listKegiatan($idPengguna)
    {
        // Ambil daftar kegiatan dari internal dan eksternal beserta jabatan
        $kegiatanInternal = DB::table('t_kegiatan_user')
            ->join('t_kegiatan', 't_kegiatan_user.id_kegiatan', '=', 't_kegiatan.id_kegiatan')
            ->leftJoin('m_jabatan_kegiatan', 't_kegiatan_user.id_jabatan_kegiatan', '=', 'm_jabatan_kegiatan.id_jabatan_kegiatan')
            ->where('t_kegiatan_user.id_pengguna', $idPengguna)
            ->select('t_kegiatan.nama_kegiatan', 't_kegiatan.tanggal_selesai', 'm_jabatan_kegiatan.nama_jabatan_kegiatan')
            ->get();

        $kegiatanEksternal = DB::table('t_kegiatan_eksternal')
            ->where('id_pengguna', $idPengguna)
            ->select('nama_kegiatan', 'waktu_kegiatan as tanggal_selesai', DB::raw('NULL as nama_jabatan_kegiatan'))
            ->get();

        $kegiatan = $kegiatanInternal->merge($kegiatanEksternal);

        return view('admin.kegiatan-list', compact('kegiatan'));
    }
}

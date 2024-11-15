<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\KegiatanModel;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
{
    // Menampilkan halaman daftar kegiatan
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Input Kegiatan',
            'list' => ['Home', 'Kegiatan']
        ];

        $page = (object) [
            'title' => 'Daftar kegiatan yang ada'
        ];

        $activeMenu = 'kegiatan';

        return view('kegiatan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan data kegiatan dalam bentuk json untuk datatables
    public function list(Request $request) {
        $kegiatan = KegiatanModel::select('id_kegiatan', 'kode_kegiatan', 'nama_kegiatan', 'tanggal_mulai', 'tanggal_selesai');

        return DataTables::of($kegiatan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kegiatan) {
                $btn = '<button onclick="modalAction(\''.route('kegiatan.show', $kegiatan->id_kegiatan).'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.route('kegiatan.edit', $kegiatan->id_kegiatan).'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.route('kegiatan.delete', $kegiatan->id_kegiatan).'\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan form tambah kegiatan via Ajax
    public function create_ajax() {
        return view('kegiatan.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) { 
            $validator = Validator::make($request->all(), [
                'kode_kegiatan' => 'required|string|min:3|unique:t_kegiatan,kode_kegiatan',
                'nama_kegiatan' => 'required|string|max:100',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }
    
            // Menyimpan data kegiatan ke database
            KegiatanModel::create($request->only('kode_kegiatan', 'nama_kegiatan', 'tanggal_mulai', 'tanggal_selesai'));
    
            return response()->json([
                'status' => true,
                'message' => 'Data kegiatan berhasil disimpan',
            ]);
        }
    
        return response()->json([
            'status' => false,
            'message' => 'Request bukan AJAX.',
        ]);
    }    

    public function show(string $id)
    {
        $kegiatan = KegiatanModel::find($id);

        if (!$kegiatan) {
            return response()->json([
                'status' => false,
                'message' => 'Kegiatan tidak ditemukan.'
            ]);
        }

        return view('kegiatan.show', ['kegiatan' => $kegiatan]);
    }

    // Menampilkan form edit kegiatan via Ajax
    public function edit_ajax($id) {
        $kegiatan = KegiatanModel::findOrFail($id);
        return view('kegiatan.edit', ['kegiatan' => $kegiatan]);
    }

    // Menyimpan perubahan data kegiatan via Ajax
    public function update_ajax(Request $request, $id) {
        if ($request->ajax() || $request->wantsJson()) {
            $validator = Validator::make($request->all(), [
                'kode_kegiatan' => 'required|string|max:20|unique:m_kegiatan,kode_kegiatan,' . $id . ',id_kegiatan',
                'nama_kegiatan' => 'required|string|max:100',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors(),
                ]);
            }

            $kegiatan = KegiatanModel::findOrFail($id);
            $kegiatan->update($request->only('kode_kegiatan', 'nama_kegiatan'));

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diupdate',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Request bukan AJAX.',
        ]);
    }

    // Menampilkan konfirmasi hapus kegiatan via Ajax
    public function confirm_ajax($id) {
        $kegiatan = KegiatanModel::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Apakah Anda yakin ingin menghapus kegiatan ini?',
            'data' => $kegiatan,
        ]);
    }

    // Menghapus data kegiatan via Ajax
    public function delete_ajax(Request $request, $id) {
        if ($request->ajax() || $request->wantsJson()) {
            $kegiatan = KegiatanModel::findOrFail($id);
            $kegiatan->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil dihapus',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Request bukan AJAX.',
        ]);
    }

    // Proses import excel kegiatan dengan AJAX
    public function import_ajax(Request $request) {
        // Implementasi import excel dengan AJAX
    }
}
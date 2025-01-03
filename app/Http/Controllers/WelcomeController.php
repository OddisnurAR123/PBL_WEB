<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        $today = Carbon::now();

        // Cek apakah tanggal_mulai ada di t_kegiatan
        $kegiatan = DB::table('t_kegiatan')
            ->whereDate('tanggal_mulai', '>=', $today)
            ->orderBy('tanggal_mulai', 'asc')
            ->first();

        // Cek apakah tanggal_agenda ada di t_agenda
        $agenda = DB::table('t_agenda')
            ->whereDate('tanggal_agenda', '>=', $today)
            ->orderBy('tanggal_agenda', 'asc')
            ->first();

        return view('dashboard', compact('kegiatan', 'agenda'));
    }
}

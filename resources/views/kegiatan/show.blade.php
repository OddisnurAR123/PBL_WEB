@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Detail Kegiatan</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($kegiatan)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID Kegiatan</th>
                        <td>{{ $kegiatan->id_kegiatan }}</td>
                    </tr>
                    <tr>
                        <th>Kode Kegiatan</th>
                        <td>{{ $kegiatan->kode_kegiatan }}</td>
                    </tr>
                    <tr>
                        <th>Nama Kegiatan</th>
                        <td>{{ $kegiatan->nama_kegiatan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('d-m-Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Selesai</th>
                        <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('d-m-Y H:i') }}</td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('kegiatan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
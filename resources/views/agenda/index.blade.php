@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/agenda/import') }}')" class="btn btn-info">Import Agenda</button>
            <a href="{{ url('/agenda/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export Excel</a>
            <a href="{{ url('/agenda/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export PDF</a>
            <button onclick="modalAction('{{ url('/agenda/create_ajax') }}')" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Agenda</button>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="jenis_pengguna_id" name="jenis_pengguna_id">
                            <option value="">- Semua -</option>
                            @foreach($jenisPengguna as $item)
                                <option value="{{ $item->id_jenis_pengguna }}">{{ $item->nama_jenis_pengguna }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Jenis Pengguna</small>
                    </div>
                </div>
            </div>
        </div>
        
        <table class="table table-bordered table-striped table-hover table-sm" id="table_agenda">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Agenda</th>
                    <th>Tempat</th>
                    <th>Jenis Pengguna</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Agenda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>

@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    var dataAgenda;

    $(document).ready(function() {
        dataAgenda = $('#table_agenda').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('agenda/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(s) {
                    s.jenis_pengguna_id = $('#jenis_pengguna_id').val();
                }
            },
            columns: [
                {
                    data: "id_agenda",
                    className: "",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "nama_agenda", 
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "tempat_agenda",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "jenis_pengguna.nama_jenis_pengguna",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "deskripsi",
                    className: "",
                    orderable: false,
                    searchable: true
                },
                {
                    data: "tanggal_agenda",
                    className: "",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "aksi", // Action buttons
                    className: "",
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#jenis_pengguna_id').on('change', function() {
            dataAgenda.ajax.reload(); // Reload data when filter changes
        });
    });
</script>

@endpush

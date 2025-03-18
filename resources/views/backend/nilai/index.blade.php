@extends('backend.app')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><b>Daftar Nilai</b></h4>
            <div>
                <a href="{{ route('nilai.create') }}" class="btn btn-success me-2">
                    <i class="fas fa-plus"></i> Tambah Nilai</a>
                <a href="{{ route('nilai.export.pdf') }}" class="btn btn-danger">
                 <i class="fas fa-file-pdf"></i> Export PDF</a>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Input Search -->
            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                <table class="table table-striped table-hover align-middle" id="nilai">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Guru</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- DataTables & Bootstrap -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        let table = $('#nilai').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('nilai') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                { data: 'student.name', name: 'student.name', searchable: true },
                { data: 'teacher.name', name: 'teacher.name', searchable: true },
                { data: 'mapel.nama', name: 'mapel.nama', searchable: true },
                { data: 'nilai', name: 'nilai', searchable: true },
                { 
                    data: 'id', 
                    name: 'id', 
                    orderable: false, 
                    searchable: false, 
                    className: 'text-center',
                    render: function(data, type, row) {
                        console.log(data);
                
                        return `<a href="/backend/nilai/${row.id}/edit" class="btn btn-warning btn-sm me-1">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger btn-sm delete-button" data-id="${row.id}">
                            <i class="fas fa-trash"></i> Hapus
                        </button>`;
                    }
                }
            ],
            language: {
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Data tidak ditemukan",
                search: "Cari:",
                paginate: {
                    next: "➡",
                    previous: "⬅"
                }
            }
        });

        // Konfirmasi Hapus dengan SweetAlert2
        $(document).on('click', '.delete-button', function() {
            let nilaiId = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('nilai.destroy', ':id') }}".replace(':id', nilaiId),
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire('Terhapus!', 'Data telah berhasil dihapus.', 'success');
                            table.ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                        }
                    });
                }
            });
        });

        // Pencarian manual dengan input text
        $('#searchBox').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>
@endsection
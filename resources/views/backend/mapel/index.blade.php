@extends('backend.app')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><b>Daftar Mata Pelajaran</b></h4>
            <a href="{{ route('mapel.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Mata Pelajaran
            </a>
        </div>

        <div class="card-body">
            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Tabel Mata Pelajaran -->
            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                <table class="table table-striped table-hover align-middle" id="mapelTable">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th style="width: 10%;">No</th>
                            <th>Nama Mata Pelajaran</th>
                            <th style="width: 30%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
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
        $('#mapelTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('mapel') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                { data: 'nama', name: 'nama' },
                { 
                    data: 'id', 
                    name: 'id', 
                    orderable: false, 
                    searchable: false, 
                    className: 'text-center',
                    render: function(data, type, row) {
                        return `
                            <a href="/backend/mapel/${data}/edit" class="btn btn-warning btn-sm me-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button type="button" class="btn btn-danger btn-sm delete-button" data-id="${data}">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        `;
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
            let mapelId = $(this).data('id');
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
                        url: "{{ route('mapel.destroy', ':id') }}".replace(':id', mapelId),
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire('Terhapus!', 'Data telah berhasil dihapus.', 'success');
                            $('#mapelTable').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection

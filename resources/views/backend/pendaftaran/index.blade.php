@extends('backend.app')

@section('content')

    <div class="container">
        <h1 class="fw-bold mb-3 text-center">Halaman Pendaftaran</h1>

        @if(session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    Swal.fire({
                        title: "Berhasil!",
                        text: @json(session('success')),
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        @endif

        <div class="card shadow-sm ms-4 me-4">
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered table-sm" id="pendaftaran" width="100%">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Nomor HP</th>
                                <th>Email</th>
                                <th>Aksi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    
@endsection
<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pendaftaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr><th>id</th><td id="detailId"></td></tr>
                            <tr><th>Nama</th><td id="detailNama"></td></tr>
                            <tr><th>NISN</th><td id="detailNISN"></td></tr>
                            <tr><th>Tempat Lahir</th><td id="detailTempatLahir"></td></tr>
                            <tr><th>Tanggal Lahir</th><td id="detailTanggalLahir"></td></tr>
                            <tr><th>Jenis Kelamin</th><td id="detailJenisKelamin"></td></tr>
                            <tr><th>Asal Sekolah</th><td id="detailAsalSekolah"></td></tr>
                            <tr><th>Nomor HP</th><td id="detailNomorHP"></td></tr>
                            <tr><th>Nama Ayah</th><td id="detailNamaAyah"></td></tr>
                            <tr><th>Nama Ibu</th><td id="detailNamaIbu"></td></tr>
                            <tr><th>Email</th><td id="detailEmail"></td></tr>
                            <tr><th>Status</th><td id="detailStatus"></td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <button class="btn btn-success" onclick="updateStatus('Diterima')">Terima</button>
                    <button class="btn btn-danger" onclick="updateStatus('Ditolak')">Tolak</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeDetailModal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            .table-responsive {
                max-height: 500px;
                overflow-y: auto;
            }

            thead {
                position: sticky;
                top: 0;
                background: #212529;
                color: white;
                z-index: 10;
            }
        </style>
       
       

        <script>
            $(document).ready(function () {
                $('#pendaftaran').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('pendaftaran') }}",
                    dom: '<"top d-flex justify-content-between mb-3"lf>rt<"bottom"ip><"clear">',
                    columns: [
                        {
                            data: null,
                            name: 'id',
                            render: function (data, type, row, meta) {
                                return meta.row + 1; 
                            }
                        },
                        { data: 'nama', name: 'nama' },
                        { data: 'nisn', name: 'nisn' },
                        { data: 'tanggal_lahir', name: 'tanggal_lahir' },
                        { data: 'jenis_kelamin', name: 'jenis_kelamin' },
                        { data: 'nomor_hp', name: 'nomor_hp' },
                        { data: 'email', name: 'email' },
                        { 
                            data: 'id', 
                            name: 'id', 
                            orderable: false, 
                            searchable: false,
                            render: function (data, type, row) {
                                return `
                                <button class="btn btn-info btn-sm" onclick="showDetail(${data})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="/pendaftaran/${data}/edit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/pendaftaran/${data}" method="POST" style="display:inline;" onsubmit="return confirmDelete(event);">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                `;
                            }
                        },
                        { 
                            data: 'status', 
                            name: 'status', 
                            render: function (data) {
                                return data === "Diterima" 
                                    ? '<span class="badge bg-success">Diterima</span>' 
                                    : '<span class="badge bg-danger">Tidak Diterima</span>';
                            }
                        }
                    ]
                });
               

                // Fungsi untuk menampilkan detail
                window.showDetail = function(id) {
                    $.ajax({
                        url: `/pendaftaran/${id}`,
                        type: "GET",
                        success: function (data) {
                            $("#detailId").text(data.id);
                            $("#detailNama").text(data.nama);
                            $("#detailNISN").text(data.nisn);
                            $("#detailTempatLahir").text(data.tempat_lahir);
                            $("#detailTanggalLahir").text(data.tanggal_lahir);
                            $("#detailJenisKelamin").text(data.jenis_kelamin);
                            $("#detailAsalSekolah").text(data.asal_sekolah);
                            $("#detailNomorHP").text(data.nomor_hp);
                            $("#detailNamaAyah").text(data.nama_ayah);
                            $("#detailNamaIbu").text(data.nama_ibu);
                            $("#detailEmail").text(data.email);
                            $("#detailStatus").html(data.status === "Diterima" 
                                ? '<span class="badge bg-success">Diterima</span>' 
                                : '<span class="badge bg-danger">Tidak Diterima</span>'
                            );

                            $("#detailModal").modal("show");
                        }
                    });
                };

                // Fungsi untuk menutup modal saat tombol "Close" ditekan
                $("#closeDetailModal").on("click", function () {
                    $("#detailModal").modal("hide");
                });
            });
            function updateStatus(status) {
            var id = document.getElementById("detailId").textContent; // Ambil ID dari tabel
         
            $.ajax({
                url: `/pendaftaran/${id}/update-status`,
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    status: status
                },
                success: function () {
                    Swal.fire("Sukses!", "Status berhasil diperbarui", "success").then(() => {
                        $('#pendaftaran').DataTable().ajax.reload();
                        $('#detailModal').modal('hide');
                    });
                }
            });
        }

            function confirmDelete(event) {
                event.preventDefault();
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data pendaftaran akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.submit();
                    }
                });
            }
        </script>
    @endsection
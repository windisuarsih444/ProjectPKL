@extends('backend.app')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><b>Kelola Mata Pelajaran</b></h4>
            <a href="{{ route('mapel') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            <form id="mapelForm" method="POST" action="{{ isset($mapel) ? route('mapel.update', $mapel->id) : route('mapel.store') }}">
                @csrf
                @if(isset($mapel))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Mata Pelajaran</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ isset($mapel) ? $mapel->nama : old('nama') }}" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#mapelForm').submit(function(event) {
            event.preventDefault();
            let form = $(this);
            let formData = form.serialize();
            let actionUrl = form.attr('action');

            $.ajax({
                url: actionUrl,
                type: form.attr('method'),
                data: formData,
                success: function(response) {
                    Swal.fire('Berhasil!', 'Data Mata Pelajaran telah disimpan.', 'success')
                        .then(() => {
                            window.location.href = "{{ route('mapel') }}";
                        });
                },
                error: function() {
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan data.', 'error');
                }
            });
        });
    });
</script>
@endsection

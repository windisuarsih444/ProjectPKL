@extends('backend.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-black text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Mata Pelajaran</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('mapel.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Mata Pelajaran</label>
                                <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required autofocus>
                                @if ($errors->has('nama'))
                                    <div class="invalid-feedback">{{ $errors->first('nama') }}</div>
                                @endif
                            </div>
                    
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-warning">SAVE</button>
                                <a href="{{ route('mapel') }}" class="btn btn-danger">CLOSE</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

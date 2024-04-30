@extends('layout.main')

@section('fill')
    <div class="card mx-auto" style="max-width: 50rem">
        <div class="card-body">
            <form action="/tambah_post" method="POST">
                @csrf

                <h6 class="my-3">Judul Pesan</h6>
                <div class="align-self-start form-floating ps-1">
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" placeholder="Judul Pesan"
                        name="judul" autofocus required>
                    @error('judul')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <label class="ps-4" for="judul">Judul Pesan</label>
                </div>

                <h6 class="my-3">Isi Post</h6>
                <div class="align-self-start ps-1">
                    <textarea class="form-control @error('isi_post') is-invalid @enderror" id="isi_post"
                        name="isi_post" style="min-height: 7rem" autofocus required></textarea>
                    @error('isi_post')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-center align-self-center mt-3">
                    <a href="/" class="btn btn-primary me-3">Batal</a>

                    <button type="submit" class="btn btn-primary ms-3">Tambah</button>
                </div>
            </form>
        </div>
    </div>
@endsection
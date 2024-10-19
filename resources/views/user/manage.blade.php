@extends('layout.main')

@section('content')
        <div class="container-fluid">
              <h2>Edit Mahasiswa</h2>

              @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
              @endif
              @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
              @endif

              <div class="card">
                  <div class="card-body">
                      <form method="POST" action="{{ route('updateuser', $mahasiswa->id) }}">
                          @csrf
                          @method('PUT') <!-- Menggunakan PUT method untuk update -->

                          <div class="mb-3">
                              <label for="name" class="form-label">Nama</label>
                              <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $mahasiswa->name) }}" required>
                              @error('name')
                                  <div class="text-danger">{{ $message }}</div>
                              @enderror
                          </div>

                          <div class="mb-3">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $mahasiswa->email) }}" required>
                              @error('email')
                                  <div class="text-danger">{{ $message }}</div>
                              @enderror
                          </div>

                          <div class="mb-3">
                              <label for="prodi" class="form-label">Program Studi</label>
                              <input type="text" class="form-control" name="prodi" id="prodi" value="{{ old('prodi', $mahasiswa->prodi) }}" required>
                              @error('prodi')
                                  <div class="text-danger">{{ $message }}</div>
                              @enderror
                          </div>

                          <div class="mb-3">
                              <label for="kelas" class="form-label">Kelas</label>
                              <input type="text" class="form-control" name="kelas" id="kelas" value="{{ old('kelas', $mahasiswa->kelas) }}" required>
                              @error('kelas')
                                  <div class="text-danger">{{ $message }}</div>
                              @enderror
                          </div>

                          <div class="mb-3">
                              <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                              <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                  <option value="Laki-laki" {{ $mahasiswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                  <option value="Perempuan" {{ $mahasiswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                              </select>
                              @error('jenis_kelamin')
                                  <div class="text-danger">{{ $message }}</div>
                              @enderror
                          </div>

                          <button type="submit" class="btn btn-primary">Update</button>
                          <a href="/userpages" class="btn btn-secondary">Batal</a>
                      </form>
                  </div>
              </div>
          </div>
@endsection
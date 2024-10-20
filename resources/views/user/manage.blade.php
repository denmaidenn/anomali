@extends('layout.main')
@section('content')
        <div class="content-wrapper">
          <h3 class="page-heading mb-4">Forms</h3>
          <div class="row mb-2">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">Edit User Data</h5>
                  <form class="forms-sample" method="POST" action="{{ route('updateuser', $mahasiswa->id) }}">
                    @csrf
                    @method('PUT') <!-- Menggunakan PUT untuk update data -->

                    <div class="form-group">
                      <label for="exampleInputName1">Nama</label>
                      <input name="name" type="text" class="form-control p-input" id="exampleInputName1" placeholder="Nama" value="{{ old('name', $mahasiswa->name) }}" required>
                      @error('name')
                        <div class="text-danger"> {{ $message }}></div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input name="email" type="email" class="form-control p-input" id="exampleInputEmail1" placeholder="Enter email" value="{{ old('email', $mahasiswa->email) }}" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputProdi1">Prodi</label>
                      <input name="prodi" type="text" class="form-control p-input" id="exampleInputProdi1" placeholder="Prodi" value="{{ old('prodi', $mahasiswa->prodi) }}" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputKelas1">Kelas</label>
                      <input name="kelas" type="text" class="form-control p-input" id="exampleInputKelas1" placeholder="Kelas" value="{{ old('kelas', $mahasiswa->kelas) }}" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputJk1">Jenis Kelamin</label>
                      <div class="form-radio">
                        <label>
                          <input name="jenis_kelamin" value="Laki-laki" type="radio" {{ $mahasiswa->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }} required>
                          Laki-laki
                        </label>
                      </div>
                      <div class="form-radio">
                        <label>
                          <input name="jenis_kelamin" value="Perempuan" type="radio" {{ $mahasiswa->jenis_kelamin == 'Perempuan' ? 'checked' : '' }} required>
                          Perempuan
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Update</button>
                      <a href="/userpages" class="btn btn-secondary">Batal</a>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection

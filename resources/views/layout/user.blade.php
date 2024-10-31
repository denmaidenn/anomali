<div class="row mb-2">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between m-2">
                    <h5 class="card-title mb-4">User Data Table</h5>
                    <a href="{{ route('user.create') }}" class="btn btn-primary ">Tambah</a>
                  </div>
                  <div class="table-responsive">

                    @if (session('success'))
                      <div class="alert alert-success">
                        {{ session('success') }}
                      </div>
                    @endif
                    @if (session('error'))
                      <div class="alert alert-danger">
                      {{ session('error') }}
                      </div>
                    @endif
                    <table class="table center-aligned-table">
                      <thead>
                        <tr class="text-primary">
                          <th> No</th>
                          <th>Nama</th>
                          <th> Email</th>
                          <th> Prodi</th>
                          <th> Kelas</th>
                          <th> Jenis Kelamin </th>
                          <th></th>
                          <th></th>

                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $mahasiswa)
                        <tr class="">
                          <td>{{ $mahasiswa->id}}</td>
                          <td>{{ $mahasiswa-> name }}</td>
                          <td>{{ $mahasiswa-> email }}</td>
                          <td>{{ $mahasiswa-> prodi }}</td>
                          <td>{{ $mahasiswa-> kelas }}</td>
                          <td>{{ $mahasiswa-> jenis_kelamin }}</td>
                          <div>
                            <td>
                              <a href="{{ route('user.edit', $mahasiswa -> id) }}"  class="btn btn-primary btn-sm">Manage</a>
                            </td>
                            <td>

                              <form action="{{ route('user.delete', $mahasiswa -> id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');" >
                                @csrf
                                @method('DELETE')

                                  <button  type="submit" class="btn btn-danger btn-sm">Remove</button>


                              </form>
                            </td>
                          </div>

                        </tr>


                      @endforeach


                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
<div class="row mb-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between m-2">
                    <h5 class="card-title mb-4">User Data Table</h5>
                    <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah</a>
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
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $formUser)
                                <tr>
                                    <td>{{ $formUser->id }}</td>
                                    <td>{{ $formUser->name }}</td>
                                    <td>{{ $formUser->email }}</td>
                                    <td>{{ $formUser->username }}</td>
                                    <td>{{ $formUser->password }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', $formUser->id) }}" class="btn btn-primary btn-sm">Manage</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('user.delete', $formUser->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "http://127.0.0.1/api/formuser", // Ganti dengan URL API Anda
            method: "GET",
            success: function(data) {
                console.log(data); // Menampilkan data yang diterima dari API
                // Proses data yang diterima
                var userData = data;
                var tableBody = $('#user-table tbody');
                userData.forEach(function(user, index) {
                    tableBody.append(
                        '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + user.name + '</td>' +
                            '<td>' + user.email + '</td>' +
                            '<td>' + user.username + '</td>' +
                            '<td><a href="/user/edit/' + user.id + '" class="btn btn-primary btn-sm">Manage</a></td>' +
                            '<td><button class="btn btn-danger btn-sm" onclick="deleteUser(' + user.id + ')">Remove</button></td>' +
                        '</tr>'
                    );
                });
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error); // Menangani error jika ada
            }
        });
    });
</script> -->
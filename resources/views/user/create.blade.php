@extends('layout.main')

@section('content')
<div class="content-wrapper">
    <h3 class="page-heading mb-4" style="font-weight: Bold">Form</h3>
    <div class="row mb-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Form User Data</h5>
                    <form class="forms-sample" method="POST" action="{{ route('user.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputName1">Nama</label>
                            <input name="name" type="text" class="form-control p-input" id="exampleInputName1" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email" type="email" class="form-control p-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputNoTelp">No Telepon</label>
                            <input name="no_telp" type="text" class="form-control p-input" id="exampleInputNoTelp" placeholder="No Telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername">Username</label>
                            <input name="username" type="text" class="form-control p-input" id="exampleInputUsername" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword">Password</label>
                            <input name="password" type="password" class="form-control p-input" id="exampleInputPassword" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

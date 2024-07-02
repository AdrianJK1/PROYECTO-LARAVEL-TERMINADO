
@extends('layouts.app')

@section('content')
    <h1>Login Estudiantes</h1>
    <form action="{{ route('estudiantes.login') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="pin" class="form-label">PIN</label>
                <input type="password" class="form-control" id="pin" name="pin"
                       pattern="\d{4,6}" maxlength="6" minlength="4" inputmode="numeric" required>
                <div class="invalid-feedback">
                    El PIN debe contener solo números y tener entre 4 y 6 dígitos.
                </div>
            </div>
        </div>
        <div style="margin-top: 10px" class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
        <div style="margin-top: 10px" class="row">
            @error('InvalidCredentials')
            <div class="alert alert-success fade show" id="success-message" data-bs-dismiss="alert" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </form>
@endsection

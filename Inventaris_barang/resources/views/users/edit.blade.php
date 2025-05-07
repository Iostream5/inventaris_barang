@extends('layout.app')

@section('content')
    <div class="container">
        <h3>{{ isset($user) ? 'Edit User' : 'Tambah User' }}</h3>
        <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
            @csrf
            @if (isset($user))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}">
            </div>
            <div class="mb-3">
                <label>Password {{ isset($user) ? '(kosongkan jika tidak diubah)' : '' }}</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <button class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection

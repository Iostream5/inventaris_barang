@extends('layout.app')

@section('content')
    <div class="container">
        <h3>{{ isset($category) ? 'Edit' : 'Tambah' }} Kategori</h3>
        <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
            method="POST">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label>Nama Kategori</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}">
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control">{{ old('description', $category->description ?? '') }}</textarea>
            </div>
            <button class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection

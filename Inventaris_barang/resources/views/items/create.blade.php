@extends('layout.app')

@section('content')
    <div class="container">
        <h3>{{ isset($item) ? 'Edit' : 'Tambah' }} Barang</h3>
        <form action="{{ isset($item) ? route('items.update', $item->id) : route('items.store') }}" method="POST">
            @csrf
            @if (isset($item))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $item->name ?? '') }}">
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select name="category_id" class="form-select">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $item->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $item->stock ?? 0) }}">
            </div>
            <div class="mb-3">
                <label>Satuan</label>
                <input type="text" name="unit" class="form-control" value="{{ old('unit', $item->unit ?? '') }}">
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control">{{ old('description', $item->description ?? '') }}</textarea>
            </div>
            <button class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection

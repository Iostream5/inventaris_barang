@extends('layout.app')

@section('content')
    <div class="container my-3">
        <h3>Daftar Barang</h3>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#itemModal">
            {{ isset($item) ? 'Edit' : 'Tambah' }} Barang
        </button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#itemModal" data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                data-category="{{ $item->category->id }}" data-stock="{{ $item->stock }}"
                                data-unit="{{ $item->unit }}">
                                Edit
                            </button>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus barang ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    @include('items.create')
@endsection

<!-- resources/views/transactions/index.blade.php -->
@extends('layout.app')

@section('content')
    <h1>Barang-Keluar</h1>
    <a href="{{ route('operasi.create') }}" class="btn btn-primary">Create Transaction</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Item</th>
                <th>User</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->item->name }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ $transaction->type }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->notes }}</td>
                    <td>
                        <a href="{{ route('operasi.edit', $transaction) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('operasi.destroy', $transaction) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

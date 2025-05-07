<!-- resources/views/transactions/index.blade.php -->
@extends('layout.app')

@section('content')
    <div class="container my-3">
        <h3>Barang-Keluar</h3>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#transactionModal">
            Tambah Transaksi
        </button>
        <table class="table table-bordered mt-3">
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
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#transactionModal" data-id="{{ $transaction->id }}"
                                data-item="{{ $transaction->item->id }}" data-user="{{ $transaction->user->id }}"
                                data-type="{{ $transaction->type }}" data-quantity="{{ $transaction->quantity }}"
                                data-notes="{{ $transaction->notes }}">
                                Edit
                            </button>
                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    @include('transaction.create')
@endsection

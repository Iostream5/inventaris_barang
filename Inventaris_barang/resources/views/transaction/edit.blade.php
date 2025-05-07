<!-- resources/views/transactions/edit.blade.php -->
@extends('layout.app')

@section('content')
    <h1>Data keluar</h1>
    <form action="{{ route('transactions.update', $transaction) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="item_id" class="form-label">Item</label>
            <select name="item_id" id="item_id" class="form-control">
                @foreach ($items as $item)
                    <option value="{{ $item->id }}" @selected($item->id == $transaction->item_id)>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @selected($user->id == $transaction->user_id)>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Transaction Type</label>
            <select name="type" id="type" class="form-control">
                <option value="in" @selected('in' == $transaction->type)>In</option>
                <option value="out" @selected('out' == $transaction->type)>Out</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $transaction->quantity }}"
                required>
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" id="notes" class="form-control">{{ $transaction->notes }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Transaction</button>
    </form>
@endsection

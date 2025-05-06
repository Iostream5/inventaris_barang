<?php

// app/Http/Controllers/TransactionController.php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Menampilkan semua transaksi
    public function index()
    {
        $transactions = Transaction::with(['item', 'user'])->get();
        return view('operasi.index', compact('transactions'));
    }

    // Menampilkan form untuk membuat transaksi baru
    public function create()
    {
        $items = Item::all();
        $users = User::all();
        return view('operasi.create', compact('items', 'users'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer',
            'notes' => 'nullable|string',
        ]);

        Transaction::create($validated);

        return redirect()->route('operasi.index')->with('success', 'Transaction created successfully');
    }

    // Menampilkan form untuk mengedit transaksi
    public function edit(Transaction $transaction)
    {
        $items = Item::all();
        $users = User::all();
        return view('operasi.edit', compact('transaction', 'items', 'users'));
    }

    // Mengupdate transaksi
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer',
            'notes' => 'nullable|string',
        ]);

        $transaction->update($validated);

        return redirect()->route('operasi.index')->with('success', 'Transaction updated successfully');
    }

    // Menghapus transaksi
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('operasi.index')->with('success', 'Transaction deleted successfully');
    }
}

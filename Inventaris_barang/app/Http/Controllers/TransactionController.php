<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['item', 'user'])->get();
        return view('transaction.index',[
            'title'=>'Transaksi-Barang',
            'transactions'=>$transactions
        ]);
    }

    public function create()
    {
        $items = Item::all();
        $users = User::all();
        return view('transaction.create', compact('items', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {
            $item = Item::findOrFail($validated['item_id']);

            if ($validated['type'] === 'out') {
                if ($item->stock < $validated['quantity']) {
                    abort(400, 'Stok tidak mencukupi!');
                }
                $item->stock -= $validated['quantity'];
            } else {
                $item->stock += $validated['quantity'];
            }

            $item->save();
            Transaction::create($validated);
        });

        return redirect()->route('dashboard');
    }

    public function edit(Transaction $transaction)
    {
        $items = Item::all();
        $users = User::all();
        return view('transaction.edit', compact('transaction', 'items', 'users'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($transaction, $validated) {
            $item = Item::findOrFail($transaction->item_id);

            // Kembalikan stok lama
            if ($transaction->type === 'out') {
                $item->stock += $transaction->quantity;
            } else {
                $item->stock -= $transaction->quantity;
            }

            // Update stok berdasarkan data baru
            if ($validated['type'] === 'out') {
                if ($item->stock < $validated['quantity']) {
                    abort(400, 'Stok tidak mencukupi!');
                }
                $item->stock -= $validated['quantity'];
            } else {
                $item->stock += $validated['quantity'];
            }

            $item->save();
            $transaction->update($validated);
        });

        return redirect()->route('dashboard')->with('success', 'Transaction updated successfully');
    }

    public function destroy(Transaction $transaction)
    {
        DB::transaction(function () use ($transaction) {
            $item = Item::findOrFail($transaction->item_id);

            // Kembalikan stok
            if ($transaction->type === 'out') {
                $item->stock += $transaction->quantity;
            } else {
                $item->stock -= $transaction->quantity;
            }

            $item->save();
            $transaction->delete();
        });

        return redirect()->route('dashboard')->with('success', 'Transaction deleted successfully');
    }
}

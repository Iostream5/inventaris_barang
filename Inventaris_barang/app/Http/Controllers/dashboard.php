<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;

class dashboard extends Controller
{
    public function index(){
        $categories = category::all();
        $transactions = Transaction::with(['item', 'user'])->get();
        $items = Item::with('category')->latest()->get();
        return view('welcome', ['categories' => $categories, 'items' => $items, 'transactions' => $transactions]);
    }
}

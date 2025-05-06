<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->latest()->get();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'unit' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        Item::create($request->all());
        return redirect()->route('items.index')->with('success', 'Barang ditambahkan!');
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'unit' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $item->update($request->all());
        return redirect()->route('items.index')->with('success', 'Barang diperbarui!');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang dihapus!');
    }
}

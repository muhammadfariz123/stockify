<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
class ProductAttributeController extends Controller
{
    public function index()
    {
        $attributes = ProductAttribute::latest()->paginate(10);
        return view('admin.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('admin.attributes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        ProductAttribute::create($request->only('name', 'value'));

        return redirect()->route('admin.attributes.index')
            ->with('success', 'Atribut berhasil ditambahkan.');
    }

    public function edit(ProductAttribute $attribute)
    {
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(Request $request, ProductAttribute $attribute)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        $attribute->update($request->only('name', 'value'));

        return redirect()->route('admin.attributes.index')
            ->with('success', 'Atribut berhasil diperbarui.');
    }

    public function destroy(ProductAttribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('admin.attributes.index')
            ->with('success', 'Atribut berhasil dihapus.');
    }
}
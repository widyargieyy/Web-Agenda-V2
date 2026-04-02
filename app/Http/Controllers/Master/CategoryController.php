<?php

namespace App\Http\Controllers\Master;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {
        $dataKategori = Category::latest()->get();
        return view('master.categories.index', [
            'dataKategori' => $dataKategori,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:500',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        Alert::success('Berhasil', 'Kategori berhasil ditambahkan!');
        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:500',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        Alert::success('Berhasil', 'Kategori berhasil diperbarui!');
        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            Alert::success('Berhasil', 'Kategori berhasil dihapus!');
            return back()->with('success', 'Kategori berhasil dihapus!');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                Alert::error('Gagal', 'Kategori tidak dapat dihapus karena masih berkaitan dengan data lain!');
                return back()->with('error', 'Kategori tidak dapat dihapus karena masih berkaitan dengan data lain!');
            }
            Alert::error('Gagal', 'Kategori gagal dihapus!');
            return back()->with('error', 'Kategori gagal dihapus!');
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight;

class WeightController extends Controller
{
    public function index()
    {
        $weights = Weight::all();
        return view('admin.weights.index', compact('weights'));
    }

    public function create()
    {
        return view('admin.weights.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:weights,name',
            'value' => 'required|numeric|min:0',
        ]);

        Weight::create([
            'name' => $request->name,
            'value' => $request->value,
        ]);

        return redirect()->route('weights.index')->with('success', 'Cân nặng đã được thêm thành công!');
    }

    public function edit(Weight $weight)
    {
        return view('admin.weights.edit', compact('weight'));
    }

    public function update(Request $request, Weight $weight)
    {
        $request->validate([
            'value' => 'required|numeric',
        ]);
    
        $weight->update(['value' => $request->value]);
    
        return redirect()->route('weights.index')->with('success', 'Cân nặng đã được cập nhật!');
    }
    

    public function destroy(Weight $weight)
    {
        $weight->delete();
        return redirect()->route('weights.index')->with('success', 'Cân nặng đã bị xóa!');
    }
}

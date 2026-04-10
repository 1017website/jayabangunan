<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
        $stats = Stat::orderBy('order')->get();
        return view('admin.stats.index', compact('stats'));
    }

    public function create()
    {
        return view('admin.stats.form', ['stat' => new Stat()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon'      => 'required|string|max:10',
            'value'     => 'required|string|max:20',
            'suffix'    => 'required|string|max:10',
            'label'     => 'required|string|max:100',
            'order'     => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        Stat::create($data);
        return redirect()->route('admin.stats.index')->with('success', 'Statistik berhasil ditambahkan.');
    }

    public function edit(Stat $stat)
    {
        return view('admin.stats.form', compact('stat'));
    }

    public function update(Request $request, Stat $stat)
    {
        $data = $request->validate([
            'icon'      => 'required|string|max:10',
            'value'     => 'required|string|max:20',
            'suffix'    => 'required|string|max:10',
            'label'     => 'required|string|max:100',
            'order'     => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $stat->update($data);
        return redirect()->route('admin.stats.index')->with('success', 'Statistik berhasil diperbarui.');
    }

    public function destroy(Stat $stat)
    {
        $stat->delete();
        return redirect()->route('admin.stats.index')->with('success', 'Statistik berhasil dihapus.');
    }
}

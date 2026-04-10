<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.form', ['service' => new Service()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon'        => 'required|string|max:10',
            'title'       => 'required|string|max:100',
            'description' => 'required|string',
            'order'       => 'required|integer|min:0',
            'is_active'   => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'icon'        => 'required|string|max:10',
            'title'       => 'required|string|max:100',
            'description' => 'required|string',
            'order'       => 'required|integer|min:0',
            'is_active'   => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}

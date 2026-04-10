<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = ['Komersial', 'Sipil', 'Residensial', 'Industri', 'Infrastruktur'];
        return view('admin.projects.form', ['project' => new Project(), 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:200',
            'category'    => 'required|string|max:50',
            'location'    => 'required|string|max:100',
            'year'        => 'required|integer|min:2000|max:2099',
            'description' => 'nullable|string',
            'order'       => 'required|integer|min:0',
            'is_featured' => 'boolean',
            'is_active'   => 'boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'image_url'   => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->input('image_url');
        }

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active');
        unset($data['image_url']);

        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        $categories = ['Komersial', 'Sipil', 'Residensial', 'Industri', 'Infrastruktur'];
        return view('admin.projects.form', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:200',
            'category'    => 'required|string|max:50',
            'location'    => 'required|string|max:100',
            'year'        => 'required|integer|min:2000|max:2099',
            'description' => 'nullable|string',
            'order'       => 'required|integer|min:0',
            'is_featured' => 'boolean',
            'is_active'   => 'boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'image_url'   => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image && !str_starts_with($project->image, 'http')) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->input('image_url');
        }

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active');
        unset($data['image_url']);

        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        if ($project->image && !str_starts_with($project->image, 'http')) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // Public services list
    public function index()
    {
        $services = Service::where('is_active', true)->get();
        return view('services.index', compact('services'));
    }

    // Public service detail
    public function show($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('services.show', compact('service'));
    }

    // Admin - list of all services
    public function adminIndex()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    // Admin - show create form
    public function create()
    {
        return view('admin.services.create');
    }

    // Admin - store new service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:services,name',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            //'icon' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            //'image' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'duration' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        /* $iconPath = $request->file('icon')->store('services/icons', 'public');
        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('services/images', 'public')
            : null; */

        Service::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'],
            'price' => $validated['price'],
            //'icon' => $iconPath,
            //'image' => $imagePath,
            'duration' => $validated['duration'],
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service added successfully!');
    }

    // Admin - edit form
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    // Admin - update service
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:services,name,' . $service->id,
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            //'icon' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            //'image' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'duration' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        // Replace icon if new uploaded
        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($service->icon);
            $validated['icon'] = $request->file('icon')->store('services/icons', 'public');
        }

        // Replace image if new uploaded
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($service->image);
            $validated['image'] = $request->file('image')->store('services/images', 'public');
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->input('is_active', 0);


        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully!');
    }

    // Admin - delete service
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if ($service->icon) {
            Storage::disk('public')->delete($service->icon);
        }
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
 

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = auth()->user()->isAdmin() 
            ? Upload::with(['user', 'appointment'])
            : auth()->user()->uploads()->with('appointment');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('original_filename', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->has('type')) {
            $type = $request->type;
            $query->where('mime_type', 'like', "%{$type}%");
        }

        if ($request->has('appointment_id')) {
            $query->where('appointment_id', $request->appointment_id);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $uploads = $query->latest()->paginate(10);
        
        $appointments = auth()->user()->isAdmin()
            ? \App\Models\Appointment::with('service')->get()
            : auth()->user()->appointments()->with('service')->get();
        
        return view('uploads.index', compact('uploads', 'appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $appointments = auth()->user()->isAdmin()
            ? Appointment::all()
            : auth()->user()->appointments;
            
        return view('uploads.create', compact('appointments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:10240', 
            'appointment_id' => 'nullable|exists:appointments,id',
            'description' => 'nullable|string',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename);

        $upload = new Upload([
            'filename' => $filename,
            'original_filename' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'path' => $path,
            'description' => $validated['description'] ?? '',
        ]);

        if ($request->has('appointment_id')) {
            $upload->appointment_id = $validated['appointment_id'];
        }

        $upload->user_id = auth()->id();
        $upload->save();

        return redirect()->route('uploads.index')->with('success', 'File uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Upload $upload)
    {
        $this->authorize('view', $upload);
        return view('uploads.show', compact('upload'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upload $upload)
    {
        $this->authorize('update', $upload);
        $appointments = auth()->user()->isAdmin()
            ? Appointment::all()
            : auth()->user()->appointments;
            
        return view('uploads.edit', compact('upload', 'appointments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upload $upload)
    {
        $this->authorize('update', $upload);

        $request->validate([
            'appointment_id' => 'nullable|exists:appointments,id',
            'description' => 'nullable|string|max:1000',
        ]);

        $upload->update([
            'appointment_id' => $request->appointment_id,
            'description' => $request->description,
        ]);

        return redirect()->route('uploads.index')
            ->with('success', 'Upload updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upload $upload)
    {
        if (!auth()->user()->can('delete', $upload)) {
            abort(403);
        }

        $upload->delete();

        return redirect()->route('uploads.index')->with('success', 'File deleted successfully.');
    }

    /**
     * Download the specified resource.
     */
    public function download(Upload $upload)
    {
        $this->authorize('view', $upload);

        return Storage::disk('public')->download(
            $upload->path,
            $upload->original_filename
        );
    }
}

<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index() {
        $documents = Auth::user()->documents()->latest()->get();
        return view('student.documents.index', compact('documents'));
        
    }

    public function create() {
        return view('student.documents.create');
    }

    public function store(Request $request)
        {
            $request->validate([
                'document_name' => 'required|string|max:255',
                'files.*' => 'required|file|max:10240', // हर file की max 10MB limit
                'phone' => 'required|string|max:15',
                'gender' => 'required|string|max:10',
            ]);

            if($request->hasFile('files')) {
                foreach($request->file('files') as $file) {
                    $path = $file->store('documents', 'public');

                    Document::create([
                        'user_id' => auth()->id(),
                        'name' => $request->name,   
                        'email' => $request->email,   
                        'document_name' => $request->document_name,
                        'file_path' => $path,
                        'phone' => $request->phone,
                        'gender' => $request->gender,
                    ]);

                }
            }

            return redirect()->route('student.documents.index')
                             ->with('success', 'Documents uploaded successfully!');
        }


    public function show(Document $document) {
        return view('student.documents.show', compact('document'));
    }

   public function edit($id)
    {
        $document = Document::where('user_id', auth()->id())->findOrFail($id);
        return view('student.documents.edit', compact('document'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'document_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'gender' => 'required|string',
            'file' => 'nullable|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048'
        ]);

        $document = Document::where('user_id', auth()->id())->findOrFail($id);

        
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('documents', 'public');
            $document->file_path = $path;
        }

        $document->document_name = $request->document_name;
        $document->phone = $request->phone;
        $document->gender = $request->gender;
        $document->save();

        return redirect()->route('student.documents.index')->with('success', 'Document updated successfully!');
    }
    public function destroy(Document $document) {
        Storage::disk('public')->delete($document->file_path);
        $document->delete();
        return redirect()->route('student.documents.index')->with('success','Document deleted successfully');
    }
}

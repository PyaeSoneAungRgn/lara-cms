<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Contact/Index', [
            'contacts' => Contact::search($request->input('search'))
                ->orderByDesc('updated_at')
                ->paginate(10)
                ->appends([
                    'search' => $request->input('search')
                ]),
            'search' => $request->input('search')
        ]);
    }

    public function create()
    {
        return Inertia::render('Contact/Create');
    }

    
    public function store(ContactRequest $request)
    {
        $contact = Contact::create($request->all());
        $this->storeImage($request, $contact);
        return redirect()->route('contacts');
    }

    
    public function edit($id)
    {
        return Inertia::render('Contact/Edit', [
            'contact' => Contact::findOrFail($id)
        ]);
    }

    
    public function update(ContactRequest $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update($request->all());
        $this->storeImage($request, $contact);
        return redirect()->route('contacts');
    }

    public function destroyPhoto($id)
    {
        $contact = Contact::findOrFail($id);
        $this->deleteImage($contact->photo);
        $contact->update([
            'photo' => null
        ]);
        return redirect()->back();
    }

    protected function storeImage(ContactRequest $request, Contact $contact)
    {
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('contact/' . $contact->id);
            $this->deleteImage($contact->photo); // delete old img
            $contact->update([
                'photo' => $path
            ]);
        }
    }

    protected function deleteImage($path)
    {
        if ($path) {
            Storage::delete($path);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactProfessionalController extends Controller
{
    public function index()
    {
        $queryBuilder = Contact::query()->orderBy('created_at' , 'desc' );
        return view('mails', ['contacts' => $queryBuilder->paginate(10)]);
    }

    public function detail($id)
    {
        $contact = Contact::find($id);
        
        if(! isset($contact->id) ) {

            return redirect('/contacts?error=blog-not-found');
        }

        return view('contact.show', ['contact' => $contact]);
    }

    public function create($professionalId)
    {
        return view('contact.create', ['professionalId' => $professionalId]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|min:3|max:255',
            'last_name' => 'required|min:3',
            'email' => 'required|email|min:3',
            'subject' => 'required|min:3',
            'message' => 'required|min:3',
            'professional_id' => 'required|exists:professionals,id',
        ]);

        $user_id = Auth::id();
        $professional_id = $request->input('professional_id');

    Contact::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'user_id' => $user_id,
            'professional_id' => $request->input('professional_id'),
        ]);

        return redirect('/professionals?success=contact-created');
    }

    public function sendReply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|min:3',
            'subject' => 'required|min:3',
        ]);

        $contact = Contact::find($id);

        $contact->message = $request->input('reply');
        $contact->save();

        return redirect('/contacts?success=reply-sent');
    }
}

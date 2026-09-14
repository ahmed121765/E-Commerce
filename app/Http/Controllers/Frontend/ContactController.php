<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.Contact.contact');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|min:3|max:255',
                'phone' => 'required|string|min:10|max:20',
                'email' => 'required|email|max:255',
                'comment' => 'required|string|min:10|max:1000',
            ],
            [
                'name.required' => 'الاسم مطلوب.',
                'name.min' => 'الاسم يجب أن يكون 3 أحرف على الأقل.',
                'name.max' => 'الاسم لا يمكن أن يتجاوز 255 حرفًا.',

                'phone.required' => 'رقم الهاتف مطلوب.',
                'phone.min' => 'رقم الهاتف يجب أن يكون 10 أرقام على الأقل.',
                'phone.max' => 'رقم الهاتف لا يمكن أن يتجاوز 20 رقمًا.',

                'email.required' => 'البريد الإلكتروني مطلوب.',
                'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',

                'comment.required' => 'الرسالة مطلوبة.',
                'comment.min' => 'الرسالة يجب أن تكون 10 أحرف على الأقل.',
                'comment.max' => 'الرسالة لا يمكن أن تتجاوز 1000 حرف.',
            ]
        );

        $contact = new Contact;
        $contact->create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'comment' => $request->comment,
        ]);

        return redirect()
            ->route('contact.index')
            ->with('success', 'Contact created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

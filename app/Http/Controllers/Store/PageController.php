<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('store.pages.about');
    }

    public function contact()
    {
        return view('store.pages.contact');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['required', 'string', 'max:140'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Inquiry::create($data);

        return back()->with('status', 'Your note has reached the atelier. We will reply shortly.');
    }
}

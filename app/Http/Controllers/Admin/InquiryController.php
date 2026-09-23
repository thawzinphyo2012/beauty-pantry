<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function index()
    {
        return view('admin.inquiries.index', [
            'inquiries' => Inquiry::latest()->paginate(15),
        ]);
    }

    public function show(Inquiry $inquiry)
    {
        $inquiry->update(['is_read' => true]);

        return view('admin.inquiries.show', [
            'inquiry' => $inquiry,
        ]);
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')->with('status', 'Note removed.');
    }
}

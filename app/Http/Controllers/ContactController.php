<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactReplyMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('user.contact.create');
    }

    public function store(Request $request)
    {
        // 1. Validate dữ liệu để tránh cột fullname bị null
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone'    => 'nullable|string|max:20',
            'email'    => 'nullable|email|max:255',
            'message'  => 'required|string',
        ]);

        // 2. Tạo bản ghi trong bảng contacts
        //    Đảm bảo bạn đã khai báo $fillable trong model Contact
        Contact::create($validatedData);

        // 3. Chuyển hướng kèm thông báo thành công
        return redirect()->route('contact.create')->with('success', 'Liên hệ đã được gửi.');
    }

    public function resendEmail($id)
    {
        $contact = Contact::find($id);
    
        // Kiểm tra nếu không tìm thấy liên hệ
        if (!$contact) {
            return redirect()->route('admin.contacts.index')->with('error', 'Liên hệ không tồn tại!');
        }
    
        // Kiểm tra nếu email không tồn tại hoặc không hợp lệ
        if (empty($contact->email) || !filter_var($contact->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->route('admin.contacts.index')->with('error', 'Email không hợp lệ hoặc không tồn tại!');
        }
    
        try {
            // Gửi email
            Mail::to($contact->email)->send(new ContactReplyMail($contact));
    
            return redirect()->route('admin.contacts.index')->with('success', 'Email đã được gửi lại thành công!');
        } catch (Exception $e) {
            // Ghi log lỗi để kiểm tra
            Log::error('Lỗi gửi mail: ' . $e->getMessage());
    
            return redirect()->route('admin.contacts.index')->with('error', 'Gửi email thất bại! Vui lòng thử lại sau.');
        }
    
    }
}

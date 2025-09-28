<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\AdminAllUsersMail;

class MailController extends Controller
{
    public function showMailForm()
    {
        return view('admin.mail_form');
    }

    public function send(Request $request)
    {
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new AdminAllUsersMail(
                $user,
                $request->subject,
                $request->body,
            ));
        }

        $message = '全ユーザーにメールを送信しました';

        return redirect('/admin/mail')->with('success', $message);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function forget(Request $request)
    {
        if (empty($request->nik) || (!empty($request->nik) && $request->nik == '')) {
            $data['message'] = 'NIK tidak boleh kosong';
            return view('auth.passwords.error')->with($data);
        }
        $data['nik'] = $request->nik;

        return view('auth.passwords.change_password')->with($data);
    }

    public function change(Request $request)
    {
        if (empty($request->nik) || (!empty($request->nik) && $request->nik == '')) {
            $data['message'] = 'NIK tidak boleh kosong';
            return view('auth.passwords.error')->with($data);
        }

        $request->validate([
            'password' => 'required|min:8|same:r_password',
        ]);

        $user = User::where('username', $request->nik)->first();

        $data['password'] = bcrypt($request->password);
        if ($user->update($data))
            return redirect()->route('auth.success');
        else {
            Alert::error('Error!', 'Gagal ubah password.');
            return redirect()->back();
        }
    }

    public function success()
    {
        return view('auth.passwords.success');
    }
}

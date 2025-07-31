<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function start()
    {
        return view('auth/start');
    }

    public function loginForm()
    {
        return view('auth/login');
    }

    public function login()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id'   => $user['id'],
                'user_name' => $user['username'],
                'logged_in' => true
            ]);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->withInput()->with('error', 'Email atau password salah');
    }

    public function registerForm()
    {
        return view('auth/register');
    }

    public function register()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'username'         => 'required',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required',
            'pass_confirm' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new \App\Models\UserModel();

        $userData = [
            'username'     => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        $saved = $userModel->save($userData);
        if (!$saved) {
            return redirect()->back()->withInput()->with('errors', ['Gagal menyimpan user.']);
        }

        $user = $userModel->where('email', $userData['email'])->first();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Registrasi berhasil, tapi gagal login otomatis.');
        }

        session()->set([
            'user_id'   => $user['id'], // pastikan ini diset
            'user_name' => $user['username'], // opsional
            'logged_in' => true
        ]);
        
        return redirect()->to('/dashboard')->with('success', 'Selamat datang, ' . $user['username'] . '!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function resetPasswordForm()
    {
        return view('auth/reset-password', [
            'token' => $this->request->getGet('token') // jika ingin menggunakan token
        ]);
    }

    public function resetPassword()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'email'        => 'required|valid_email',
            'password'     => 'required',
            'pass_confirm' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if ($user) {
            $userModel->update($user['id'], [
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
            ]);
            return redirect()->to('/login')->with('success', 'Password berhasil diubah.');
        }

        return redirect()->back()->withInput()->with('errors', ['Email tidak ditemukan.']);
    }
}

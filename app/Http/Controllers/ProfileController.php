<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function edit(Request $request): Response
    {
        // ใช้ Inertia.js เพื่อเรนเดอร์หน้าฟอร์มแก้ไขโปรไฟล์
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail, // ตรวจสอบว่าผู้ใช้จำเป็นต้องยืนยันอีเมลหรือไม่
            'status' => session('status'), // ส่งสถานะล่าสุด (เช่น สำเร็จหรือผิดพลาด) ไปยังหน้าเว็บ
        ]);
    }

    /**
     * อัปเดตข้อมูลโปรไฟล์ของผู้ใช้
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // เติมข้อมูลในโมเดล User ด้วยข้อมูลที่ผ่านการตรวจสอบจาก ProfileUpdateRequest
        $request->user()->fill($request->validated());

        // หากอีเมลของผู้ใช้มีการเปลี่ยนแปลง ให้รีเซ็ตสถานะการยืนยันอีเมล
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null; // ตั้งค่า email_verified_at เป็น null
        }

        // บันทึกข้อมูลโปรไฟล์ที่แก้ไข
        $request->user()->save();

        // ส่งผู้ใช้กลับไปยังหน้าโปรไฟล์
        return Redirect::route('profile.edit');
    }

    /**
     * ลบบัญชีผู้ใช้
     */
    public function destroy(Request $request): RedirectResponse
    {
        // ตรวจสอบว่าผู้ใช้ป้อนรหัสผ่านปัจจุบันถูกต้อง
        $request->validate([
            'password' => ['required', 'current_password'], // รหัสผ่านต้องไม่ว่างและต้องตรงกับรหัสผ่านปัจจุบัน
        ]);

        // เก็บโมเดลผู้ใช้ปัจจุบันในตัวแปร $user
        $user = $request->user();

        // ออกจากระบบผู้ใช้
        Auth::logout();

        // ลบข้อมูลผู้ใช้ออกจากฐานข้อมูล
        $user->delete();

        // ทำให้เซสชันปัจจุบันไม่สามารถใช้งานได้
        $request->session()->invalidate();

        // สร้าง token ใหม่สำหรับป้องกัน CSRF
        $request->session()->regenerateToken();

        // ส่งผู้ใช้กลับไปที่หน้าแรก
        return Redirect::to('/');
    }
}




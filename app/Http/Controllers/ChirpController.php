<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ChirpController extends Controller
{
    /**
     * แสดงรายการของทรัพยากร (Chirps) ทั้งหมด
     */
    public function index(): Response
    {
        // ส่งข้อมูล chirps ไปที่ Inertia และแสดงในหน้า Chirps/Index
        return Inertia::render("Chirps/Index", [
            'chirps' => Chirp::with('user:id,name')->latest()->get(), // ดึงข้อมูลผู้ใช้ที่เกี่ยวข้อง และเรียงจากใหม่ไปเก่า
        ]);
    }


    public function create() // Function การสร้าง
    {
    }

    /**
     * บันทึกโพสต์ใหม่ลงDB
     */
    public function store(Request $request): RedirectResponse
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $validated = $request->validate([
            'message' => 'required|string|max:255', // ข้อความต้องไม่ว่าง และยาวไม่เกิน 255 ตัวอักษร
        ]);

        // สร้าง chirp ใหม่ที่เชื่อมกับผู้ใช้ หลังจากตรวจสอบว่าตรงตามเงื่อนไข
        $request->user()->chirps()->create($validated);

        // ส่งผู้ใช้กลับไปยังหน้าแสดงรายการ chirps
        return redirect(route('chirps.index'));
    }


    public function show(Chirp $chirp)// Function การแสดง
    {
    }


    public function edit(Chirp $chirp)// Function การแก้ไข
    {

    }

    /**
     * อัปเดตโพสต์เฉพาะในฐานข้อมูล
     */
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        // ตรวจสอบสิทธิ์ของผู้ใช้ด้วย Gate
        Gate::authorize('update', $chirp);

        // ตรวจสอบข้อมูลที่ส่งมา
        $validated = $request->validate([
            'message' => 'required|string|max:255', // ข้อความต้องไม่ว่าง และยาวไม่เกิน 255 ตัวอักษร
        ]);

        // อัปเดต chirp ด้วยข้อมูลที่ผ่านการตรวจสอบ
        $chirp->update($validated);

        // ส่งผู้ใช้กลับไปยังหน้าแสดงรายการ chirps
        return redirect(route('chirps.index'));
    }

    /**
     * ลบทรัพยากรเฉพาะตัวออกจากฐานข้อมูล
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        // ตรวจสอบสิทธิ์ของผู้ใช้ด้วย Gate
        Gate::authorize('delete', $chirp);

        // ลบ chirp ออกจากฐานข้อมูล
        $chirp->delete();

        // ส่งผู้ใช้กลับไปยังหน้าแสดงรายการ chirps
        return redirect(route('chirps.index'));
    }
}

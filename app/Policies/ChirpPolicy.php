<?php

namespace App\Policies;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChirpPolicy
{
    /*
     กำหนดสิทธิ์ว่าผู้ใช้สามารถดูรายการ Chirp ทั้งหมดได้มั้ย
     ค่าเริ่มต้นจะเป็น false
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /*
    กำหนดสิทธิ์ว่าผู้ใช้สามารถดู Chirp เฉพาะตัวได้มั้ย
     ค่าเริ่มต้นจะเป็น false
     */
    public function view(User $user, Chirp $chirp): bool
    {
        return false;
    }

    /*
     กำหนดสิทธิ์ว่าผู้ใช้สามารถสร้าง Chirp ใหม่ได้มั้ย
     ค่าเริ่มต้นจะเป็น false
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * กำหนดสิทธิ์ว่าผู้ใช้สามารถแก้ไข Chirp ได้หรือไม่
     * เงื่อนไข: ผู้ใช้ต้องเป็นเจ้าของ Chirp เท่านั้น (เช็คด้วย $chirp->user()->is($user))
     */
    public function update(User $user, Chirp $chirp): bool
    {
        return $chirp->user()->is($user);
    }

    /**
     * กำหนดสิทธิ์ว่าผู้ใช้สามารถลบ Chirp ได้หรือไม่
     * ใช้เงื่อนไขเดียวกับฟังก์ชัน update (ผู้ใช้ต้องเป็นเจ้าของ Chirp)
     */
    public function delete(User $user, Chirp $chirp): bool
    {
        return $this->update($user, $chirp);
    }

    /**
     * กำหนดสิทธิ์ว่าผู้ใช้สามารถกู้คืน Chirp ที่ถูกลบได้หรือไม่
     * ปัจจุบันตั้งค่าให้ไม่อนุญาตทุกกรณี (return false)
     */
    public function restore(User $user, Chirp $chirp): bool
    {
        return false;
    }

    /**
     * กำหนดสิทธิ์ว่าผู้ใช้สามารถลบ Chirp ถาวรได้หรือไม่
     * ปัจจุบันตั้งค่าให้ไม่อนุญาตทุกกรณี (return false)
     */
    public function forceDelete(User $user, Chirp $chirp): bool
    {
        return false;
    }
}

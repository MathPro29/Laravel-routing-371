<?php

namespace App\Models;

// ใช้คุณสมบัติและฟังก์ชันต่างๆ ของ Laravel
use Illuminate\Database\Eloquent\Relations\HasMany; // ใช้สำหรับการนิยามความสัมพันธ์แบบหนึ่งต่อหลาย
use Illuminate\Database\Eloquent\Factories\HasFactory; // ใช้สำหรับสร้างข้อมูลทดสอบ
use Illuminate\Foundation\Auth\User as Authenticatable; // ฐานข้อมูลสำหรับการพิสูจน์ตัวตนของผู้ใช้
use Illuminate\Notifications\Notifiable; // ใช้สำหรับส่งการแจ้งเตือน

class User extends Authenticatable
{
    /**
     * กำหนดความสัมพันธ์ระหว่าง User และ Chirp
     * User สามารถมี Chirp ได้หลายรายการ (HasMany)
     *
     * @return HasMany ความสัมพันธ์แบบหนึ่งต่อหลาย
     */
    public function chirps(): HasMany
    {
        return $this->hasMany(Chirp::class); // เชื่อมกับโมเดล Chirp
    }

    /**
     * ใช้ Traits HasFactory และ Notifiable
     * - HasFactory: ช่วยสร้างข้อมูลตัวอย่างสำหรับโมเดล
     * - Notifiable: ใช้สำหรับการส่งการแจ้งเตือนให้ผู้ใช้
     */
    use HasFactory, Notifiable;

    /**
     * กำหนดฟิลด์ที่สามารถกำหนดค่าได้ (Mass Assignable)
     * ฟิลด์เหล่านี้สามารถถูกกำหนดค่าผ่านแบบฟอร์มหรือ API ได้
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // ชื่อผู้ใช้
        'email', // อีเมลผู้ใช้
        'password', // รหัสผ่าน
    ];

    /**
     * กำหนดฟิลด์ที่ควรซ่อนเมื่อทำการ Serialize
     * ฟิลด์เหล่านี้จะไม่แสดงผลเมื่อส่งข้อมูลออกในรูปแบบ JSON หรือ Array
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // ซ่อนรหัสผ่าน
        'remember_token', // ซ่อน remember_token
    ];

    /**
     * กำหนดรูปแบบการแปลงค่า (Casting) สำหรับฟิลด์ในฐานข้อมูล
     *
     * @return array<string, string> รายการฟิลด์ที่ต้องการแปลงค่า
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // แปลง email_verified_at เป็น datetime
            'password' => 'hashed', // แปลงรหัสผ่านให้เป็นรูปแบบที่ถูกเข้ารหัส
        ];
    }
}

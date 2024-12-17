<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    /**
     * กำหนดฟิลด์ที่สามารถกำหนดค่าได้
     * ฟิลด์ 'message' สามารถกำหนดค่าได้ผ่านการสร้างหรืออัปเดต
     */
    protected $fillable = [
        'message',
    ];

    /**
     * ความสัมพันธ์ระหว่าง Chirp กับ User
     * ระบุว่า Chirp แต่ละอันเป็นของผู้ใช้หนึ่งคน (BelongsTo)
     *
      * return BelongsTo ความสัมพันธ์แบบ belongsTo กับ User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); // กำหนดว่า Chirp เชื่อมโยงกับโมเดล User
    }
}

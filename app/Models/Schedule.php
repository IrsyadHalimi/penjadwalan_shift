<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'user_id', 'start_date', 'end_date'
    ];

    public static function validate($request)
    {
        $request->validate([
            "user_id" => "required",
            "shift_id" => "required",
            "start_date" => "required",
            "end_date" => "required",
        ]);
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }
    
    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function setUser($user_id)
    {
        $this->attributes['user_id'] = $user_id;
    }
    
    public function getShiftId()
    {
        return $this->attributes['shift_id'];
    }

    public function setShift($shift_id)
    {
        $this->attributes['shift_id'] = $shift_id;
    }
    
    public function getStartDate()
    {
        return $this->attributes['start_date'];
    }

    public function setStartDate($start_date)
    {
        $this->attributes['start_date'] = $start_date;
    }

    public function getEndDate()
    {
        return $this->attributes['end_date'];
    }

    public function setEndDate($end_date)
    {
        $this->attributes['end_date'] = $end_date;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($createdAt)
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->attributes['updated_at'] = $updatedAt;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
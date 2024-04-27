<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    public static function validate($request)
    {
        $request->validate([
            "shift_name" => "required",
            "start_time" => "required",
            "end_time" => "required",
        ]);
    }

    public function getId()
    {
        return $this->attributes['id'];
    } 
    
    public function getShiftName()
    {
        return $this->attributes['shift_name'];
    }

    public function setShiftName($shift_name)
    {
        $this->attributes['shift_name'] = $shift_name;
    }

    public function getDepartmentId()
    {
        return $this->attributes['department_id'];
    }

    public function setDepartmentId($department_id)
    {
        $this->attributes['department_id'] = $department_id;
    }
    
    public function getStartTime()
    {
        return $this->attributes['start_time'];
    }
    
    public function setStartTime($start_time)
    {
        $this->attributes['start_time'] = $start_time;
    }

    public function getEndTime()
    {
        return $this->attributes['end_time'];
    } 
    
    public function setEndTime($end_time)
    {
        $this->attributes['end_time'] = $end_time;
    }

    public function getNotes()
    {
        return $this->attributes['notes'];
    } 

    public function setNotes($notes)
    {
        $this->attributes['notes'] = $notes;
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

    public function getLabelColor()
    {
        return $this->attributes['label_color'];
    }

    public function setLabelColor($label_color)
    {
        $this->attributes['label_color'] = $label_color;
    }
}

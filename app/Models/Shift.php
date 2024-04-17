<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = "shift";
    
    protected $primaryKey = "id_shift";

    public static function validate($request)
    {
        $request->validate([
            "nama_shift" => "required",
            "jam_masuk" => "required",
            "jam_keluar" => "required",
        ]);
    }

    public function getId()
    {
        return $this->attributes['id_shift'];
    } 
    
    public function getShiftName()
    {
        return $this->attributes['nama_shift'];
    }

    public function setShiftName($shiftName)
    {
        $this->attributes['nama_shift'] = $shiftName;
    }
    
    public function getStartTime()
    {
        return $this->attributes['jam_masuk'];
    }
    
    public function setStartTime($startTime)
    {
        $this->attributes['jam_masuk'] = $startTime;
    }

    public function getEndTime()
    {
        return $this->attributes['jam_keluar'];
    } 
    
    public function setEndTime($endTime)
    {
        $this->attributes['jam_keluar'] = $endTime;
    }

    public function getNote()
    {
        return $this->attributes['keterangan'];
    } 

    public function setNote($note)
    {
        $this->attributes['keterangan'] = $note;
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
}

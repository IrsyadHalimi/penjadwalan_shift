<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class Shift extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;
    
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $validator = Validator::make($model->attributes, [
                'shift_name' => "required|string|max:50",
                'department_id' => "required",
                'start_time' => "required|date_format:H:i",
                'end_time' => "required|date_format:H:i|after:start_time",
            ], [
                'shift_name.required' => 'Nama shift harus diisi.',
                'shift_name.string' => 'Nama shift harus berupa teks.',
                'shift_name.max' => 'Nama shift tidak boleh lebih dari 50 karakter.',
                'start_time.required' => 'Waktu mulai harus diisi.',
                'start_time.date_format' => 'Format waktu mulai tidak valid.',
                'end_time.required' => 'Waktu selesai harus diisi.',
                'end_time.date_format' => 'Format waktu selesai tidak valid.',
                'end_time.after' => 'Waktu selesai harus setelah waktu mulai.',
                'department_id.required' => 'Departemen harus diisi.',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
        });
    }

    public function getId()
    {
        return $this->attributes['id'];
    }
    
    public function setId($id)
    {
        $this->attributes['id'] = $id;
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

    public function getDescription()
    {
        return $this->attributes['description'];
    } 

    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
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

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}

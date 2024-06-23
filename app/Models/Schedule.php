<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class Schedule extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';

    public $incrementing = false;
    
    protected $keyType = 'string';
    
    protected $fillable = [
        'id',
        'user_id', 
        'start_date', 
        'end_date'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $validator = Validator::make($model->attributes, [
                'user_id' => "required",
                'shift_id' => "required",
                'start_date' => "required|date",
                'end_date' => "required|date|after:start_date",
            ], [
                'user_id.required' => 'Operator harus dipilih',
                'shift_id.required' => 'Shift harus dipilih',
                'start_date.required' => 'Tanggal mulai harus diisi.',
                'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
                'end_date.required' => 'Tanggal selesai harus diisi.',
                'end_date.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
                'end_date.after' => 'Tanggal selesai harus setelah tanggal mulai.',
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
    
    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function setUserId($user_id)
    {
        $this->attributes['user_id'] = $user_id;
    }
    
    public function getShiftId()
    {
        return $this->attributes['shift_id'];
    }

    public function setShiftId($shift_id)
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

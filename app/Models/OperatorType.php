<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OperatorType extends Model
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
                'operator_name_type' => "required|string|max:50",
                'department_id' => "required",
            ], [
                'operator_name_type.required' => 'Nama jenis operator harus diisi.',
                'operator_name_type.string' => 'Nama jenis operator harus berupa teks.',
                'operator_name_type.max' => 'Nama jenis operator tidak boleh lebih dari 50 karakter.',
                'department_id.required' => 'Departemen harus dipilih.',
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
    
    public function getOperatorNameType()
    {
        return $this->attributes['operator_name_type'];
    }

    public function setOperatorNameType($operator_name_type)
    {
        $this->attributes['operator_name_type'] = $operator_name_type;
    }

    public function getDepartmentId()
    {
        return $this->attributes['department_id'];
    }

    public function setDepartmentId($department_id)
    {
        $this->attributes['department_id'] = $department_id;
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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Department extends Model
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
                'department_name' => "required|string|max:50",
            ], [
                'department_name.required' => 'Nama departemen harus diisi.',
                'department_name.string' => 'Nama departemen harus berupa teks.',
                'department_name.max' => 'Nama departemen tidak boleh lebih dari 50 karakter.',
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
    
    public function getDepartmentName()
    {
        return $this->attributes['department_name'];
    }

    public function setDepartmentName($department_name)
    {
        $this->attributes['department_name'] = $department_name;
    }

    public function getCompanyId()
    {
        return $this->attributes['company_id'];
    }

    public function setCompanyId($company_id)
    {
        $this->attributes['company_id'] = $company_id;
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

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function operatorType()
    {
        return $this->hasMany(OperatorType::class);
    }
}

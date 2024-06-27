<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class Company extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = false;
    
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'company_name',
        'company_address',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $validator = Validator::make($model->attributes, [
                'company_name' => "required|string|max:50",
                'company_address' => "required|string|max:50",
            ], [
                'company_name.required' => 'Nama perusahaan harus diisi.',
                'company_name.string' => 'Nama perusahaan harus berupa teks.',
                'company_name.max' => 'Nama perusahaan tidak boleh lebih dari 50 karakter.',
                'company_address.required' => 'Alamat perusahaan harus diisi.',
                'company_address.string' => 'Alamat perusahaan harus berupa teks.',
                'company_address.max' => 'Alamat perusahaan tidak boleh lebih dari 50 karakter.',
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
    
    public function getCompanyName()
    {
        return $this->attributes['company_name'];
    }

    public function setCompanyName($company_name)
    {
        $this->attributes['company_name'] = $company_name;
    }

    public function getCompanyAddress()
    {
        return $this->attributes['company_address'];
    }

    public function setCompanyAddress($company_address)
    {
        $this->attributes['company_address'] = $company_address;
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
        return $this->hasMany(User::class, 'company_id', 'id');
    }
    
    public function departments()
    {
        return $this->hasMany(Department::class, 'department_id', 'id');
    }
}

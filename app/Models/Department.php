<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public static function validate($request)
    {
        $request->validate([
            "department_name" => "required",
        ]);
    }

    public function getId()
    {
        return $this->attributes['id'];
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
}

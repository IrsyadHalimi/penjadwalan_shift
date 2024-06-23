<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends AuthenticatableUser implements Authenticatable
{   
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';

    public $incrementing = false;
    
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'company_id',
        'department_id',
        'full_name', 
        'employee_id',
        'email', 
        'password',
        'phone_number',
        'role',
    ];

    public static function validate($request)
    {
        $request->validate([
            "department_id" => "required",
            "full_name" => "required",
            "employee_id" => "required",
            "email" => "required",
            "phone_number" => "required",
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
    
    public function getName()
    {
        return $this->attributes['full_name'];
    }

    public function setName($full_name)
    {
        $this->attributes['full_name'] = $full_name;
    }

    public function getEmployeeId()
    {
        return $this->attributes['employee_id'];
    }

    public function setEmployeeId($employee_id)
    {
        $this->attributes['employee_id'] = $employee_id;
    }
    
    public function getEmail()
    {
        return $this->attributes['email'];
    }

    public function setEmail($email)
    {
        $this->attributes['email'] = $email;
    }

    public function setPassword($password)
    {
        $this->attributes['password'] = $password;
    }
    
    public function getOperatorTypeId()
    {
        return $this->attributes['operator_type_id'];
    }

    public function setOperatorTypeId($operator_type_id)
    {
        $this->attributes['operator_type_id'] = $operator_type_id;
    }
    
    public function getDepartmentId()
    {
        return $this->attributes['department_id'];
    }

    public function setDepartmentId($department_id)
    {
        $this->attributes['department_id'] = $department_id;
    }

    public function getCompanyId()
    {
        return $this->attributes['company_id'];
    }

    public function setCompanyId($company_id)
    {
        $this->attributes['company_id'] = $company_id;
    }

    public function getPhoneNumber()
    {
        return $this->attributes['phone_number'];
    }

    public function setPhoneNumber($phone_number)
    {
        $this->attributes['phone_number'] = $phone_number;
    }
    
    public function getRole()
    {
        return $this->attributes['role'];
    }

    public function setRole($role)
    {
        $this->attributes['role'] = $role;
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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function operatorType()
    {
        return $this->belongsTo(OperatorType::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}

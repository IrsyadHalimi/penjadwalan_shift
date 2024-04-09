<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends AuthenticatableUser implements Authenticatable
{
    protected $table = "user";

    protected $primaryKey = "id_user";

    protected $fillable = [
        'nama_lengkap', 
        'nomor_pegawai',
        'email', 
        'password',
        'departemen',
        'nomor_telepon',
        'role',
    ];
    
    public function getId()
    {
        return $this->attributes['id_user'];
    }

    public function setId($id)
    {
        $this->attributes['id_user'] = $id;
    }
    
    public function getName()
    {
        return $this->attributes['nama_lengkap'];
    }

    public function setUser($id_user)
    {
        $this->attributes['id_user'] = $id_user;
    }
    
    public function getDepartment()
    {
        return $this->attributes['departemen'];
    }

    public function setEmail($email)
    {
        $this->attributes['email'] = $email;
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
}

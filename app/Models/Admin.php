<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'username', 'email', 'password', 'picure', 'is_deleted'];

    public function isEmailExist($email)
    {
        $query = $this->table('admins')
            ->where('email', $email)
            ->where('is_deleted', 'no')
            ->countAllResults();

        return $query > 0;
    }

    public function isUsernameExist($username)
    {
        $query = $this->table('admins')
            ->where('username', $username)
            ->where('is_deleted', 'no')
            ->countAllResults();

        return $query > 0;
    }
}

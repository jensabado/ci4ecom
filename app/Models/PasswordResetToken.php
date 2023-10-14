<?php

namespace App\Models;

use CodeIgniter\Model;

class PasswordResetToken extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'password_reset_token';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'type', 'token', 'created_at'];

    public function isOldTokenExist($email, $type)
    {
        $query = $this->table('password_reset_token')
            ->where('email', $email)
            ->where('type', $type)
            ->get()->getRow();

        return !empty($query);

    }

}

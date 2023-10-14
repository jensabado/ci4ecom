<?php
use App\Libraries\CIAuth;
use Config\Services;

if (!function_exists('getUser')) {
    function getUser()
    {
        if (CIAuth::checkAdmin()) {
          $db = \Config\Database::connect();

          return $db->table('admins')
          ->where('id', CIAuth::adminId())
          ->where('is_deleted', 'no')
          ->get()->getRowArray();
        } else {
          return null;
        }
    }
}
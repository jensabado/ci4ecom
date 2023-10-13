<?php
namespace App\Libraries;

class CIAuth
{
    public static function setCIAuthAdmin($result)
    {
        $session = session();
        $array = ['admin_is_logged_in' => true];
        $admin_data = $result;
        $session->set('admin_data', $admin_data);
        $session->set($array);
    }

    public static function adminId()
    {
        $session = session();
        if ($session->has('admin_is_logged_in')) {
            if ($session->has('admin_data')) {
                return $session->get('admin_data')['id'];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public static function checkAdmin()
    {
        $session = session();

        if ($session->has('admin_is_logged_in')) {
            return true;
        } else {
            return false;
        }
    }

    public static function forgetAdmin()
    {
        $session = session();
        $session->remove('admin_data');
        $session->remove('admin_is_logged_in');
    }

    public static function admin()
    {
        $session = session();
        if ($session->has('admin_is_logged_in')) {
            if ($session->has('admin_data')) {
                return $session->get('admin_data');
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}

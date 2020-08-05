<?php


namespace App\Helpers;


use App\Role;
use App\User;

class AppHelper
{
    public function __construct()
    {

    }

    public static function getCustomYear($date)
    {
        $format = null;
        switch (config("constants.GENERAL.DATABASE"))
        {
            case config("constants.DATABASES.SQL"):
                $format = "YEAR(".$date.") AS age";
                break;
            case config("constants.DATABASES.MYSQL"):
                $format = "TIMESTAMPDIFF(YEAR, ".$date.", CURDATE()) AS age";
                break;
        }
        return $format;
    }

    public static function getRoles($role_id,$rolName)
    {
        $format = null;
        switch (config("constants.GENERAL.DATABASE"))
        {
            case config("constants.DATABASES.SQL"):
                $format = "STUFF((
                                  SELECT DISTINCT ',' + sb1.name AS [text()]
                                  FROM roles sb1 join role_user sb2 on sb1.id = sb2.role_id
                                  WHERE sb2.user_id = ".$role_id."
                                  FOR XML PATH('')),1,1,'')";
                break;
            case config("constants.DATABASES.MYSQL"):
                $format = "group_concat(".$rolName." separator '')";
                break;
        }
        return $format;


//        $roles = Role::join("role_user","role_user.role_id","roles.id")
//            ->whereRaw("role_user.user_id = ".$user_id)
//            ->select("roles.name");
//
//        if($roles->count() == 0)
//            return $textRoles = "NO TIENE ROL";
//        else
//            $textRoles = "";
//
//        foreach ($roles->get() as $item)
//        {
//            $textRoles+=$item->name.", ";
//        }
//        $textRoles = substr($textRoles,0,-2);
//
//        return $textRoles;
    }
}

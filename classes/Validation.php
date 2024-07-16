<?php
class Validation
{
    public static function checkUserExist($type, $value)
    {
        $user = (new Database)->query("SELECT * FROM users WHERE {$type} = :{$type}", [
            "{$type}" => $value
        ])->get();
        return $user;
    }
}

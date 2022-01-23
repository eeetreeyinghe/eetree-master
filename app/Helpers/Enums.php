<?php

namespace App\Helpers;

class Enums
{
    public static function keys($name, $include = null)
    {
        $enums = config('enums.' . $name);
        $result = [];
        if ($include) {
            foreach ($include as $ename) {
                if (isset($enums[$enums])) {
                    $result[] = $enum['k'];
                }
            }
        } else {
            foreach ($enums as $enum) {
                $result[] = $enum['k'];
            }
        }
        return $result;
    }

    public static function values($name)
    {
        $enums = config('enums.' . $name);
        $result = [];
        foreach ($enums as $enum) {
            $result[] = $enum;
        }
        return $result;
    }

    public static function key($name)
    {
        $enum = config('enums.' . $name);
        return $enum['k'];
    }

    public static function label($name, $k)
    {
        $enums = config('enums.' . $name);
        foreach ($enums as $enum) {
            if ($enum['k'] == $k) {
                return $enum['l'];
            }
        }
        return null;
    }

    public static function get($name)
    {
        return config('enums.' . $name);
    }
}

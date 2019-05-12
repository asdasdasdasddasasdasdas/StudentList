<?php


namespace StudentList\helpers;


class Util
{
    /**
     * @param string $value
     * @return string
     */
    public function grabValue(string $value): string
    {
        return array_key_exists($value, $_POST) ?
            trim(strval($_POST[$value])) : "";
    }
}
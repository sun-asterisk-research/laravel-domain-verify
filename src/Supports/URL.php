<?php

namespace SunAsterisk\DomainVerifier\Supports;

class URL
{
    /**
     * Reformat URL
     *
     * @param  string  $url
     * @return string
     */
    public static function normalize(string $url)
    {
        $matched = preg_match('/^(http[s]?:\/\/(?:[a-zA-Z0-9-.:]+))(\/.*)?/', $url, $data);
        return $matched ? trim($data[1]) : '';
    }

    /**
     * get Domain name from URL
     *
     * @param string $url
     * @return string
     */
    public static function getDomainName(string $url)
    {
        $matched = preg_match('/(http[s]?:\/\/)(.+)/', $url, $data);
        return $matched ? trim($data[2]) : '';
    }
}

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
        return parse_url($url)['host'];
    }
}

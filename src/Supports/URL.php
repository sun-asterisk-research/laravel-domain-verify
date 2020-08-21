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
        $parsedUrl = parse_url($url);

        if (array_key_exists('host', $parsedUrl)) {
            return $parsedUrl['host'];
        }

        throw new \InvalidArgumentException('Provided URL\'s domain name cannot be parsed.');
    }
}

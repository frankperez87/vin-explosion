<?php

namespace VinExplosion;

/**
 * Class Account
 * @package VinExplosion
 */
class Account
{
    /**
     * @var
     */
    protected $username;
    /**
     * @var
     */
    protected $password;

    /**
     * @param $username
     * @param $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getAuthenticationString()
    {
        return $this->username . ':' . $this->password;
    }
}

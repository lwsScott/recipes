<?php

/**
 * Class User
 */
class User
{
    private $_firstname;
    private $_lastname;
    private $_email;
    private $_phone;
    private $_username;
    private $_password;


    /**
     * Student constructor.
     * @param $sid
     * @param $first
     * @param $last
     * @param null $birthdate
     * @param null $gpa
     * @param null $advisor
     */
    public function __construct($first, $last, $email, $phone, $username,$password)
    {
//        $this->_sid = $sid;
        $this->_firstname = $first;
        $this->_lastname = $last;
        $this->_email = $email;
        $this->_phone = $phone;
        $this->_username = $username;
        $this->_password=$password;
    }

    /**
     * @return mixed first name
     */
    public function getFirstname()
    {
        return $this->_firstname;
    }

    /**
     * @param mixed $first as firstname value
     */
    public function setFirstname($first)
    {
        $this->_firstname = $first;
    }

    /**
     * @return mixed last name
     */
    public function getLastname()
    {
        return $this->_lastname;
    }

    /**
     * @param mixed $last last name
     */
    public function setLastname($last)
    {
        $this->_lastname = $last;
    }


    /**
     * @return mixed email
     */
    public function getEmail()
    {
        return $this->_email;
    }


    /**
     * @param $email as email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed cell phone number
     */
    public function getPhone()
    {
        return $this->_phone;
    }


    /**
     * @param $phone as cell phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed username
     */
    public function getUsername()
    {
        return $this->_username;
    }


    /**
     * @param $username as username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * @return mixed password
     */
    public function getPassword()
    {
        return $this->_password;
    }


    /**
     * @param $password password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }



}
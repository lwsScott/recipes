<?php
/*
 * User class page for dating website
 * 5/30/20
 * filename https://lscott.greenriverdev.com/328/recipes/classes/user.php
 * @author Qinghang Zhang
 * @version 1.0
 */

/*
 * User class for recipe website
 * stores user information
 * 5/30/20
 * @author Qinghang Zhang
 * @version 1.0
 */

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
    private $_userId;

    /**
     * Student constructor.
     * @param $sid
     * @param $first
     * @param $last
     * @param null $birthdate
     * @param null $gpa
     * @param null $advisor
     */
    public function __construct($first, $last, $email, $phone, $username, $password)
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
     * @param mixed $first as first name
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
     * @param mixed $last as last name
     */
    public function setLastname($last)
    {
        $this->_lastname = $last;
    }


    /**
     * @return mixed email address
     */
    public function getEmail()
    {
        return $this->_email;
    }


    /**
     * @param $email as email address
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed as cell phone number
     */
    public function getPhone()
    {
        return $this->_phone;
    }


    /**
     * @param $phone as cell phone number
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed as the username
     */
    public function getUsername()
    {
        return $this->_username;
    }


    /**
     * @param $username as the username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * @return mixed as the password
     */
    public function getPassword()
    {
        return $this->_password;
    }


    /**
     * @param $password as password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }



}
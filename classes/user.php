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
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->_firstname;
    }

    /**
     * @param mixed $first
     */
    public function setFirstname($first)
    {
        $this->_firstname = $first;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->_lastname;
    }

    /**
     * @param mixed $last
     */
    public function setLastname($last)
    {
        $this->_lastname = $last;
    }


    public function getEmail()
    {
        return $this->_email;
    }


    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function getPhone()
    {
        return $this->_phone;
    }


    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    public function getUsername()
    {
        return $this->_username;
    }


    public function setUsername($username)
    {
        $this->_username = $username;
    }

    public function getPassword()
    {
        return $this->_password;
    }


    public function setPassword($password)
    {
        $this->_password = $password;
    }



}
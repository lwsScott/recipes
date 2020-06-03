<?php

class AdminUser extends user
{
    // submit user fields
    private $_permission;

    // constructor
    public function __construct($first, $last, $email, $phone, $username, $password)
    {
        // call the parent constructor
        parent::__construct($first, $last, $email, $phone, $username, $password);

        $this->_permission = 'admin';
    }

    /**
     * @return mixed
     */
    public function getPermission()
    {
        return $this->_permission;
    }

    /**
     * @param mixed $permission
     */
    public function setPermission($permission)
    {
        $this->_permission = $permission;
    }
}

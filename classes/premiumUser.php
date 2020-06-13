<?php
/*
 * Premium User class for recipe website
 * 5/30/20
 * filename https://lscott.greenriverdev.com/328/recipe/classes/recipe.php
 * @author Lewis Scott
 * @version 1.0
 */

/*
 * Premium User class for recipe website
 * stores user information
 * 5/30/20
 * @author Lewis Scott
 * @version 1.0
 */
class PremiumUser extends User
{
    // submit user fields
    /**
     * @var string
     */
    private $_permission;

    // constructor

    /**
     * PremiumUser constructor.
     * @param $first the first name
     * @param $last the last name
     * @param $email email address
     * @param $phone phone number
     * @param $username username
     * @param $password password
     */
    public function __construct($first, $last, $email, $phone, $username, $password)
    {
        // call the parent constructor
        parent::__construct($first, $last, $email, $phone, $username, $password);

        $this->_permission = 'upload';
    }

    /**
     * get the permission of the user
     * @return mixed
     */
    public function getPermission()
    {
        return $this->_permission;
    }

    /**
     * set the permission of the user
     * @param mixed $permission
     */
    public function setPermission($permission)
    {
        $this->_permission = $permission;
    }
}

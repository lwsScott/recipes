<?php
/*
 * logout of  recipe website
 * 5/30/20
 * filename https://lscott.greenriverdev.com/328/recipes/views/validate.php
 * @author Lewis Scott
 * @version 1.0
 */
    session_destroy();
    $_SESSION = array();
    header("location:  /328/recipes");

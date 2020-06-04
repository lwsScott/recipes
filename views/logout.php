<?php
    session_destroy();
    $_SESSION = array();
    header("location:  /328/recipes");

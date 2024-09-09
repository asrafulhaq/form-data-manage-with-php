<?php

/**
 * Create a alert for any validation 
 * @param $msg 
 * @param $type  
 */
function createAlert($msg, $type = "danger")
{
    return "<p class=\"alert alert-{$type} d-flex justify-content-between\">{$msg}<button class=\"btn-close\" data-bs-dismiss=\"alert\"></button></p>";
}

/**
 * Get old form values after submit a form 
 */
function old($field_name)
{
    return $_POST[$field_name] ?? '';
}


/**
 * Reset  form old data after a successful submit
 */
function reset_form()
{
    return $_POST = [];
}

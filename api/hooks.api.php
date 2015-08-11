<?php

class Hooks_api extends Hooks
{
    /**
     * Call any Statamic API method.
     * @author Curtis Blackwell
     * @return mixed Whatever the API method returns, baby.
     */
    public function api__call()
    {
        // Figure out which class and method to use.
        // Default to POST, fall back to GET.
        $class  = array_get($_POST, 'class', array_get($_GET, 'class'));
        $method = array_get($_POST, 'method', array_get($_GET, 'method'));
        // Unset the class and method so that the implosion of the rest of the
        // data results in the necessary args.
        unset($_GET['class'], $_GET['method'], $_POST['class'], $_POST['method']);

        $args = isset($_POST) ? implode(', ', $_POST) : implode(', ', $_GET);


        return $class::$method(implode(', ', $_GET));
    }
}

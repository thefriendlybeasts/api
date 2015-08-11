<?php

class Hooks_r2 extends Hooks
{
    /**
     * Call any Statamic API method.
     * @author Curtis Blackwell
     * @return mixed Whatever the API method returns, baby.
     */
    public function r2__statamic_api_call()
    {
        // Figure out which class and method to use.
        // Default to POST, fall back to GET.
        $class  = array_get($_POST, 'class', array_get($_GET, 'class'));
        $method = array_get($_POST, 'method', array_get($_GET, 'method'));
        // Unset the class and method so that the implosion of the rest of the
        // data results in the necessary args.
        unset($_POST['class'], $_POST['method'], $_GET['class'], $_GET['method']);

        $args = !empty($_POST) ? $_POST : $_GET;

        $response = call_user_func_array(array($class, $method), $args);

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            die(json_encode($response));
        }
        return $response;
    }





    /**
     * Why stop at the Statamic API? Call other add-ons APIs, too!
     * @author Curtis Blackwell
     * @return mixed Whatever the API method returns, broseph.
     */
    public function r2__addon_api_call()
    {
        // Figure out which add-on and method to use.
        // Default to POST, fall back to GET.
        $addon  = array_get($_POST, 'addon', array_get($_GET, 'addon'));
        $addon  = isset($addon)
            ? $addon
            : array_get($_POST, 'add-on', array_get($_GET, 'add-on'));
        $addon  = isset($addon)
            ? $addon
            : array_get($_POST, 'class', array_get($_GET, 'class'));
        $method = array_get($_POST, 'method', array_get($_GET, 'method'));
        // Unset the class and method so that the implosion of the rest of the
        // data results in the necessary args.
        unset(
            $_POST['addon'],
            $_POST['add-on'],
            $_POST['class'],
            $_POST['method'],
            $_GET['addon'],
            $_GET['add-on'],
            $_GET['class'],
            $_GET['method']
        );

        $args = !empty($_POST) ? $_POST : $_GET;

        $response = call_user_func_array(array($this->addon->api($addon), $method), $args);


        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) {
            die(json_encode($response));
        }
        return $response;
    }
}

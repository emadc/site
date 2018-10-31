<?php

class User
{
    public function __construct(){
        
    }
    
    /**
     * Render of login page
     */
    public function login() {
        $myView = new View ( 'login', 'admin/' );
        $myView->render ( array (
            'role' => null
        ) );
    }
    
    /**
     * Logout function
     */
    public function logout() {
        session_unset ();
        session_destroy ();
        $myView = new View ( 'login', 'admin/' );
        $myView->render ( array (
            'role' => null
        ) );
    }
    
    /**
     * Looking for user in the database
     *
     * @param array $params
     */
    public function checkUser($params) {
        extract ( $params );
        $manager = new UserManager();
        
        $role = null;
        
        if ($user = $manager->getUser ( $this->test_input( $values ['login'] ), $this->test_input( $values ['password'] ) )) {
            $role = $user ['role'];
            $username = $user ['username'];
            $template = "admin";
            $_SESSION ['role'] = $role;
            $_SESSION ['username'] = $username;
            $this->showAdmin ( $params );
        } else {
            $myView = new View ();
            $myView->redirect ( 'login' );
        }
    }
    
    /**
     * Render of administration default page
     *
     * @param mixed $params
     */
    public function showAdmin($params) {
        $myView = new View ( 'admin', 'admin/' );
        $myView->render ( array (
            'role' => $_SESSION ['role'],
        ) );
    }
    
    /**
     * Sanitize form data
     * @param mixed $data
     * @return string
     */
    public function test_input($data) {
        $data = trim ( $data );
        $data = stripslashes ( $data );
        $data = filter_var ( $data, FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        $data = filter_var ( $data, FILTER_SANITIZE_STRING );
        return $data;
    }
}
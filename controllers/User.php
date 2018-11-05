<?php

class User
{
    public function __construct(){
        
    }
    
    /**
     * Render of login page
     */
    public function login() {
        $manager = new LayoutManager ();
        
        $myView = new View ('login');
        $myView->render ( array (
            'menu' => $manager->getMenu (),
            'bottom' => $manager->getPage ( 'bottom' ),
            'role' => null
        ) );
    }
    
    /**
     * Logout function
     */
    public function logout() {
        session_unset ();
        session_destroy ();
        $this->login();
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
            $username = $user ['user_name'];
            $_SESSION ['role'] = $role;
            $_SESSION ['username'] = $username;
            Page::showProtected ( $params );
        } else {
            $myView = new View ();
            $myView->redirect ( 'login' );
        }
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
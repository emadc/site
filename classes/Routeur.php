<?php

/**
 * Class Routeur
 *
 * create routes and find controller
 */
class Routeur
{
    private $request;

    /**
     * Array of the available routeses, role and area to manage the accesses
     * @var array
     */
    private $routes = [
    		""					=> ["controller" => 'Home',  "method" => 'showHome',		"area" => 'PUBLIC',	"role" => 'USER'],
    		"404"     			=> ["controller" => 'Home',  "method" => 'notFound',		"area" => 'PUBLIC',	"role" => 'USER'],
            "page"				=> ["controller" => 'Page',  "method" => 'showPage',		"area" => 'PUBLIC',	"role" => 'USER'],
    		"protect"		    	=> ["controller" => 'User',  "method" => 'showAdmin',		"area" => 'PRIVATE',"role" => 'ADMIN'],
    		"login"		    	=> ["controller" => 'User',  "method" => 'login',			"area" => 'PUBLIC',	"role" => 'USER'],
    		"auth"		    	=> ["controller" => 'User',  "method" => 'checkUser',		"area" => 'PUBLIC',	"role" => 'USER'],
    		"logout"			=> ["controller" => 'User',  "method" => 'logout',			"area" => 'PUBLIC',	"role" => 'USER'],
    ];

    private $username;
    private $role;
    
    public function __construct($request)
    {
        $this->request = $request;
        // création de la session utilisateur
        $this->username = $this->getUsername();
        $this->role     = $this->getRole();
    }

    /**
     * Parsing of the url
     * @return mixed
     */
    public function getRoute()
    {
        $elements = explode('/', $this->request);
        return $elements[0];
    }

    /**
     * Parsing of the parameters
     * @return mixed[]
     */
    public function getParams()
    {

        $params = array();

        $elements = explode('/', $this->request);
        unset($elements[0]);

        for($i = 1; $i<count($elements); $i++)
        {
            $params[$elements[$i]] = $elements[$i+1];
            $i++;
        }

        if($_POST)
        {
            foreach($_POST as $key => $val)
            {
                $params[$key] = $val;
            }
        }

        return $params;

    }

    /**
     * Verification of the access rights and render of the controller
     */
    public function renderController()
    {
        
        $route  = $this->getRoute();
        $params = $this->getParams();
        if(key_exists($route, $this->routes))
        {
        	// vérification des droits utilisateur
        	if ($this->routes[$route]['area'] == "PUBLIC") 
        	{
        		$controller = $this->routes[$route]['controller'];
        		$method     = $this->routes[$route]['method'];
        		
        		$currentController = new $controller();
        		$currentController->$method($params);
            }
            else 
            {
            	if ($this->routes[$route]['role'] == $this->role) {
            		$controller = $this->routes[$route]['controller'];
            		$method     = $this->routes[$route]['method'];
            		
            		$currentController = new $controller();
            		$currentController->$method($params);
            	}
            	else {
            		$controller = $this->routes[$route]['controller'];
            		$method     = "login";
            		
            		$currentController = new $controller();
            		$currentController->$method($params);
            	}
            }
        } 
        else 
        {
        	header("Location: ".HOST."404");
        }

    }
    
    /**
     * Get the user in the session
     * @return mixed
     */
    public function getUsername()
    {
    	if(!isset($_SESSION['username'])) return null;
    	return $_SESSION['username'];
    }
    
    /**
     * Get the role in the session
     * @return mixed
     */
    public function getRole()
    {
    	if(!isset($_SESSION['role'])) return null;
    	return $_SESSION['role'];
    }
}
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
    private $routes = [];

    private $username;
    private $role;
    
    public function __construct($request)
    {
        $this->request = $request;
        // création de la session utilisateur
        $this->username = $this->getUsername();
        $this->role     = $this->getRole();
        
        if(isset($_SESSION['routes'])){ 
        	$this->routes= $_SESSION['routes'];
        }else{
        	$manageer = new LayoutManager();
        	$this->routes = $manageer->getRoutes($this->role);
        }
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
     * @param string $paramType
     * @return array
     */
    public function getParams($paramType = 'get')
    {

        $params = array();

        if ($paramType === 'slash') {
        	$elements = explode('/', $this->request);
        	unset($elements[0]);
        	
        	for($i = 1; $i<count($elements); $i++)
        	{
        		$params[$elements[$i]] = $elements[$i+1];
        		$i++;
        	}
        }elseif ($_GET){
        	foreach($_GET as $key => $val)
        	{
        		$params[$key] = $val;
        	}
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
       
        if(key_exists($route, $this->routes))
        {
//         	echo "<pre>";
//         	var_dump($this->routes);
        	$params = $this->getParams($this->routes[$route]['param_type']);
        	$params['route'] = $route;
        	
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
            		$controller = new User();
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
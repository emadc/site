<?php

class LayoutManager
{

    private $bdd;

    public function __construct()
    {
        $config = parse_ini_file(__DIR__ . DIRECTORY_SEPARATOR . '../db_config.php', true);
        $this->bdd = new PDO("mysql:host=".$config['sql']['ods']['host']."; dbname=".$config['sql']['ods']['base']."; charset=utf8", $config['sql']['ods']['user'], $config['sql']['ods']['pass']);
    }

    /**
     * Returns an array of MenuItem objects
     * @return ArrayObject MenuItem
     */
    public function getMenu($menuType = 0)
    {
        $bdd = $this->bdd;
        $menu = new ArrayObject();
        
        /*** accès au model ***/
        $query = "SELECT * FROM routes 
                    WHERE 1
                    AND visible = 1 
                    AND menu = :menu 
                    ";
        $req = $bdd->prepare($query);
        $req->bindParam(':menu', $menuType);
        $req->execute();
        
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

			$menuItem = new MenuItem();       	
			$menuItem->setId($row['id']);
			$menuItem->setItemText($row['item_text']);
			if($row['item_link']!=null)
			     $menuItem->setItemLink($row['item_link']);
			else
			    $menuItem->setItemLink(HOST.$row['route']);
			$menuItem->setParent($row['parent']);

            $menu[] = $menuItem; 

        };
        
        return $menu;
    }

    /**
     * Returns an array of routes
     * @return ArrayObject routes
     */
    public function getRoutes()
    {
    	$bdd = $this->bdd;
    	$routes = new ArrayObject();
    	
    	/*** accès au model ***/
    	$query = "SELECT * FROM routes WHERE menu = 0";
    	
    	$req = $bdd->prepare($query);
    	$req->execute();
    	
    	/**
    	 * Array of the available routeses, role and area to manage the accesses
    	 * @var array
    	 */
    	$routes = [
    			""					=> ["controller" => 'Home',  "method" => 'showHome',      "param_type" => 'get',	"area" => 'PUBLIC',	"role" => 'USER'],
    			"404"     			=> ["controller" => 'Home',  "method" => 'notFound',      "param_type" => 'get',	"area" => 'PUBLIC',	"role" => 'USER'],
    			"page"				=> ["controller" => 'Page',  "method" => 'showPage',	  "param_type" => 'get',	"area" => 'PUBLIC',	"role" => 'USER'],
    			"protect"	    	=> ["controller" => 'Page',  "method" => 'showProtected', "param_type" => 'get',	"area" => 'PRIVATE',"role" => 'ADMIN'],
    			"login"		    	=> ["controller" => 'User',  "method" => 'login',		  "param_type" => 'get',	"area" => 'PUBLIC',	"role" => 'USER'],
    			"auth"		    	=> ["controller" => 'User',  "method" => 'checkUser',	  "param_type" => 'get',	"area" => 'PUBLIC',	"role" => 'USER'],
    			"logout"			=> ["controller" => 'User',  "method" => 'logout',		  "param_type" => 'get',	"area" => 'PUBLIC',	"role" => 'USER'],
    	];
    	
    	
    	while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
    		$routes[] = $row['route'];
    		$routes[$row['route']]["controller"]	 = $row['controller'];
    		$routes[$row['route']]["method"]		 = $row['method'];
    		$routes[$row['route']]["param_type"]	 = $row['param_type'];
    		$routes[$row['route']]["area"]			 = $row['area'];
    		$routes[$row['route']]["role"]			 = $row['role'];
    	};
    	
    	$_SESSION['routes'] = $routes;
    	
    	return $routes;
    }
    
    /**
     * Returns a Page objects
     * @param mixed $route
     * @return PageObj
     */
    public function getPage($route)
    {
    	$bdd = $this->bdd;
    	$page = new PageObj();
    	
    	$query = "SELECT *
					FROM routes
					LEFT JOIN pages ON (routes.id=pages.id_routes)
					WHERE route=:route";
    	$req = $bdd->prepare($query);
    	$req->bindParam(':route', $route);
    	$req->execute();
    	
    	$results = $req->fetchAll(PDO::FETCH_ASSOC);
    	
    	if (!empty($results)) {
    		$page->setId($results[0]['id']);
    		$page->setIdSection($results[0]['id_routes']);
    		$page->setTitle($results[0]['title']);
    		
    		$text = $results[0]['text'];
    		$text = preg_replace("/\r|\n/", "<br>", $text);
    		
    		$page->setText($text);
    		$page->setImage($results[0]['image']);
    		$page->setLink($results[0]['link']);
    		$page->setDateModif($results[0]['date_modif']);
    		$page->setItemAlias($results[0]['route']);
    	}
    	

    	
    	return $page;
    }
    
}
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
    public function getMenu()
    {
        $bdd = $this->bdd;
        $menu = new ArrayObject();
        
        /*** accès au model ***/
        $query = "SELECT * FROM sections WHERE menu = 0";

        $req = $bdd->prepare($query);
        $req->execute();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

			$menuItem = new MenuItem();       	
			$menuItem->setId($row['id']);
			$menuItem->setItemText($row['item_text']);
			if($row['item_link']!=null)
			     $menuItem->setItemLink($row['item_link']);
			else
			    $menuItem->setItemLink(HOST."page/id/".$row['item_alias']);
			$menuItem->setParent($row['parent']);

            $menu[] = $menuItem; 

        };
        
        return $menu;
    }

    /**
     * Returns a Page objects
     * @param mixed $item_alias
     * @return PageObj
     */
    public function getPage($item_alias)
    {
    	$bdd = $this->bdd;
    	$page = new PageObj();
    	
    	$query = "SELECT *
					FROM sections
					LEFT JOIN pages ON (sections.id=pages.id_section)
					WHERE item_alias=:item_alias";
    	$req = $bdd->prepare($query);
    	$req->bindParam(':item_alias', $item_alias);
    	$req->execute();
    	
    	$results = $req->fetchAll(PDO::FETCH_ASSOC);
    	
    	if (!empty($results)) {
    		$page->setId($results[0]['id']);
    		$page->setIdSection($results[0]['id_section']);
    		$page->setTitle($results[0]['title']);
    		
    		$text = $results[0]['text'];
    		$text = preg_replace("/\r|\n/", "<br>", $text);
    		
    		$page->setText($text);
    		$page->setImage($results[0]['image']);
    		$page->setLink($results[0]['link']);
    		$page->setDateModif($results[0]['date_modif']);
    		$page->setItemAlias($results[0]['item_alias']);
    	}
    	
    	return $page;
    }
    
}
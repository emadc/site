<?php

/**
 * Class Page
 *
 * use to show the contact page
 */
class Page {
	
	/**
	 * Render of any page associate to a section
	 * @param mixed $params
	 */
	public function showPage($params) {
		$manager = new LayoutManager ();
		
		$view = new View ('page');
		$view->render ( array (
				'menu' => $manager->getMenu (),
				'page' => $manager->getPage ( $params ['route'] ),
				'bottom' => $manager->getPage ( 'bottom' )
		) );
	}
	
	/**
	 * Render of protected area default page
	 *
	 * @param mixed $params
	 */
	public static function showProtected($params) {
	    $view = new View ( 'protected_area', 'protected/' );
	    $view->render ( array (
	        'role' => $_SESSION ['role'],
	    ) );
	}
}
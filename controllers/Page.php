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
		
		$myView = new View ('page');
		$myView->render ( array (
				'menu' => $manager->getMenu (),
				'bottom' => $manager->getPage ( 'bottom' ),
				'page' => $manager->getPage ( $params ['id'] )
		) );
	}
	
}
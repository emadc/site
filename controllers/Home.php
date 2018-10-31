<?php

/**
 * Class Home
 *
 * use to show the home page
 */
class Home
{

    private $manager;

    /**
     */
    public function __construct()
    {
        $this->manager = new LayoutManager();
    }

    /**
     * Render of home page
     *
     * @param mixed $params
     */
    public function showHome($params)
    {
        $manager = new ServicesManager();
        
        $myView = new View('home');
        $myView->render(array(
            'menu' => $this->manager->getMenu(),
            'welcame' => $this->manager->getPage('welcame'),
            'bottom' => $this->manager->getPage('bottom'),
            'services' => $manager->getServices()
        ));
    }

    /**
     * Render of 404 page
     */
    public function notFound()
    {
        $myView = new View('404');
        $myView->render(array(
            'menu' => $this->manager->getMenu(),
            'bottom' => $this->manager->getPage('bottom')
        ));
    }
}
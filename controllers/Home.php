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
        
        $view = new View('home');
        $view->render(array(
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
        $view = new View('404');
        $view->render(array(
            'menu' => $this->manager->getMenu(),
            'bottom' => $this->manager->getPage('bottom')
        ));
    }
}
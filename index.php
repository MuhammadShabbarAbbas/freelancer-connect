<?php
namespace FreelancerConnect;

class FreelancerConnect{
    public function __construct()
    {
        $this->load_requirements();
        $this->boot();
    }
    public function load_requirements(){
        require 'vendor/autoload.php';
        require 'vendor/pecee/simple-router/helpers.php';
        /**
         * require controllers
         */
        require_once 'controllers/auth.php';
        require_once 'controllers/projects.php';
        /**
         * require routes
         */
        /* Load external routes file */
        require_once 'routes/web.php';
    }
    public function boot(){

        /**
         * The default namespace for route-callbacks, so we don't have to specify it each time.
         * Can be overwritten by using the namespace config option on your routes.
         */
//        \Pecee\SimpleRouter\SimpleRouter::setDefaultNamespace('FreelancerConnect\Controllers');
        // Start the routing
        \Pecee\SimpleRouter\SimpleRouter::start();
    }
}

return new FreelancerConnect();
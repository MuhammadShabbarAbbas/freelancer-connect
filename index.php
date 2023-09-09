<?php
namespace FreelancerConnect;

use Dotenv\Dotenv;

class FreelancerConnect{
    public function __construct()
    {
        $this->load_requirements();
        $this->boot();
    }
    public function load_requirements(){
        require_once 'vendor/autoload.php';
        require_once 'vendor/pecee/simple-router/helpers.php';
        require_once 'app/Helpers/FreelancerIdentity.php';
        /**
         * require controllers
         */
        require_once 'app/controllers/auth.php';
        require_once 'app/controllers/projects.php';
        /**
         * require routes
         */
        /* Load external routes file */
        require_once 'app/routes/web.php';
    }
    public function boot(){
        /**
         * The default namespace for route-callbacks, so we don't have to specify it each time.
         * Can be overwritten by using the namespace config option on your routes.
         */
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        \Pecee\SimpleRouter\SimpleRouter::setDefaultNamespace('App\FreelancerConnect\Controllers');
        // Start the routing
        \Pecee\SimpleRouter\SimpleRouter::start();
    }
}

return new FreelancerConnect();
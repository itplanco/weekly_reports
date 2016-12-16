<?php

spl_autoload_register(function($className)
{
    $dir = __DIR__ ;
    require($dir . "/routing/Request.php");
    require($dir . "/routing/Router.php");
    require($dir . "/routing/Route.php");
    require($dir . "/controllers/Controller.php");
    require($dir . "/controllers/AuthorizeController.php");
    require($dir . "/controllers/UsersApiController.php");
    require($dir . "/controllers/ReportsApiController.php");
    require($dir . "/models/Models.php");
    require($dir . "/models/Users.php");
    require($dir . "/models/Reports.php");
    require($dir . "/services/AuthService.php");
    require($dir . "/services/UsersService.php");
    require($dir . "/services/ReportsService.php");
});

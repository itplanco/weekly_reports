<?php

spl_autoload_register(function($className)
{
    $dir = __DIR__ ;
    require_once($dir . "/routing/Request.php");
    require_once($dir . "/routing/Router.php");
    require_once($dir . "/routing/Route.php");
    require_once($dir . "/controllers/Controller.php");
    require_once($dir . "/controllers/AuthorizeController.php");
    require_once($dir . "/controllers/ReportCommentsApiController.php");
    require_once($dir . "/controllers/ReportsApiController.php");
    require_once($dir . "/controllers/ReportsByUserApiController.php");
    require_once($dir . "/controllers/UsersApiController.php");
    require_once($dir . "/controllers/WeeklyReportsApiController.php");
    require_once($dir . "/models/Models.php");
    require_once($dir . "/models/Users.php");
    require_once($dir . "/models/Reports.php");
    require_once($dir . "/models/Week.php");
    require_once($dir . "/services/AuthService.php");
});

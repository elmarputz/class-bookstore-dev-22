<?php

use Bookshop\AuthenticationManager;
use Bookshop\Util;


if (AuthenticationManager::isAuthenticated()) {
    Util::redirect("index.php");
}


$userName = $_REQUEST[Bookshop\Controller::USER_NAME] ?? null; 
?>

<?php
require_once('views/partials/header.php');
?>


    <div class="page-header">
        <h2>Login</h2>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Please fill out the form below:
        </div>
        <div class="panel-body">

            <form class="form-horizontal" method="post" action="<?php echo Util::action(Bookshop\Controller::ACTION_LOGIN, array('view' => $view)); ?>">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">User name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="inputName" name="<?php print Bookshop\Controller::USER_NAME; ?>" placeholder="try 'scm4'" value="<?php echo htmlentities($userName ?? ''); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="inputPassword" name="<?php print Bookshop\Controller::USER_PASSWORD; ?>" placeholder="try 'scm4'">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" class="btn btn-default">Login</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

<?php
require_once('views/partials/footer.php');

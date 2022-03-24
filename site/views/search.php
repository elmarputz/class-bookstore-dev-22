<?php 

use Data\DataManager;
use Bookshop\Util;

$title = $_REQUEST['title'] ?? '';
$books = isset($title) ? DataManager::getBooksForSearchCriteria($title) : null; 

require_once('views/partials/header.php'); ?>


<div class="page-header">
 <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
    <input type="hidden" name="view" value="<?php echo $view; ?>" />
    <div class="input-group">
        <input type="text" class="form-control" id="title" name="title" placeholder="Seach books by title... " 
            value="<?php echo Util::escape($title); ?>">
        <div class="input-group-btn">
            <button type="submit" class="btn btn-default">Search</button>
        </div>
    </div>
</form>


</div>

<?php if (isset($books)) { 
    if (sizeof($books) > 0) {
        require('views/partials/booklist.php');
    } else { ?>
    <div class="alert alert-warning" role="alert">No books found.</div>
    <?php } ?>
<?php } else { // if (isset($books)) ?>    
    <div class="alert alert-info" role="alert">Please select a category</div>
<?php } ?>    
<?php require_once('views/partials/footer.php'); ?>

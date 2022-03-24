<?php 

use Data\DataManager;
use Bookshop\Util;

$categories = DataManager::getCategories();
$categoryId = (int)($_REQUEST['categoryId'] ?? null);
$books = (isset($categoryId) && ($categoryId > 0)) ? DataManager::getBooksByCategory($categoryId) : null;

require_once('views/partials/header.php'); ?>


<div class="page-header">
    <h2>List of books by category</2>
</div>

<ul class="nav nav-tabs">
    <?php foreach ($categories as $cat) { ?>
        <li role="presenation" 
         <?php if ($cat->getId() === $categoryId) { ?> 
            class="active" 
        <?php } ?>>
        <a href="<?php echo $_SERVER['PHP_SELF'] ?>?view=list&categoryId=<?php echo $cat->getId(); ?>"><?php echo Util::escape($cat->getName()); ?></a></li>
    <?php } // end foreach ?>    
</ul>

<?php if (isset($books)) { 
    if (sizeof($books) > 0) {
        require('views/partials/booklist.php');
    } else { ?>
    <div class="alert alert-warning" role="alert">No books in this category.</div>
    <?php } ?>
<?php } else { // if (isset($books)) ?>    
    <div class="alert alert-info" role="alert">Please select a category</div>
<?php } ?>    
<?php require_once('views/partials/footer.php'); ?>

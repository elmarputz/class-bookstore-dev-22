<?php 

$orderId = $_REQUEST['orderId'] ?? null;

require_once('views/partials/header.php');
?>

<div class="page-header">
    <h2>Success</h2>
</div>

<?php if ($orderId != null) { ?>
<p>your oder number: <?php echo Bookshop\Util::escape($orderId); ?>

<?php } ?>


<?php require_once('views/partials/footer.php'); ?>
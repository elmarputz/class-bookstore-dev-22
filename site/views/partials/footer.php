<?php
use Bookshop\Util;
if (isset($errors) && is_array($errors)) { ?>

    <div class="errors alert alert-danger">
        <ul>
            <?php foreach ($errors as $errMsg) { ?>
                <li><?php echo (Util::escape($errMsg)); ?></li>
            <?php } ?>
        </ul>
    </div>

<?php } ?>


<div class="footer">

    <div class="col-sm-8">
    <button class="btn btn-primary btn-xs" type="button">
       <span class="badge"><?php echo Bookshop\Util::escape($cartSize); ?></span> items in cart 
    </button>
    </div>
    <div class="col-sm-4 pull-right">
    <p><?php echo date('d.m.Y H:i', time()); ?></p>
    </div>

</div>

</div> <!-- container -->

<script src="assets/jquery-1.11.2.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
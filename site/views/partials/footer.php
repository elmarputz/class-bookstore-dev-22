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
    links
    </div>
    <div class="col-sm-4 pull-right">
    rechts
    </div>

</div>

</div> <!-- container -->

<script src="assets/jquery-1.11.2.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
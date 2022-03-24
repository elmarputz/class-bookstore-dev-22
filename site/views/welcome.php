<?php require_once('views/partials/header.php'); ?>


<div class="page-header">
    <h2>Welcome to Bookshop</h2>
</div>

<p>
    lsdkjf lasdfj asdlfj sadfasdlfkjasdflkjl
</p>

<?php require_once('views/partials/footer.php');

$book = new \Bookshop\Book(1, 1,"asdlfkjasl","alkdjflasdkj", 10);
var_dump($book);
echo $book->getId();

$category = new \Bookshop\Category(1, "Testkategorie");
var_dump($category);

$user = new \Bookshop\User(1, "fritz", "alksdjfl2323");
var_dump($user);


?>
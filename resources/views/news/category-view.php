<?php

/* @var $news array */

include '../resources/views/nav.php';

?>

<?php foreach ($news as $item): ?>
    <li><a href="<?= route('news.view', $item['id']) ?>"><?= $item['title'] ?></a></li>
<?php endforeach; ?>

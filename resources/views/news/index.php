<?php

/* @var $news array */
/* @var $categories array */

include '../resources/views/nav.php';

?>

<h2>Категории новостей</h2>

<?php foreach ($categories as $item): ?>
    <li><a href="<?= route('news.category.view', $item['url']) ?>"><?= $item['title'] ?></a></li>
<?php endforeach; ?>

<h2>Все новости</h2>

<?php foreach ($news as $item): ?>
    <li><a href="<?= route('news.view', $item['id']) ?>"><?= $item['title'] ?></a></li>
<?php endforeach; ?>

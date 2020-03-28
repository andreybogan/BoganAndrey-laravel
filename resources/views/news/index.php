<?php

/* @var $news array */

include '../resources/views/nav.php';

?>

<h2>Все новости!</h2>

<?php foreach ($news as $item): ?>
    <li><a href="<?= route('NewsView', $item['id']) ?>"><?= $item['title'] ?></a></li>
<?php endforeach; ?>

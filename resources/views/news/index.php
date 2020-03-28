<?php

/* @var $news array */

include '../resources/views/nav.php';

$oldArr = [
    [
        'id' => 3,
        'name' => 'name_3',
    ],
    [
        'id' => 7,
        'name' => 'name_7',
    ],
];



//var_dump($news);
?>

<h2>Все новости!</h2>

<?php foreach ($news as $item): ?>
<li><a href="<?= route('NewsView', $item['id']) ?>"></a><?= $item['title'] ?></li>
<?php endforeach; ?>

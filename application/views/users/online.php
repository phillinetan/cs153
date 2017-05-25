<h2><?php echo $title; ?></h2>
<ul>
<?php foreach ($users as $user_item): ?>
<li><?php echo $user_item->username; ?></li>

<?php endforeach; ?>
</ul>

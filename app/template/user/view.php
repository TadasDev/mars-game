<?php
$user = $data['user'];
?>
<div class="content-white">
<h2>
    <?php echo $user->getUserName(); ?>
</h2>
<ul>
    <?php foreach ($user->getFields() as $field): ?>
        <li><?php echo 'City: '.$field->getCity()->getName(). 'x: '.$field->getX().' y: '.$field->getY() ?></li>
    <?php endforeach; ?>
</ul>
</div>
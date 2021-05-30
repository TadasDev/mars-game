<?php
$user = $data['user'];
?>
<div class="content-white">
<h2>
    <?php echo $user->getUserName(); ?>
</h2>
    <a style="color:black" href=<?php echo BASE_URL. '/messages/index/'. strtolower($user->getUserName()) .'/'.$user->getId() ?> > Send message </a>
<ul>
    <?php foreach ($user->getFields() as $field): ?>
        <li> <?php echo $field->getCity()->getName() ?> </li>
         <li> <?php echo ' x: '.$field->getX().' y: '.$field->getY() ?> </li>
    <?php endforeach; ?>
</ul>
</div>
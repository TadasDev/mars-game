<ol>
<?php foreach ($data['users'] as $user): ?>
    <li>
        <a href="<?php echo BASE_URL.'/user/view/'.$user->getId(); ?> ">
            <?php echo $user->getUserName() ?>
        </a>
    </li>
<?php endforeach; ?>
</ol>

<ol>
<?php foreach ($data['users'] as $user): ?>
    <li>
        <a href="<?php echo BASE_URL.'/user/view/'.$user['id']; ?> ">
            <?php echo $user['name'] ?>
        </a>
    </li>
<?php endforeach; ?>
</ol>

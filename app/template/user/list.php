<div class="city-wrapper"

<ul style="text-align: center">
<?php foreach ($data['users'] as $user): ?>

    <li style="list-style-type: decimal-leading-zero">

        <a style="color: white" href = <?php echo BASE_URL.'/user/view/'.$user->getId();?> >
            <?php echo $user->getUserName() ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>
</div>

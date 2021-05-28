<?php
$dukArray = $data['duk'];
//echo '<pre>';
//print_r($dukArray);
//die();
?>

<div class="city-wrapper">
    <?php foreach ($dukArray as $collumn): ?>
        <ul>

            <li style="list-style-type:none"> <h3> <?php echo $collumn['questions'] ?> </h3> </li>
            <li style="list-style-type:none"> <?php echo $collumn['answers'] ?> </li>
        </ul>
    <?php endforeach?>

</div>
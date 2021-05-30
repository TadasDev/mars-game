<style>
    .inbox{
        height: 400px;
        width: 50%;
        background: snow;
        margin: 0 auto;

    }
    .city-wrapper{
        align-content: center;

    }
    .inbox-header{
        border-bottom: 2px solid black;
        padding: 10px;
        text-align: center;
    }
    .messages-container li{
        display: flex;
        justify-content: space-between;
        margin: 20px;
    }


</style>
<?php
   $message = $data['messages'];
 ?>

<div class="city-wrapper">
    <div class="inbox">
        <div class="inbox-header">
            <h4> Inbox </h4></div>
                 <div class="messages-container">
                        <?php foreach ($message as $item): ?>
                             <li style="list-style-type: none">
                                <?php echo $item['message'] ?>
                             </li>
                        <?php endforeach; ?>
        </div>


    </div>


</div>

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
        margin: 10px;
    }
    .header-content{
        display: flex;
        justify-content: space-between;
    }
    .header-content p{

    }
</style>
<?php  $messages = $data['data']; ?>

<div class="city-wrapper">
    <div class="inbox">
           <div class="inbox-header">
               <h3> Inbox </h3>
                    <div class="header-content">
                        <p> Subject</p>
                        <p> Date </p>

               </div>
           </div>
                    <div class="messages-container">
                        <?php foreach ($messages as $message): ?>
                            <li style="list-style-type: none">
                                <a href = <?php echo BASE_URL.'/messages/received/'. $message['id'];?> >
                                <?php echo $message['subject'] . "</a>" . $message['date']?>
                            </li>
                        <?php endforeach; ?>
                    </div>


    </div>


</div>



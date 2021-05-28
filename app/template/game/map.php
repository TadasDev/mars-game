<?php
/*
 *
 *  Cia generuojamas mapas
 *
 *
 */

?>
<?php $fields = $data['fields'] ?>
<div class="world">
    <div class="map">
        <?php for ($y = 1; $y <= 30; $y++): ?>
            <div class="y-row">
                <?php for ($x = 1; $x <= 30; $x++): ?>
                    <?php $class = ''; ?>
                    <?php if (isset($fields[$y][$x])): ?>
                        <?php $class = $fields[$y][$x]['class']; ?>
                        <?php if($fields[$y][$x]['user_id'] == $data['user_id']): ?>
                            <?php $class .= ' current-user-field'; ?>
                        <?php endif;?>
                        <a href="<?php echo $fields[$y][$x]['link'] ?>">
                            <div class="field <?php echo 'x' . $x . 'y' . $y ?> <?php echo $class; ?>">
                                <div class="info-box">
                                    <b><?php echo $fields[$y][$x]['field_name']; ?></b>
                                    <?php if(isset($fields[$y][$x]['owner'])): ?>
                                        <?php echo $fields[$y][$x]['owner']->getUserName(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>

                    <?php else: ?>
                        <div class="field <?php echo 'x' . $x . 'y' . $y ?>">

                        </div>
                    <?php endif; ?>

                <?php endfor; ?>
            </div>
        <?php endfor; ?>
    </div>
</div>
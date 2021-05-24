<?php

//use Model\ModelAbstract;
//use Model\City;
//
//$mapField = new \Model\MapField();
//
//$mapField->getFieldName();
//
//echo $mapField;

$fields = $this->data['fields'] ?>

<div class="world">
    <div class="map">
        <?php for ($y = 1; $y <= 30; $y++): ?>
            <div class="y-row">
                <?php for ($x = 1; $x <= 30; $x++): ?>
                    <?php $class = ''; ?>
                    <?php if (isset($fields[$y][$x])): ?>
                        <?php $class = $fields[$y][$x]['class']; ?>
                        <a href="<?php echo $fields[$y][$x]['link'] ?>">
                            <div class="field <?php echo 'x' . $x . 'y' . $y ?> <?php echo $class; ?>">

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
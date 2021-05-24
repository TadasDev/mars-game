<?php $city = $data['city']; ?>
<div class="city-wrapper">
    <div class="city-base">
        <?php foreach ($data['buildings'] as $key => $building): ?>
            <div class="column">
                <?php if($building !== ''): ?>
                    <div class="building type-<?php echo $building->getBuildinTypeId();?>">
                    <?php echo $building->getLevel(); ?>
                    <?php echo $building->getName(); ?>
                    </div>
                <?php else: ?>
                   <a href="<?php echo BASE_URL ?>/city/build/<?php echo $city->getId()?>?position=<?php echo $key ?>" class="add-building">
                       +
                   </a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>


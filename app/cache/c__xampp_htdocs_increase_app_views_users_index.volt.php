<?php foreach ($users as $user) { ?>
    <?php echo $user->getMail(); ?> - <?php echo $user->getIdentite(); ?><br/>

<?php } ?>
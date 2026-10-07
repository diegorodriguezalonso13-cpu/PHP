<?php
if ($nota < 5) : ?>
        <div class='alert alert-danger'>  <?php echo $nota ?>, Suspenso  </div>
    <?php
elseif (6 > $nota && $nota >= 5) : ?>
        <div class='alert alert-warning'> <?php echo $nota ?>, Aprobado </div>
        <?php
elseif (7 > $nota && $nota >= 6) : ?>
        <div class='alert alert-info'> <?php echo $nota ?>, Bien </div>
        <?php
elseif (8.75 > $nota && $nota >= 7) : ?>
        <div class='alert alert-info'> <?php echo $nota ?>, Notable </div>
        <?php
elseif (10 > $nota && $nota >= 8.75) : ?>
        <div class='alert alert-success'> <?php echo $nota ?>, Sobresaliente </div>
        <?php
endif;
?>
<div class="alert alert-success">
    <?php
    if ($x > $y && $x > $z) {
        echo "Tenemos el <strong>$x</strong>  el  $y  y el  $z ";
    } elseif ($y > $z && $y > $x) {
        echo "Tenemos el $x  el  <strong>$y</strong> y el  $z ";
    } else {
        echo "Tenemos el $x  el  $y  y el  <strong>$z</strong> ";
    }
    ?>
</div>

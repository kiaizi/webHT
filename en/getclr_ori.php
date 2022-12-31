<style>
  
</style>

<?php $ho = $_GET['p']; $de = $_GET['date']; ?>

<?php if ($ho != 'h') { ?>

<?php if ($de=='_'.'2020_11_2') { ?>
            <div class="color_box_1"></div>
            <div class="color_box_3"></div>
<?php } ?>
<?php if ($de=='_'.'2020_11_6') { ?>
            <div class="color_box_2"></div>
<?php } ?>
<?php if ($de=='_'.'2020_11_9') { ?>
            <div class="color_box_2"></div>
<?php } ?>
<?php if ($de=='_'.'2021_2_1') { ?>
            <div class="color_box_1"></div>
            <div class="color_box_2"></div>
            <div class="color_box_3"></div>
<?php } ?>

<?php }else{ ?>

<?php if ($de=='_'.'2021_2_1') { ?>
            <div class="color_box_4"></div>
<?php } ?>

<?php } ?>





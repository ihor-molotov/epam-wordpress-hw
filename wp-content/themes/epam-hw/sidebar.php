<?php
if (!is_active_sidebar('primary_sidebar')) {
  return;
}
?>

<div class="col-lg-4">
  <div class="sidebar">
    <div class="row">
      <?php dynamic_sidebar('primary_sidebar'); ?>
    </div>
  </div>
</div>
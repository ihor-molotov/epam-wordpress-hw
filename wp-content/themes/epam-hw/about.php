<?php
/* Template Name: About Us */
get_header(); ?>

<div class="heading-page header-text">
  <section class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="text-content">
            <?php the_title('<h4>', '</h4>') ?>
            <h2><?php _e('More About Us', 'epam_hw') ?></h2>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
$content = get_the_content();
if ($content) { ?>
  <section class="about-us">
    <div class="container">
      <?php echo $content; ?>
    </div>
  </section>
<?php } ?>


<?php get_footer(); ?>
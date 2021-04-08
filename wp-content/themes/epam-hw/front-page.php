<?php get_header();
$posts_per_page = 3;

$args = array(
  'post_type' => 'post',
  'orderby'   => 'rand'
);
$post_query = new WP_Query($args);
if ($post_query->have_posts()) :
?>
  <div class="main-banner header-text">
    <div class="container-fluid">
      <div class="owl-banner owl-carousel">
        <?php while ($post_query->have_posts()) : $post_query->the_post(); ?>
          <div class="item">
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <?php
                  $category = get_the_category(get_the_ID());
                  if ($category) {
                    foreach ($category as $category_item) {
                      echo "<span>$category_item->name</span>";
                    }
                  }
                  ?>
                </div>
                <a href="<?php the_permalink(); ?>">
                  <h4><?php the_title(); ?></h4>
                </a>
                <ul class="post-info">
                  <li><a href="#"><?php the_author(); ?></a></li>
                  <li><a href="#"><?php the_date(); ?></a></li>
                  <?php $comments_count = get_comments_number(get_the_ID()); ?>
                  <li><a href="#"><?php echo $comments_count; ?> Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else :
      echo '<p>Nothing found :( </p>';
      ?>
      <?php wp_reset_postdata();
    endif; ?>
      </div>
    </div>
  </div>

  <?php get_template_part('template-parts/call-to-action');

  $args = array(
    'post_type' => 'post',
    'posts_per_page'  => $posts_per_page,
    'orderby' => 'DESC'

  );

  $recent_query = new WP_Query($args);
  if ($recent_query->have_posts()) : ?>
    <section class="blog-posts">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                <?php while ($recent_query->have_posts()) : $recent_query->the_post(); ?>
                  <div class="col-lg-12">
                    <div class="blog-post">
                      <div class="blog-thumb">
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                      </div>
                      <?php
                      $category = get_the_category(get_the_ID());
                      ?>
                      <div class="down-content">
                        <?php if ($category) {
                          foreach ($category as $category_item) {
                            echo "<span>$category_item->name</span>";
                          }
                        }
                        ?>
                        <a href="<?php the_permalink(); ?>">
                          <?php the_title('<h4>', '</h4>'); ?>
                        </a>
                        <ul class="post-info">
                          <li><a href="#"><?php the_author(); ?></a></li>
                          <li><a href="#"><?php the_date('d,m,Y'); ?></a></li>
                          <?php
                          $comments_count = get_comments_number(get_the_ID()); ?>
                          <li><a href="#"><?php echo $comments_count; ?> Comments</a></li>
                        </ul>
                        <p><?php the_excerpt(); ?></p>
                        <div class="post-options">
                          <div class="row">
                            <?php
                            $post_tags = get_the_tags();
                            if ($post_tags) : ?>
                              <div class="col-6">
                                <ul class="post-tags">
                                  <?php for ($i = 0; $i < count($post_tags); $i++) :
                                    echo '<li><a href="' . get_home_url() . '/tag/' . $post_tags[$i]->name . '">' . $post_tags[$i]->name . '</a>';
                                    if ($i != count($post_tags) - 1) echo ',';
                                    echo '</li> ';
                                  endfor; ?>
                                </ul>
                              </div>
                            <?php endif; ?>
                            <div class="col-6">
                              <ul class="post-share">
                                <li><i class="fa fa-share-alt"></i></li>
                                <li><a href="#">Facebook</a>,</li>
                                <li><a href="#"> Twitter</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              <?php else :
              echo '<p>Nothing found :( </p>';
              ?>
              <?php wp_reset_postdata();
            endif; ?>
              <div class="col-lg-12" class="load_more">
                <div class="main-button">
                  <a class="loadmore_btn" href="/"><?php _e('View All Posts', 'epam_hw'); ?></a>
                </div>
              </div>
              </div>
            </div>
          </div>
          <?php get_sidebar(); ?>
        </div>
      </div>
    </section>
    <?php get_footer(); ?>
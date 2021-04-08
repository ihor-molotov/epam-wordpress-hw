<?php
get_header();
$posts_per_page = 2;
?>
<div class="heading-page header-text">
  <section class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="text-content">
            <h4><?php _e('RECENT POSTS'); ?></h4>
            <h2> <?php the_title(); ?></h2>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php get_template_part('template-part/call-to-action'); ?>

<section class="blog-posts grid-system">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <?php
        $args = array(
          'posts_per_page'  => $posts_per_page,
        );
        if (!empty($_GET['paged'])) {
          $offset = ($_GET['paged'] - 1) * $posts_per_page;
          $args += ['offset' => $offset];
        }
        $query = new WP_Query($args);
        if ($query->have_posts()) : ?>
          <div class="all-blog-posts">
            <div class="row">
              <?php while ($query->have_posts()) :
                $query->the_post(); ?>
                <div class="col-lg-6">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                    </div>
                    <div class="down-content">
                      <?php
                      $category = get_the_category(get_the_ID());
                      if ($category) {
                        foreach ($category as $category_item) {
                          echo "<span>$category_item->name</span>";
                        }
                      }
                      ?>
                      <a href="<?php the_permalink(); ?>">
                        <h4><?php the_title(); ?></h4>
                      </a>
                      <ul class="post-info">
                        <li><a href="#"><?php the_author(); ?></a></li>
                        <li><a href="#"><?php the_date(); ?></a></li>
                        <?php
                        $comments_count = get_comments_number(get_the_ID()); ?>
                        <li><a href="#"><?php echo $comments_count; ?> Comments</a></li>
                      </ul>
                      <p> <?php the_excerpt(); ?></p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-lg-12">
                            <ul class="post-tags">
                              <?php for ($i = 0; $i < count($post_tags); $i++) :
                                echo '<li><a href="' . get_home_url() . '/tag/' . $post_tags[$i]->name . '">' . $post_tags[$i]->name . '</a>';
                                if ($i != count($post_tags) - 1) echo ',';
                                echo '</li> ';
                              endfor; ?>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
              <div class="col-lg-12">
                <?php
                echo paginate_links(array(
                  'total'        => $query->max_num_pages,
                  'current'      => max(1, get_query_var('paged')),
                  'format'       => '?paged=%#%',
                  'show_all'     => false,
                  'type'         => 'list',
                  'end_size'     => 0,
                  'mid_size'     => 2,
                  'prev_next'    => true,
                  'prev_text'    => sprintf('<i class="fa fa-angle-double-left"></i>', __('Newer Posts', 'text-domain')),
                  'next_text'    => sprintf('<i class="fa fa-angle-double-right"></i>', __('Older Posts', 'text-domain')),
                  'add_args'     => false,
                  'add_fragment' => '',
                ));
                ?>
              </div>
            </div>
          </div>
        <?php else :
          get_template_part('template-parts/no-posts');
        endif; ?>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </div>
</section>
<?php
get_footer();

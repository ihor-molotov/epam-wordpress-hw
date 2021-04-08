<?php
get_header();
?>
<div class="heading-page header-text">
  <section class="page-heading">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="text-content">
            <h4><?php _e('Post Details', 'epam_hw'); ?></h4>
            <h2><?php the_title(); ?></h2>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<section class="blog-posts grid-system">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="all-blog-posts">
              <div class="row">
                <div class="col-lg-12">
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
                        <li><a href="#"><?php echo  get_the_date('M d, Y'); ?></a></li>
                        <?php $comments_count = get_comments_number(get_the_ID()); ?>
                        <li><a href="#"><?php echo $comments_count; ?> Comments</a></li>
                      </ul>
                      <?php the_content(); ?>
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
                <div class="col-lg-12">
                  <?php
                  $args = array(
                    'post_id' => get_the_ID(),
                    'status'  => 'approve'
                  );
                  $post_comments = get_comments($args);
                  if ($post_comments) {
                  ?>
                    <div class="sidebar-item comments">
                      <div class="sidebar-heading">

                        <h2><?php echo $comments_count . ' comments'; ?></h2>
                      </div>
                      <div class="content">
                        <ul>
                          <?php foreach ($post_comments as $comment) { ?>
                            <li>
                              <div class="author-thumb">
                                <?php
                                $avatar_url = get_avatar_url($comment->author_email, array(
                                  'size' => 48,
                                  'default' => 'wavatar',
                                ));
                                ?>
                                <img src="<?php echo $avatar_url; ?>" alt="">
                              </div>
                              <div class="right-content">
                                <h4><?php echo $comment->comment_author; ?><span><?php echo get_comment_date('M d, Y'); ?></span></h4>
                                <p><?php echo $comment->comment_content; ?></p>
                              </div>
                            </li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item submit-comment">
                    <div class="sidebar-heading">
                      <h2><?php _e('Your comment', 'epam_hw'); ?></h2>
                    </div>
                    <div class="content">
                      <form id="comment" action="#" method="post">
                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <fieldset>
                              <input name="name" type="text" id="name" placeholder="Your name" required="">
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <fieldset>
                              <input name="email" type="text" id="email" placeholder="Your email" required="">
                            </fieldset>
                          </div>
                          <div class="col-lg-12">
                            <fieldset>
                              <textarea name="message" rows="6" id="message" placeholder="Type your comment" required=""></textarea>
                            </fieldset>
                          </div>
                          <div class="col-lg-12">
                            <fieldset>
                              <button type="submit" id="form-submit" class="main-button"><?php _e('Submit', 'epam_hw'); ?></button>
                              <p class="success" style="display:none;color:green"><?php _e('You comment send on moderation', 'epam_hw'); ?></p>
                            </fieldset>
                          </div>
                          <input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php endwhile;
        endif; ?>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </div>
</section>

<?php get_template_part('template-parts/call-to-action'); ?>

<?php
get_footer();

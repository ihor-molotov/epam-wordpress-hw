<?php
if (!defined('_S_VERSION')) {
  // Replace the version number of the theme on each release.
  define('_S_VERSION', '1.0.0');
}

if (!function_exists('epam_hw_setup')) :
  function epam_hw_setup()
  {
    load_theme_textdomain('epam_hw', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(
      array(
        'menu' => esc_html__('Primary', 'epam_hw'),
      )
    );
  }
endif;
add_action('after_setup_theme', 'epam_hw_setup');

function epam_hw_theme_scripts()
{
  wp_enqueue_style(
    'bootstrap',
    get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css'
  );

  wp_enqueue_style(
    'fontawesome',
    get_template_directory_uri() . '/assets/css/fontawesome.css'
  );

  wp_enqueue_style(
    'templatemo-stand-blog',
    get_template_directory_uri() . '/assets/css/templatemo-stand-blog.css'
  );

  wp_enqueue_style(
    'owl',
    get_template_directory_uri() . '/assets/css/owl.css'
  );

  wp_enqueue_style(
    'flex-slider',
    get_template_directory_uri() . '/assets/css/flex-slider.css'
  );


  wp_enqueue_script(
    'bootstrap-script',
    get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle.min.js',
    array('jquery'),
    _S_VERSION,
    true
  );

  wp_enqueue_script(
    'custom',
    get_template_directory_uri() . '/assets/js/custom.js',
    array('jquery'),
    _S_VERSION,
    true
  );

  wp_enqueue_script(
    'owl',
    get_template_directory_uri() . '/assets/js/owl.js',
    array('jquery'),
    _S_VERSION,
    true
  );

  wp_enqueue_script(
    'slick',
    get_template_directory_uri() . '/assets/js/slick.js',
    array('jquery'),
    _S_VERSION,
    true
  );

  wp_enqueue_script(
    'isotope',
    get_template_directory_uri() . '/assets/js/isotope.js',
    array('jquery'),
    _S_VERSION,
    true
  );

  wp_enqueue_script(
    'accordions',
    get_template_directory_uri() . '/assets/js/accordions.js',
    array('jquery'),
    _S_VERSION,
    true
  );

  wp_register_script(
    'ajax_loadmore',
    get_stylesheet_directory_uri() . '/assets/js/ajax_loadmore.js',
    array('jquery')
  );
  wp_localize_script(
    'ajax_loadmore',
    'ajax_params',
    array(
      'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php'
    )
  );

  wp_enqueue_script('ajax_loadmore');
}
add_action('wp_enqueue_scripts', 'epam_hw_theme_scripts');


function add_sidebar()
{
  register_sidebar(
    array(
      'name'          => esc_html__('Primary Sidebar', 'epam_hw'),
      'id'            => 'primary_sidebar',
      'description'   => esc_html__('Add widgets here.', 'deepam_hw'),
      'before_widget' => '<div class="col-lg-12"><div id="%1$s" class="sidebar-item %2$s">',
      'after_widget'  => '</div></div>',
      'before_title'  => '<div class="sidebar-heading"><h2 class="widget-title">',
      'after_title'   => '</h2></div>',
    )
  );
}
add_action('widgets_init', 'add_sidebar');


/**
 * Add comment
 */
add_action('wp_ajax_add_comment', 'add_comment');
add_action('wp_ajax_nopriv_add_comment', 'add_comment');
function add_comment()
{
  $data = [
    'comment_post_ID'      => 1,
    'comment_author'       => $_POST['username'],
    'comment_author_email' => $_POST['email'],
    'comment_content'      => $_POST['comment_text'],
    'comment_type'         => 'comment',
    'comment_post_ID'      => $_POST['post_id'],
    'comment_date'         => null,
    'comment_approved'     => 0,
  ];

  wp_insert_comment(wp_slash($data));
  echo 'success';
  wp_die();
}

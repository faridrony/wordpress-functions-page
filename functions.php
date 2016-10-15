<?php


function zboom_support(){

add_theme_support('title-tag');

add_theme_support('custom-header');
add_theme_support('custom-background');
add_theme_support('post-thumbnails');
add_image_size('small-thumbnail',800,200,true);
add_image_size('banner-thumbnail',2000,800,true);


/*:::::::::
the_post_thumbnail('small-thumbnail', array());
::::::::*/



/* menu */

register_nav_menu('primary-menu','Main Menu');
/*:::::
wp_nav_menu(
	array(
		'theme-location'=>'primary-menu'
		)
	);
:::::::::*/


	function readmore($words){
		$content= get_the_content();
		$array=explode(" ",$content);
		$part=array_slice($array, 0 ,$words)  ;
		echo implode( " ", $part);
	}


/********** slider *****************/
$slider=array(
	'name'=>'SLIDE',
	'add_new_item'=>'add new slide'
	);
register_post_type('slider',
	array(
	'labels'=>$slider,
	'public'=>true,
	'supports'=>array('title','thumbnail')

	));

/*::::::
$arg=array(
		'post_type'=>'slider',
		'posts_per_page'=>1
		);
	$slider=new WP_Query($arg);
	
	while($slider->have_posts()):$slider->the_post();

::::::::::*/

/********** blocks *****************/

$block=array(
	'name'=>'BLOCKS',
	'add_new_item'=>"Add New Blocks"
	);
register_post_type('blocks',
	array(
		'labels'=>$block,
		'public'=>true,
		'supports'=>array('title','editor')
		));



/********** gallery *****************/

$gallery=array(
	'name'=>'GALLERY',
	'add_new_item'=>"Add New gallery"
	);
register_post_type('gallery',
	array(
		'labels'=>$gallery,
		'public'=>true,
		'supports'=>array('title','thumbnail')
		));

}
add_action("after_setup_theme","zboom_support");





function zboom_sidebar(){

	register_sidebar(
		array(
			'name'=>'Right Sidebar',
			'description'=>'This option is for right Sidebar',
			'id'=>'right-sidebar',
			'before_widget'=>'<div class="box">',
			'after_widget'=>'</div></div>',
			'before_title'=>'<div class="heading"><h2>', 
			'after_title'=>'</h2></div><div class="content">',
			)
		);
/*::::::
dynamic_sidebar('right-sidebar');
get_sidebar();
:::::*/

	register_sidebar(
		array(
			'name'=>'Contact Sidebar',
			'description'=>'This option is for Contact Sidebar',
			'id'=>'contact-sidebar',
			'before_widget'=>'<div class="box">',
			'after_widget'=>'</div></div>',
			'before_title'=>'<div class="heading"><h2>', 
			'after_title'=>'</h2></div><div class="content">',
			)
		);

	register_sidebar(
		array(
			'name'=>'footer widgets',
			'description'=>'This option is for Footer',
			'id'=>'footer-widgets',
			'before_widget'=>'<div class="col-1-4"><div class="wrap-col"><div class="box">',
			'after_widget'=>'</div></div></div></div>',

			'before_title'=>'<div class="heading"><h2>', 
			'after_title'=>'</h2></div><div class="content">',
			)
		);

}
add_action('widgets_init','zboom_sidebar');

/*:::::
the_posts_pagination(
	array(
		'screen_reader_text'=>'',
		'prev_text'=>"prev",
		'next_text'=>"next",
	)); 
:::::*/









/**
 * Enqueue scripts and styles.
 */
function zboom_scripts() {
	/**** css file *****/
	wp_enqueue_style( 'zerogrid', get_template_directory_uri() . '/css/zerogrid.css');
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	

	/**** js file *****/
	wp_enqueue_script( 'jquery',  get_template_directory_uri() . '/js/jquery.min.js', array(), '', FALSE );
	wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/assets/js/jquery-ui-1.10.4.min.js', array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'zboom_scripts' );
<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class ElementorCreateElement {

	private static $instance = null;

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function init(){
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
	}

	private function widget_register($widgetPath) {
		$widget_file = get_template_directory() . $widgetPath;
		$template_file = locate_template($widget_file);
		if ( !$template_file || !is_readable( $template_file ) ) {
			$template_file = get_template_directory() . $widgetPath;
		}
		if ( $template_file && is_readable( $template_file ) ) {
			require_once $template_file;
		}
	}

	public function widgets_registered() {
		if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){
			$this->widget_register('/elementor-ext/widgets/class-widget-custom-post-layout.php');
			$this->widget_register('/elementor-ext/widgets/class-widget-tt-team-member.php');
			$this->widget_register('/elementor-ext/widgets/class-widget-tt-testimonials.php');
			$this->widget_register('/elementor-ext/widgets/class-widget-tt-progress-bar.php');
			$this->widget_register('/elementor-ext/widgets/class-widget-tt-circle-bar.php');
		}
	}
}
	ElementorCreateElement::get_instance()->init();

	add_action( 'wp_enqueue_scripts', 'custom_posts_enqueue_scripts' );
	function custom_posts_enqueue_scripts() {
		//Styles
		wp_enqueue_style( 'owl-carousel-min-css', CHILD_URL.'/elementor-ext/widgets/css/owl.carousel.min.css' );
		wp_enqueue_style( 'custom-posts-layout-css', CHILD_URL.'/elementor-ext/widgets/css/custom-posts-layout.css' );
		wp_enqueue_style( 'tt-team-member-css', CHILD_URL.'/elementor-ext/widgets/css/tt-team-member.css' );
		wp_enqueue_style( 'tt-testimonials-css', CHILD_URL.'/elementor-ext/widgets/css/tt-testimonials.css' );
		wp_enqueue_style( 'tt-progress-bar-css', CHILD_URL.'/elementor-ext/widgets/css/tt-progress-bar.css' );
		wp_enqueue_style( 'tt-circle-bar-css', CHILD_URL.'/elementor-ext/widgets/css/tt-circle-bar.css' );

		//Scripts
		wp_enqueue_script('owl-carousel-min-js', CHILD_URL.'/elementor-ext/widgets/js/owl.carousel.min.js', array('jquery'));
		wp_enqueue_script('custom-posts-layout-js', CHILD_URL.'/elementor-ext/widgets/js/scripts.js', array('jquery'));
	}
?>
<?php

namespace APPWAYPLUGIN\Element;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;

/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Portfolios extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'appway_portfolios';
	}

	/**
	 * Get widget title.
	 * Retrieve button widget title.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Portfolios', 'appway' );
	}

	/**
	 * Get widget icon.
	 * Retrieve button widget icon.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-briefcase';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the button widget belongs to.
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'appway' ];
	}
	
	/**
	 * Register button widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'portfolios',
			[
				'label' => esc_html__( 'portfolios', 'appway' ),
			]
		);
		$this->add_control(
			'column',
			[
				'label'   => esc_html__( 'Column', 'rashid' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => array(
					'12'   => esc_html__( 'One Column', 'rashid' ),
					'6'   => esc_html__( 'Two Column', 'rashid' ),
					'4'   => esc_html__( 'Three Column', 'rashid' ),
					'3'   => esc_html__( 'Four Column', 'rashid' ),
					'2'   => esc_html__( 'Six Column', 'rashid' ),
				),
			]
		);
		$this->add_control(
			'number',
			[
				'label'   => esc_html__( 'Number of post', 'appway' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);
		$this->add_control(
			'cat_exclude',
			[
				'label'       => esc_html__( 'Exclude', 'appway' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Exclude categories, etc. by ID with comma separated.', 'appway' ),
			]
		);
		$this->add_control(
			'query_order',
			[
				'label'   => esc_html__( 'Order', 'appway' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => array(
					'DESc' => esc_html__( 'DESC', 'appway' ),
					'ASC'  => esc_html__( 'ASC', 'appway' ),
				),
			]
		);
		$this->add_control(
			'query_orderby',
			[
				'label'   => esc_html__( 'Order By', 'appway' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'       => esc_html__( 'Date', 'appway' ),
					'title'      => esc_html__( 'Title', 'appway' ),
					'menu_order' => esc_html__( 'Menu Order', 'appway' ),
					'rand'       => esc_html__( 'Random', 'appway' ),
				),
			]
		);
		$this->end_controls_section();
		
	}

	/**
	 * Render button widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$paged = appway_set($_POST, 'paged') ? esc_attr($_POST['paged']) : 1;
		$this->add_render_attribute( 'wrapper', 'class', 'templatepath-appway' );
		$args = array(
			'post_type'      => 'appway_project',
			'posts_per_page' => appway_set( $settings, 'number' ),
			'orderby'        => appway_set( $settings, 'query_orderby' ),
			'order'          => appway_set( $settings, 'query_order' ),
			'paged'         => $paged
		);
		$terms_array = explode(",",appway_set( $settings, 'cat_exclude' ));
		if(appway_set( $settings, 'cat_exclude' )) $args['tax_query'] = array(array('taxonomy' => 'project_cat','field' => 'id','terms' => $terms_array,'operator' => 'NOT IN',));
		$allowed_tags = wp_kses_allowed_html('post');
		$query = new \WP_Query( $args );
		$t = '';
		$data_filtration = '';
		$data_posts = '';
		if ( $query->have_posts() ) 
		{
		ob_start();
		?>
  
		<?php 
            $count = 0; 
            $fliteration = array();
            while( $query->have_posts() ): $query->the_post();
            global  $post;
            $meta = ''; //printr($meta);
            $meta1 = ''; //_WSH()->get_meta();
            $post_terms = get_the_terms( get_the_id(), 'project_cat');// printr($post_terms); exit();
            foreach( (array)$post_terms as $pos_term ) $fliteration[$pos_term->term_id] = $pos_term;
            $temp_category = get_the_term_list(get_the_id(), 'project_cat', '', ', ');
            
            $post_terms = wp_get_post_terms( get_the_id(), 'project_cat'); 
            $term_slug = '';
            if( $post_terms ) foreach( $post_terms as $p_term ) $term_slug .= $p_term->slug.' ';
        
            ?>
			<div class="col-lg-<?php echo esc_attr($settings['column'], true );?> col-md-6 col-sm-12 masonry-item small-column all <?php echo esc_attr($term_slug); ?>">
				<div class="portfolio-block-one">
					<div class="image-box">
						<figure class="image"><?php the_post_thumbnail(); ?></figure>
						<div class="content-box">
							<div class="inner">
								<div class="title"><?php echo (get_post_meta( get_the_id(), 'meta_subtitle', true ));?></div>
								<h3><a href="<?php echo esc_url(get_post_meta( get_the_id(), 'page_link', true ));?>"><?php the_title(); ?></a></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
			
            <?php endwhile;?>

            <?php wp_reset_postdata();
            $data_posts = ob_get_contents();
            ob_end_clean();
            
            ob_start();?>
            
            <?php $terms = get_terms(array('project_cat')); ?>
			

			<!-- portfolio-section -->
			<section class="portfolio-section">
				<div class="container">
					<div class="sortable-masonry">
						<div class="filters">
							<ul class="filter-tabs filter-btns centred clearfix">
							
								<li class="active filter" data-role="button" data-filter=".all"><?php esc_attr_e('All', 'appway');?></li>
								
								<?php foreach( $fliteration as $t ): ?>
								
								<li class="filter" data-role="button" data-filter=".<?php echo esc_attr(appway_set( $t, 'slug' )); ?>"><?php echo appway_set( $t, 'name'); ?></li>
								
								<?php endforeach;?>
								
							</ul>
						</div>
						<div class="items-container row clearfix">
							<?php echo $data_posts; ?>
						</div>
					</div>
				</div>
			</section>
			<!-- portfolio-section end -->
	
	
    	<?php }
	}

}

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
class Team3 extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'appway_team3';
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
		return esc_html__( 'Team 3', 'appway' );
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
			'team3',
			[
				'label' => esc_html__( 'Team 3', 'appway' ),
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
			'text_limit',
			[
				'label'   => esc_html__( 'Text Limit', 'appway' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);
		$this->add_control(
			'query_number',
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
			'query_exclude',
			[
				'label'       => esc_html__( 'Exclude', 'appway' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Exclude posts, pages, etc. by ID with comma separated.', 'appway' ),
			]
		);
		$this->add_control(
            'query_category', 
				[
				  'type' => Controls_Manager::SELECT,
				  'label' => esc_html__('Category', 'appway'),
				  'options' => get_team_categories()
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
			'post_type'      => 'appway_team',
			'posts_per_page' => appway_set( $settings, 'query_number' ),
			'orderby'        => appway_set( $settings, 'query_orderby' ),
			'order'          => appway_set( $settings, 'query_order' ),
			'paged'         => $paged
		);
		if ( appway_set( $settings, 'query_exclude' ) ) {
			$settings['query_exclude'] = explode( ',', $settings['query_exclude'] );
			$args['post__not_in']      = appway_set( $settings, 'query_exclude' );
		}
		if( appway_set( $settings, 'query_category' ) ) $args['team_cat'] = appway_set( $settings, 'query_category' );
		$query = new \WP_Query( $args );

		if ( $query->have_posts() ) 
		{
		?>
  
   <!-- team-style-two -->
    <section class="team-style-two">
        <div class="container">
            <div class="row">
                
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>		
						
				<div class="col-lg-<?php echo esc_attr($settings['column'], true );?> col-md-6 col-sm-12 inner-content">
                    <div class="inner-content">
                        <div class="team-block-two">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 image-column">
                                    <figure class="image-box"><a href="<?php echo esc_url(get_post_meta( get_the_id(), 'team_link', true ));?>"><?php the_post_thumbnail(); ?></a></figure>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 content-column d-flex">
                                    <div class="content-box my-auto">
                                        <span><?php echo (get_post_meta( get_the_id(), 'designation', true ));?></span>
                                        <h4><a href="<?php echo esc_url(get_post_meta( get_the_id(), 'team_link', true ));?>"><?php the_title(); ?></a></h4>
                                        <div class="text"><?php echo appway_trim(get_the_content(), $settings['text_limit']); ?></div>
                                        
										<?php	
										$icons = get_post_meta( get_the_id(), 'social_profile', true );
											if ( ! empty( $icons ) ) :?>
									    <ul class="team-social">
											<?php
											foreach ( $icons as $h_icon ) :
											$header_social_icons = json_decode( urldecode( appway_set( $h_icon, 'data' ) ) );
											if ( appway_set( $header_social_icons, 'enable' ) == '' ) {
											continue;
											}
											$icon_class = explode( '-', appway_set( $header_social_icons, 'icon' ) );?>
											<li><a href="<?php echo appway_set( $header_social_icons, 'url' ); ?>"><i class="fab <?php echo esc_attr( appway_set( $header_social_icons, 'icon' ) ); ?>"></i></a></li>
											<?php endforeach; ?>
										</ul>
										<?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
				
				<?php endwhile; ?>     
			   
            </div>
        </div>
    </section>
  
           
        <?php }
		wp_reset_postdata();
	}

}

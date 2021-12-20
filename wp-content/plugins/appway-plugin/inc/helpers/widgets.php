<?php
//----Blog widgets---
//Recent Post 
//Make Appointment
//our_Appointment
//Our Brochures
//Services Side Bar
//Opening Hours
//Footer Services
//About Us
//Our Project
//Manual Gallery

//Recent Post 
class Appway_Recent_Post extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Appway_Recent_Post', /* Name */esc_html__('Appway Sidebar Post','appway'), array( 'description' => esc_html__('Show the Recent Post', 'appway' )) );
	}
 

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
        
        <!-- Popular Posts -->
<div class="sidebar-widget sidebar-post">
	<?php echo wp_kses_post($before_title.$title.$after_title); ?>
	<div class="widget-content">
		 <?php $query_string = 'posts_per_page='.$instance['number'];
				if( $instance['cat'] ) $query_string .= '&cat='.$instance['cat'];
				 
				$this->posts($query_string);
			?>
	</div>
</div>

        
		<?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Recent Post', 'appway');
		$number = ( $instance ) ? esc_attr($instance['number']) : 3;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'appway'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'appway'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
       
    	<p>
            <label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e('Category', 'appway'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'appway'), 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('categories')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts($query_string)
	{
		
		$query = new WP_Query($query_string);
		if( $query->have_posts() ):?>
        
           	<!-- Title -->
			<?php while( $query->have_posts() ): $query->the_post(); ?>
			 <div class="post">
				<figure class="post-thumb"><a href="<?php echo esc_url(get_the_permalink(get_the_id()));?>"><?php the_post_thumbnail('appway_80x80'); ?></a></figure>
				<div class="bind">
				 <h6><a href="<?php echo esc_url(get_the_permalink(get_the_id()));?>"><?php the_title(); ?></a></h6>
				<span class="post-date"><?php echo get_the_date();?></span>
				 </div>
			</div>
            <?php endwhile; ?>
            
        <?php endif;
		wp_reset_postdata();
    }
}

//Our Project
class Appway_Our_Projects extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Appway_Our_Projects', /* Name */esc_html__('appway Our Projects','appway'), array( 'description' => esc_html__('Show the Our Projects', 'appway' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
        <!-- Service List Box -->
        <?php echo wp_kses_post($before_title.$title.$after_title); ?>
        <ul class="instagram">
            
			<?php 
				$args = array('post_type' => 'appway_project', 'showposts'=>$instance['number']);
				if( $instance['cat'] ) $args['tax_query'] = array(array('taxonomy' => 'project_cat','field' => 'id','terms' => (array)$instance['cat']));
				 
				$this->posts($args);
			?>
             
        </ul>
		
        <?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : 'Our Projects';
		$number = ( $instance ) ? esc_attr($instance['number']) : 6;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
		
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Our Projects', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts: ', 'appway'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'appway'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'appway'), 'selected'=>$cat, 'taxonomy' => 'project_cat', 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts($args)
	{
		
		$query = new WP_Query($args);
		if( $query->have_posts() ):?>
        
           	<!-- Title -->
            <?php while( $query->have_posts() ): $query->the_post(); 
				global $post ; 
			?>
            <li>
                <div class="img-holder">
                    <?php the_post_thumbnail('appway_90x90'); ?>
                    <div class="overlay-style-one">
                        <div class="box">
                            <div class="content">
                                <a href="<?php echo esc_url(get_post_meta( get_the_id(), 'project_link', true ));?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php endwhile; ?>
                
        <?php endif;
		wp_reset_postdata();
    }
}

///----footer widgets---
//About Us 
//Rashid
class Appway_About_Us extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Appway_About_Us', /* Name */esc_html__('Appway Footer About','appway'), array( 'description' => esc_html__('Show the information about company', 'appway' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		
		echo wp_kses_post($before_widget);?>
      		
		
	<div class="<?php echo wp_kses_post($instance['extra']); ?> about-widget footer-widget ">
                                <figure class="footer-logo"><a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url($instance['footer_logo']); ?>" alt=""></a></figure>
                                <div class="text"><?php echo wp_kses_post($instance['content']); ?></div>
                               
							   <ul class="social-links">
                                    
								<?php if (wp_kses_post($instance['share'])) : ?>	
									<li><h6><?php echo wp_kses_post($instance['share']); ?></h6></li>
                                <?php endif ; ?> 

								<?php if (wp_kses_post($instance['link1'])) : ?>
									<li><a href="<?php echo esc_url($instance['link1']); ?>"><i class="fab fa-facebook-f"></i></a></li>
									
								<?php endif ; ?> 	
								<?php if (wp_kses_post($instance['link2'])) : ?>	
                                    <li><a href="<?php echo esc_url($instance['link2']); ?>"><i class="fab fa-twitter"></i></a></li>
								<?php endif ; ?> 	
									
								<?php if (wp_kses_post($instance['link3'])) : ?>	
                                    <li><a href="<?php echo esc_url($instance['link3']); ?>"><i class="fab fa-google-plus"></i></a></li>
								<?php endif ; ?> 	
								<?php if (wp_kses_post($instance['link4'])) : ?>	
                                    <li><a href="<?php echo esc_url($instance['link4']); ?>"><i class="fab fa-linkedin-in"></i></a></li>
								<?php endif ; ?> 	
									
                                </ul>
                            </div>		  
			
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['footer_logo'] = strip_tags($new_instance['footer_logo']);
		$instance['content'] = $new_instance['content'];
		$instance['share'] = $new_instance['share'];
		$instance['link1'] = $new_instance['link1'];
		$instance['link2'] = $new_instance['link2'];
		$instance['link3'] = $new_instance['link3'];
		$instance['link4'] = $new_instance['link4'];
		$instance['extra'] = $new_instance['extra'];
		

		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$footer_logo = ($instance) ? esc_attr($instance['footer_logo']) : '';
		$content = ($instance) ? esc_attr($instance['content']) : '';
		$share = ($instance) ? esc_attr($instance['share']) : '';
		$link1 = ($instance) ? esc_attr($instance['link1']) : '';
		$link2 = ($instance) ? esc_attr($instance['link2']) : '';
		$link3 = ($instance) ? esc_attr($instance['link3']) : '';
		$link4 = ($instance) ? esc_attr($instance['link4']) : '';
		$extra = ($instance) ? esc_attr($instance['extra']) : '';
		
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('footer_logo')); ?>"><?php esc_html_e('Footer Logo Image Url:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Logo url', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('footer_logo')); ?>" name="<?php echo esc_attr($this->get_field_name('footer_logo')); ?>" type="text" value="<?php echo esc_attr($footer_logo); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('share')); ?>"><?php esc_html_e('Share:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('share')); ?>" name="<?php echo esc_attr($this->get_field_name('share')); ?>" ><?php echo wp_kses_post($content_2); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('link1')); ?>"><?php esc_html_e('Facebook Link:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('link1')); ?>" name="<?php echo esc_attr($this->get_field_name('link1')); ?>" ><?php echo wp_kses_post($link1); ?></textarea>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('link2')); ?>"><?php esc_html_e('Twitter Link:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('link2')); ?>" name="<?php echo esc_attr($this->get_field_name('link2')); ?>" ><?php echo wp_kses_post($link2); ?></textarea>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('link3')); ?>"><?php esc_html_e('Google  Link:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('link3')); ?>" name="<?php echo esc_attr($this->get_field_name('link3')); ?>" ><?php echo wp_kses_post($link3); ?></textarea>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('link4')); ?>"><?php esc_html_e('Linkedin Link:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('link4')); ?>" name="<?php echo esc_attr($this->get_field_name('link4')); ?>" ><?php echo wp_kses_post($link4); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('extra')); ?>"><?php esc_html_e('Extra Class:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('extra')); ?>" name="<?php echo esc_attr($this->get_field_name('extra')); ?>" ><?php echo wp_kses_post($extra); ?></textarea>
        </p>   
		<?php 
	}
	
}

//Footer Services
class Appway_Footer_services extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Appway_Footer_services', /* Name */esc_html__('appway Footer Services','appway'), array( 'description' => esc_html__('Show the Footer Services', 'appway' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
        <!-- Service List Box -->
        <div class="martop6 marbtm50">
            <?php echo wp_kses_post($before_title.$title.$after_title); ?>
            <ul class="specialities">
                <?php 
					$args = array('post_type' => 'appway_service', 'showposts'=>$instance['number']);
					if( $instance['cat'] ) $args['tax_query'] = array(array('taxonomy' => 'service_cat','field' => 'id','terms' => (array)$instance['cat']));
					 
					$this->posts($args);
				?>
            </ul>
        </div>
		
        <?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : 'Specialities';
		$number = ( $instance ) ? esc_attr($instance['number']) : 7;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
		
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Our Services', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts: ', 'appway'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'appway'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'appway'), 'selected'=>$cat, 'taxonomy' => 'service_cat', 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts($args)
	{
		
		$query = new WP_Query($args);
		if( $query->have_posts() ):?>
        
           	<!-- Title -->
            <?php while( $query->have_posts() ): $query->the_post(); 
				global $post ; 
			?>
            <li><a href="<?php echo esc_url(get_post_meta( get_the_id(), 'ext_url', true ));?>"><?php the_title(); ?></a></li>
            <?php endwhile; ?>
                
        <?php endif;
		wp_reset_postdata();
    }
}

//Opening Hours
class Appway_Opening_Hours extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Appway_Opening_Hours', /* Name */esc_html__('appway Opening Hours','appway'), array( 'description' => esc_html__('Show the Opening Hours', 'appway' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo wp_kses_post($before_widget);
		?>
      		
			<!--Footer Column-->
            <div class="martop50 pdtop-50">
                <?php echo wp_kses_post($before_title.$title.$after_title); ?>
                <ul class="opening-hours">
                    <li><?php echo wp_kses_post($instance['monday']); ?></li>
                    <li><?php echo wp_kses_post($instance['tuesday']); ?></li>
                    <li><?php echo wp_kses_post($instance['wednesday']); ?></li>
                    <li><?php echo wp_kses_post($instance['thursday']); ?></li>
                    <li><?php echo wp_kses_post($instance['friday']); ?></li>
                    <li><?php echo wp_kses_post($instance['saturday']); ?></li>
                    <li><?php echo wp_kses_post($instance['sunday']); ?></li>
                </ul>   
            </div>
            
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['monday'] = $new_instance['monday'];
		$instance['tuesday'] = $new_instance['tuesday'];
		$instance['wednesday'] = $new_instance['wednesday'];
		$instance['thursday'] = $new_instance['thursday'];
		$instance['friday'] = $new_instance['friday'];
		$instance['saturday'] = $new_instance['saturday'];
		$instance['sunday'] = $new_instance['sunday'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : 'Opening Hours';
		$monday = ($instance) ? esc_attr($instance['monday']) : '';
		$tuesday = ($instance) ? esc_attr($instance['tuesday']) : '';
		$wednesday = ($instance) ? esc_attr($instance['wednesday']) : '';
		$thursday = ($instance) ? esc_attr($instance['thursday']) : '';
		$friday = ($instance) ? esc_attr($instance['friday']) : '';
		$saturday = ($instance) ? esc_attr($instance['saturday']) : '';
		$sunday = ($instance) ? esc_attr($instance['sunday']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Enter Title Here', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('monday')); ?>"><?php esc_html_e('Monday Opening Hours:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('monday')); ?>" name="<?php echo esc_attr($this->get_field_name('monday')); ?>" ><?php echo wp_kses_post($monday); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('tuesday')); ?>"><?php esc_html_e('Tuesday Opening Hours:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('tuesday')); ?>" name="<?php echo esc_attr($this->get_field_name('tuesday')); ?>" ><?php echo wp_kses_post($tuesday); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('wednesday')); ?>"><?php esc_html_e('Wednesday Opening Hours:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('wednesday')); ?>" name="<?php echo esc_attr($this->get_field_name('wednesday')); ?>" ><?php echo wp_kses_post($wednesday); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('thursday')); ?>"><?php esc_html_e('Thursday Opening Hours:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('thursday')); ?>" name="<?php echo esc_attr($this->get_field_name('thursday')); ?>" ><?php echo wp_kses_post($thursday); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('friday')); ?>"><?php esc_html_e('Friday Opening Hours:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('friday')); ?>" name="<?php echo esc_attr($this->get_field_name('friday')); ?>" ><?php echo wp_kses_post($friday); ?></textarea>
        </p> 
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('saturday')); ?>"><?php esc_html_e('Saturday Opening Hours:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('saturday')); ?>" name="<?php echo esc_attr($this->get_field_name('saturday')); ?>" ><?php echo wp_kses_post($saturday); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('sunday')); ?>"><?php esc_html_e('Sunday Opening Hours:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('sunday')); ?>" name="<?php echo esc_attr($this->get_field_name('sunday')); ?>" ><?php echo wp_kses_post($sunday); ?></textarea>
        </p>       
                
		<?php 
	}
	
}

///----Service Sidebar widgets---
//Services Side Bar
class Appway_services_sidebar extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Appway_services_sidebar', /* Name */esc_html__('appway Services Sidebar','appway'), array( 'description' => esc_html__('Show the Footer Services', 'appway' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
        <!--Start Single sidebar-->
        <div class="single-sidebar">
            <div class="inner">
                <?php echo wp_kses_post($before_title.$title.$after_title); ?>
                <ul class="specialities-categories">
                    <?php 
						$args = array('post_type' => 'appway_service', 'showposts'=>$instance['number']);
						if( $instance['cat'] ) $args['tax_query'] = array(array('taxonomy' => 'service_cat','field' => 'id','terms' => (array)$instance['cat']));
						 
						$this->posts($args);
					?>   
                </ul>
            </div>
        </div>
		
        <?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : 'Dental Implants';
		$number = ( $instance ) ? esc_attr($instance['number']) : 6;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
		
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Our Services', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts: ', 'appway'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'appway'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'appway'), 'selected'=>$cat, 'taxonomy' => 'service_cat', 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
            
		<?php 
	}
	
	function posts($args)
	{
		
		$query = new WP_Query($args);
		if( $query->have_posts() ):?>
        
           	<!-- Title -->
            <?php while( $query->have_posts() ): $query->the_post(); 
				global $post ; 
			?>
            <li><a href="<?php echo esc_url(get_post_meta( get_the_id(), 'ext_url', true ));?>"><?php the_title(); ?></a></li>
            <?php endwhile; ?>
                
        <?php endif;
		wp_reset_postdata();
    }
}

//Our Brochures
class Appway_Brochures extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Appway_Brochures', /* Name */esc_html__('appway Our Brochures','appway'), array( 'description' => esc_html__('Show the info Our Brochures', 'appway' )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget);?>
      		
            <!--Start Single sidebar-->
            <div class="single-sidebar">
                <div class="brochures-sidebar">
                    <?php echo wp_kses_post($before_title.$title.$after_title); ?>
                    <ul class="our-brochures">
                        <li>
                            <a href="<?php echo esc_url($instance['word_file_link']); ?>">
                                <div class="icon-holder">
                                    <span class="icon-word"></span>    
                                </div>
                                <div class="title-holder">
                                    <p><?php echo wp_kses_post($instance['word_file_title']); ?></p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url($instance['pdf_file_link']); ?>">
                                <div class="icon-holder">
                                    <span class="icon-text-file"></span>    
                                </div>
                                <div class="title-holder">
                                    <p><?php echo wp_kses_post($instance['pdf_file_title']); ?></p>
                                </div>
                            </a>
                        </li> 
                    </ul>
                </div>
            </div>
            <!--End Single sidebar-->
            
		<?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['word_file_title'] = $new_instance['word_file_title'];
		$instance['word_file_link'] = $new_instance['word_file_link'];
		$instance['pdf_file_title'] = $new_instance['pdf_file_title'];
		$instance['pdf_file_link'] = $new_instance['pdf_file_link'];
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : 'Our Brochures';
		$word_file_title = ($instance) ? esc_attr($instance['word_file_title']) : '';
		$word_file_link = ($instance) ? esc_attr($instance['word_file_link']) : '';
		$pdf_file_title = ($instance) ? esc_attr($instance['pdf_file_title']) : '';
		$pdf_file_link = ($instance) ? esc_attr($instance['pdf_file_link']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Our Brochures', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('word_file_title')); ?>"><?php esc_html_e('Word File Title:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('word_file_title')); ?>" name="<?php echo esc_attr($this->get_field_name('word_file_title')); ?>" ><?php echo wp_kses_post($word_file_title); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('word_file_link')); ?>"><?php esc_html_e('External Link:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('#', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('word_file_link')); ?>" name="<?php echo esc_attr($this->get_field_name('word_file_link')); ?>" type="text" value="<?php echo esc_attr($word_file_link); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('pdf_file_title')); ?>"><?php esc_html_e('Pdf File Title:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('pdf_file_title')); ?>" name="<?php echo esc_attr($this->get_field_name('pdf_file_title')); ?>" ><?php echo wp_kses_post($pdf_file_title); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('pdf_file_link')); ?>"><?php esc_html_e('External Link:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('#', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('pdf_file_link')); ?>" name="<?php echo esc_attr($this->get_field_name('pdf_file_link')); ?>" type="text" value="<?php echo esc_attr($pdf_file_link); ?>" />
        </p>
                
		<?php 
	}
	
}

//our_Appointment
class Appway_Our_Appointment extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Appway_Our_Appointment', /* Name */esc_html__('appway Our Appointment','appway'), array( 'description' => esc_html__('Show the Our Appointment', 'appway' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		
		echo wp_kses_post($before_widget);?>
      		
			<!--Help Widget-->
            <div class="sidebar-appointment-box">
                <span class="icon-calendar"></span>
                <h3><?php echo wp_kses_post($instance['title']); ?></h3>
                <p><?php echo wp_kses_post($instance['content']); ?></p>    
                <a class="btn-one" href="<?php echo esc_url($instance['btn_link']); ?>"><?php echo wp_kses_post($instance['btn_title']); ?></a>
            </div>
            
		<?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['content'] = $new_instance['content'];
		$instance['btn_title'] = $new_instance['btn_title'];
		$instance['btn_link'] = $new_instance['btn_link'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		
		$title = ($instance) ? esc_attr($instance['title']) : 'Appointment';
		$content = ($instance) ? esc_attr($instance['content']) : '';
		$btn_title = ($instance) ? esc_attr($instance['btn_title']) : '';
		$btn_link = ($instance) ? esc_attr($instance['btn_link']) : '';
		?>
        
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Appointment', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_title')); ?>"><?php esc_html_e('Button Title:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Make It', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_title')); ?>" name="<?php echo esc_attr($this->get_field_name('btn_title')); ?>" type="text" value="<?php echo esc_attr($btn_title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_link')); ?>"><?php esc_html_e('Button Link:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('#', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_link')); ?>" name="<?php echo esc_attr($this->get_field_name('btn_link')); ?>" type="text" value="<?php echo esc_attr($btn_link); ?>" />
        </p>
               
                
		<?php 
	}
	
}

//Make Appointment
class Appway_Make_Appointment_Form extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Appway_Make_Appointment_Form', /* Name */esc_html__('appway Make Appointment Form','appway'), array( 'description' => esc_html__('Show the Make Appointment Form', 'appway' )) );
	}
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget);?>
      		
            <!--Start Single Sidebar-->
            <div class="single-sidebar">
                <div class="sidebar-appoinment">
                    <div class="title">
                        <?php echo wp_kses_post($before_title.$title.$after_title); ?>
                    </div> 
                    <div class="appoinment-form">
                    	<?php echo do_shortcode($instance['make_appoinment_form']); ?>
                    </div>    
                </div>
            </div>
            <!--End Single Sidebar-->
            
		<?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['make_appoinment_form'] = $new_instance['make_appoinment_form'];
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : 'Make Appointment';
		$make_appoinment_form = ($instance) ? esc_attr($instance['make_appoinment_form']) : '';
		?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Make Appointment', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('make_appoinment_form')); ?>"><?php esc_html_e('Make Appoinment Form:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('make_appoinment_form')); ?>" name="<?php echo esc_attr($this->get_field_name('make_appoinment_form')); ?>" ><?php echo wp_kses_post($make_appoinment_form); ?></textarea>
        </p>
        
                
		<?php 
	}
	
}


//Footer Subscribe
//Rashid
class Appway_Subscribe extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Appway_Subscribe', /* Name */esc_html__('Appway Footer Subscribe','appway'), array( 'description' => esc_html__('Show the Subscribe', 'appway' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo wp_kses_post($before_widget);?>
      	
			 <?php echo wp_kses_post($before_title.$title.$after_title); ?>
			 <div class="subscribe-widget footer-widget">
				<div class="widget-content">
					<div class="text"><p><?php echo wp_kses_post($instance['content']); ?></p></div>
					

<form class="subscribe-form" method="post" action="http://feedburner.google.com/fb/a/mailverify" accept-charset="utf-8">
<div class="form-group">
	<input type="hidden" id="uri2" name="uri" value="<?php echo wp_kses_post($instance['subscribeID']); ?>">
	<input type="email" name="email" placeholder="<?php esc_attr_e('your mail address...', 'appway'); ?>">
	<button class="submit"><i class="far fa-paper-plane"></i></button>
</div>
</form>				
</div>
				<div class="download-btn clearfix">
					<figure class="image"><a href="<?php echo esc_url($instance['btn_link4']); ?>"><img src="<?php echo esc_url($instance['footer_logo1']); ?>" alt=""></a></figure>
					<figure class="image"><a href="<?php echo esc_url($instance['btn_link5']); ?>"><img src="<?php echo esc_url($instance['footer_logo2']); ?>" alt=""></a></figure>
				</div>
				<ul class="social-links clearfix">
					<li><a href="<?php echo esc_url($instance['btn_link']); ?>"><i class="fab fa-facebook-f"></i></a></li>
					<li><a href="<?php echo esc_url($instance['btn_link1']); ?>"><i class="fab fa-twitter"></i></a></li>
					<li><a href="<?php echo esc_url($instance['btn_link2']); ?>"><i class="fab fa-linkedin-in"></i></a></li>
					<li><a href="<?php echo esc_url($instance['btn_link3']); ?>"><i class="fab fa-skype"></i></a></li>
				</ul>
			</div>
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['content'] = $new_instance['content'];
		$instance['subscribeID'] = $new_instance['subscribeID'];
		$instance['footer_logo1'] = strip_tags($new_instance['footer_logo1']);
		$instance['btn_link4'] = $new_instance['btn_link4'];
		$instance['footer_logo2'] = strip_tags($new_instance['footer_logo2']);
		$instance['btn_link5'] = $new_instance['btn_link5'];
		
		$instance['btn_link'] = $new_instance['btn_link'];
		$instance['btn_link1'] = $new_instance['btn_link1'];
		$instance['btn_link2'] = $new_instance['btn_link2'];
		$instance['btn_link3'] = $new_instance['btn_link3'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : 'Newsletter';
		$content = ($instance) ? esc_attr($instance['content']) : '';
		$subscribeID = ($instance) ? esc_attr($instance['subscribeID']) : '';
		$footer_logo1 = ($instance) ? esc_attr($instance['footer_logo1']) : '';
		$btn_link4 = ($instance) ? esc_attr($instance['btn_link4']) : '';
		$footer_logo2 = ($instance) ? esc_attr($instance['footer_logo2']) : '';
		$btn_link5 = ($instance) ? esc_attr($instance['btn_link5']) : '';
		$btn_link = ($instance) ? esc_attr($instance['btn_link']) : '';
		$btn_link1 = ($instance) ? esc_attr($instance['btn_link1']) : '';
		$btn_link2 = ($instance) ? esc_attr($instance['btn_link2']) : '';
		$btn_link3 = ($instance) ? esc_attr($instance['btn_link3']) : '';
		
		?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Newsletter', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>
		
		 <p>
            <label for="<?php echo esc_attr($this->get_field_id('subscribeID')); ?>"><?php esc_html_e('Subscribe ID', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('subscribeID')); ?>" name="<?php echo esc_attr($this->get_field_name('subscribeID')); ?>" ><?php echo wp_kses_post($subscribeID); ?></textarea>
        </p>
        
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('footer_logo1')); ?>"><?php esc_html_e('App Image Url:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Logo url', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('footer_logo1')); ?>" name="<?php echo esc_attr($this->get_field_name('footer_logo1')); ?>" type="text" value="<?php echo esc_attr($footer_logo1); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_link4')); ?>"><?php esc_html_e('Page Link', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_link4')); ?>" name="<?php echo esc_attr($this->get_field_name('btn_link4')); ?>" ><?php echo wp_kses_post($btn_link4); ?></textarea>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('footer_logo2')); ?>"><?php esc_html_e('App Image Url:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Logo url', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('footer_logo2')); ?>" name="<?php echo esc_attr($this->get_field_name('footer_logo2')); ?>" type="text" value="<?php echo esc_attr($footer_logo2); ?>" />
        </p>
       <p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_link5')); ?>"><?php esc_html_e('Page Link', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_link5')); ?>" name="<?php echo esc_attr($this->get_field_name('btn_link5')); ?>" ><?php echo wp_kses_post($btn_link5); ?></textarea>
        </p>
        
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_link')); ?>"><?php esc_html_e('Social Link', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_link')); ?>" name="<?php echo esc_attr($this->get_field_name('btn_link')); ?>" ><?php echo wp_kses_post($btn_link); ?></textarea>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_link1')); ?>"><?php esc_html_e('Social Link', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_link1')); ?>" name="<?php echo esc_attr($this->get_field_name('btn_link1')); ?>" ><?php echo wp_kses_post($btn_link1); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_link2')); ?>"><?php esc_html_e('Social Link', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_link2')); ?>" name="<?php echo esc_attr($this->get_field_name('btn_link2')); ?>" ><?php echo wp_kses_post($btn_link2); ?></textarea>
        </p>  
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_link3')); ?>"><?php esc_html_e('Social Link', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_link3')); ?>" name="<?php echo esc_attr($this->get_field_name('btn_link3')); ?>" ><?php echo wp_kses_post($btn_link3); ?></textarea>
        </p>
		<?php 
	}
	
}
//Manual Gallery
//Rashid
class Appway_Manual_Gallery extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Appway_Manual_Gallery', /* Name */esc_html__('Appway Sidebar Gallery','appway'), array( 'description' => esc_html__('Show the Sidebar Gallery', 'appway' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo wp_kses_post($before_widget);
		
		?>
      	
			 
			

 <div class="sidebar-widget gallery-widget">
                            <?php echo wp_kses_post($before_title.$title.$after_title); ?>
                            <div class="widget-content">
                                <div class="image-list clearfix">
                                    <div class="image"><figure><a href="#"><img src="<?php echo esc_url($instance['image1']); ?>" alt=""></a></figure></div>
                                   <div class="image"><figure><a href="#"><img src="<?php echo esc_url($instance['image2']); ?>" alt=""></a></figure></div>
								   <div class="image"><figure><a href="#"><img src="<?php echo esc_url($instance['image3']); ?>" alt=""></a></figure></div>
								   <div class="image"><figure><a href="#"><img src="<?php echo esc_url($instance['image4']); ?>" alt=""></a></figure></div>
								  <div class="image"><figure><a href="#"><img src="<?php echo esc_url($instance['image5']); ?>" alt=""></a></figure></div>
								  <div class="image"><figure><a href="#"><img src="<?php echo esc_url($instance['image6']); ?>" alt=""></a></figure></div>
                               </div>
                            </div>
                        </div>
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];

		$instance['image1'] = strip_tags($new_instance['image1']);
		$instance['image2'] = strip_tags($new_instance['image2']);
		$instance['image3'] = strip_tags($new_instance['image3']);
		$instance['image4'] = strip_tags($new_instance['image4']);
		$instance['image5'] = strip_tags($new_instance['image5']);
		$instance['image6'] = strip_tags($new_instance['image6']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : '';	
		$image1 = ($instance) ? esc_attr($instance['image1']) : '';
		$image2 = ($instance) ? esc_attr($instance['image2']) : '';
		$image3 = ($instance) ? esc_attr($instance['image3']) : '';
		$image4 = ($instance) ? esc_attr($instance['image4']) : '';
		$image5 = ($instance) ? esc_attr($instance['image5']) : '';
		$image6 = ($instance) ? esc_attr($instance['image6']) : '';
		
		?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Gallery', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
		
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('image1')); ?>"><?php esc_html_e('Image Url:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Image url', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('image1')); ?>" name="<?php echo esc_attr($this->get_field_name('image1')); ?>" type="text" value="<?php echo esc_attr($image1); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('image2')); ?>"><?php esc_html_e('Image Url:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Image url', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('image2')); ?>" name="<?php echo esc_attr($this->get_field_name('image2')); ?>" type="text" value="<?php echo esc_attr($image2); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('image3')); ?>"><?php esc_html_e('Image Url:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Image url', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('image3')); ?>" name="<?php echo esc_attr($this->get_field_name('image3')); ?>" type="text" value="<?php echo esc_attr($image3); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('image4')); ?>"><?php esc_html_e('Image Url:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Image url', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('image4')); ?>" name="<?php echo esc_attr($this->get_field_name('image4')); ?>" type="text" value="<?php echo esc_attr($image4); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('image5')); ?>"><?php esc_html_e('Image Url:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Image url', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('image5')); ?>" name="<?php echo esc_attr($this->get_field_name('image5')); ?>" type="text" value="<?php echo esc_attr($image5); ?>" />
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('image6')); ?>"><?php esc_html_e('Image Url:', 'appway'); ?></label>
            <input placeholder="<?php esc_attr_e('Image url', 'appway');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('image6')); ?>" name="<?php echo esc_attr($this->get_field_name('image6')); ?>" type="text" value="<?php echo esc_attr($image6); ?>" />
        </p>
		<?php 
	}
	
}
//Sidebar Subscribe
//Rashid
class Appway_Sidebar_Subscribe extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Appway_Sidebar_Subscribe', /* Name */esc_html__('Appway Sidebar Subscribe','appway'), array( 'description' => esc_html__('Show the Sidebar Subscribe', 'appway' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );	
		echo wp_kses_post($before_widget);?>
      	
 
 <div class="sidebar-widget subscribe-widget">
		<div class="widget-content">
			<h3><i class="fas fa-envelope-open"></i><?php echo wp_kses_post($instance['content']); ?></h3>
<form class="subscribe-form" method="post" action="http://feedburner.google.com/fb/a/mailverify" accept-charset="utf-8">
<div class="form-group">
	<input type="hidden" id="uri2" name="uri" value="<?php echo wp_kses_post($instance['subscribeID']); ?>">
	<input type="email" name="email" placeholder="<?php esc_attr_e('your mail address...', 'appway'); ?>">
	<button class="theme-btn style-four" type="submit"><?php esc_html_e('Subscribe', 'appway'); ?></button>
</div>
</form>	
		</div>
	</div>
			 
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['content'] = $new_instance['content'];
		$instance['subscribeID'] = $new_instance['subscribeID'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{

		$content = ($instance) ? esc_attr($instance['content']) : '';
		$subscribeID = ($instance) ? esc_attr($instance['subscribeID']) : '';
		
		?>
      
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Title:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>
		
		 <p>
            <label for="<?php echo esc_attr($this->get_field_id('subscribeID')); ?>"><?php esc_html_e('Subscribe ID', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('subscribeID')); ?>" name="<?php echo esc_attr($this->get_field_name('subscribeID')); ?>" ><?php echo wp_kses_post($subscribeID); ?></textarea>
        </p>

		<?php 
	}
	
}

/////
//Rashid
class Appway_List_Text extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Appway_List_Text', /* Name */esc_html__('Appway Footer List Text','appway'), array( 'description' => esc_html__('Show the Footer List Text', 'appway' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo wp_kses_post($before_widget);
		
	?>
      		

 <div class="<?php echo wp_kses_post($instance['extra']); ?> links-widget footer-widget">
			<?php echo wp_kses_post($before_title.$title.$after_title); ?>
			<div class="widget-content">
				<ul class="list clearfix">
					<?php echo wp_kses_post($instance['content']); ?>
				</ul>
			</div>
		</div>
		  
			
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
$instance['title'] = strip_tags($new_instance['title']);
		$instance['content'] = $new_instance['content'];
		$instance['extra'] = $new_instance['extra'];
		

		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
	
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Links', 'appway');
		$content = ($instance) ? esc_attr($instance['content']) : '';
	$extra = ($instance) ? esc_attr($instance['extra']) : '';
		
		?>
        
          <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'appway'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php esc_html_e('Content:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>" ><?php echo wp_kses_post($content); ?></textarea>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('extra')); ?>"><?php esc_html_e('Extra Class:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('extra')); ?>" name="<?php echo esc_attr($this->get_field_name('extra')); ?>" ><?php echo wp_kses_post($extra); ?></textarea>
        </p>
          
		<?php 
	}
	
}

//Footer Contact US Appway
class Appway_Contact_Us extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Appway_Contact_Us', /* Name */esc_html__('Appway Footer Contact US','appway'), array( 'description' => esc_html__('Show the Footer List Text', 'appway' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo wp_kses_post($before_widget);
		
	?>

 <div class="<?php echo wp_kses_post($instance['extra']); ?> contact-widget footer-widget">
                             <?php echo wp_kses_post($before_title.$title.$after_title); ?>
                                <div class="widget-content">
                                    <ul class="list clearfix">
                                    <?php if (wp_kses_post($instance['content1'])) : ?>    
										<li><i class="fas fa-map-marker-alt"></i><?php echo wp_kses_post($instance['content1']); ?></li>
                                    <?php endif ; ?>
									<?php if (wp_kses_post($instance['content2'])) : ?> 
										<li>
                                            <i class="fas fa-phone-volume"></i>
                                            <?php echo wp_kses_post($instance['content2']); ?>
                                        </li>
									<?php endif ; ?>
									<?php if (wp_kses_post($instance['content3'])) : ?> 
                                        <li>
                                            <i class="fas fa-envelope"></i>
                                            <?php echo wp_kses_post($instance['content3']); ?>
                                        </li>
									<?php endif ; ?> 	
                                    </ul>
                                </div>
                            </div>     		

		
        <?php
		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
$instance['title'] = strip_tags($new_instance['title']);
		$instance['content1'] = $new_instance['content1'];
		$instance['content2'] = $new_instance['content2'];
		$instance['content3'] = $new_instance['content3'];
		$instance['extra'] = $new_instance['extra'];
		

		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
	
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Links', 'appway');
		$content = ($instance) ? esc_attr($instance['content']) : '';
	$extra = ($instance) ? esc_attr($instance['extra']) : '';
		
		?>
        
          <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'appway'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('content1')); ?>"><?php esc_html_e('Address:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content1')); ?>" name="<?php echo esc_attr($this->get_field_name('content1')); ?>" ><?php echo wp_kses_post($content1); ?></textarea>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('content2')); ?>"><?php esc_html_e('Mobile:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content2')); ?>" name="<?php echo esc_attr($this->get_field_name('content2')); ?>" ><?php echo wp_kses_post($content2); ?></textarea>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('content3')); ?>"><?php esc_html_e('E-mail:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('content3')); ?>" name="<?php echo esc_attr($this->get_field_name('content3')); ?>" ><?php echo wp_kses_post($content3); ?></textarea>
        </p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('extra')); ?>"><?php esc_html_e('Extra Class:', 'appway'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('extra')); ?>" name="<?php echo esc_attr($this->get_field_name('extra')); ?>" ><?php echo wp_kses_post($extra); ?></textarea>
        </p>
          
		<?php 
	}
	
}
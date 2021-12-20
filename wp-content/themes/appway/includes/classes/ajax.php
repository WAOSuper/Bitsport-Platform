<?php
namespace APPWAY\Includes\Classes;

class Ajax {

	function actions() {
		add_action( 'wp_ajax_appway_ajax', array( $this, 'ajax_handler' ) );
		add_action( 'wp_ajax_nopriv_appway_ajax', array( $this, 'ajax_handler' ) );
	}

	function ajax_handler() {

		$method = appway_set( $_REQUEST, 'subaction' );
		if ( method_exists( $this, $method ) ) {
			$this->$method();
		}
		exit;

	}

	function appway_project_loadmore() {
		$allowed_html = wp_kses_allowed_html( 'post' );
		if ( class_exists( 'Douens_Resizer' ) ) {
			$img_obj = new \Appway_Resizer();
		}
		$args = appway_set( $_POST, 'query' );
		if ( ! empty( $args['paged'] ) AND ! empty( $args['posts_per_page'] ) AND ! empty( $args['order'] ) ) {
			$args['paged']    = $args['paged'] + 1;
			$args['post_type'] = 'appway_project';
			$query             = new \WP_Query( $args );
			if ( $query->have_posts() ) {
				$count = 0;
				ob_start();
				while ( $query->have_posts() ) {
					$query->the_post();
					if ( $count == 0 ) {
						$anim = array( 4, 5 );
					} else {
						$anim = array( 6, 5 );
					}
					?>
					<div class="col-md-6 col-sm-12 col-lg-6 wow zoomIn" data-wow-delay=".<?php echo esc_attr( $anim[0] ); ?>s" data-wow-duration=".<?php echo esc_attr( $anim[1] ); ?>s">
						<div class="portfolio-item">
							<?php echo wp_kses( $img_obj->resize( wp_get_attachment_url( get_post_thumbnail_id(), 'full' ), 585, 420, true ), $allowed_html ); ?>
							<div class="portfolio-cap">
								<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>"><?php the_title(); ?></a></h2>
								<span><?php the_terms( get_the_ID(), 'project_cat', '', ', ', '' ); ?></span>
							</div>
						</div>
					</div>
					<?php
					if ( $count == 1 ) {
						$count = - 1;
					}
					$count ++;
				}
				wp_reset_postdata();
				$output = ob_get_clean();
				$button = '<a class="loadmore-btn" href="javascript:void(0)" data-attr=\'' . json_encode($args) . '\' ><i class="flaticon-load theme-bg"></i>' . esc_html__( "Load More", "appway" ) . '</a>';
				wp_send_json( [
					'post'   => $output,
					'button' => $button,
				] );
			} else {
			    wp_reset_postdata();
				wp_send_json( [ 'button' => '<a class="loadmore-btn" href="javascript:void(0)"><i class="flaticon-load theme-bg"></i>' . esc_html__( "No More Post", "appway" ) . '</a>' ] );
			}
			exit;
		} else {
			wp_send_json( [ 'button' => '<a class="loadmore-btn" href="javascript:void(0)"><i class="flaticon-load theme-bg"></i>' . esc_html__( "No More Post", "appway" ) . '</a>' ] );
		}
		exit;
	}

	function appway_project_loadmore2() {
		if ( class_exists( 'Appway_Resizer' ) ) {
			$img_obj = new \Appway_Resizer();
		}
		$args              = appway_set( $_POST, 'query' );
		$args['post_type'] = 'appway_project';
		$query             = new \WP_Query( $args );
		if ( $query->have_posts() ) {
			$count = 0;
			ob_start();
			while ( $query->have_posts() ) {
				$query->the_post();
				if ( $count == 0 ) {
					$anim = 8;
				} elseif ( $count == 1 ) {
					$anim = 1;
				} else {
					$anim = '1.2';
				}
				?>
				<div class="col-md-4 col-sm-6 col-lg-4 fltr-itm wow zoomIn " data-wow-delay=".<?php echo esc_attr( $anim ); ?>s" data-wow-duration=".5s">
					<div class="portfolio-item2">
						<a href="<?php the_permalink(); ?>" data-fancybox="gallery">
							<?php echo wp_kses( $img_obj->resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'full' ), 357, 428, true ), $allowed_html ); ?>
						</a>
						<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>"><?php the_title(); ?></a></h4>
					</div>
				</div>
				<?php
				if ( $count == 2 ) {
					$count = - 1;
				}
				$count ++;
			}
			wp_reset_postdata();
			$output = ob_get_clean();
			$button = '<a class="loadmore-btn" href="javascript:void(0)" data-offset="' . ( appway_set( $args, 'offset' ) + appway_set( $args, 'showposts' ) ) . '" data-order="' . appway_set( $args, 'order' ) . '" data-orderby="' . appway_set( $args, 'orderby' ) . '" data-count="' . appway_set( $args, 'showposts' ) . '"><i class="flaticon-load theme-bg"></i>' . esc_html__( "Load More", "appway" ) . '</a>';
			wp_send_json( [
				'post'   => $output,
				'button' => $button,
			] );
		} else {
			wp_send_json( [ 'button' => $button = '<a class="loadmore-btn" href="javascript:void(0)"><i class="flaticon-load theme-bg"></i>' . esc_html__( "No More Post", "appway" ) . '</a>' ] );
		}
		exit;
	}

}

<?php
/**
 * Adds Foo_Widget widget.
 */
class Likebox_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'likebox_widget', // Base ID
			__('Likebox', 'text_domain'), // Name
			array( 'description' => __( 'A simple likebox widget', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$data = array();
		$data['title'] = apply_filters( 'widget_title', $instance['title'] );
		$data['page_url'] = esc_attr($instance['page_url']);
		$data['height'] = esc_attr($instance['height']);
		$data['width'] = esc_attr($instance['width']);
		$data['color'] = esc_attr($instance['color']);
		$data['show_faces'] = esc_attr($instance['show_faces']);
		$data['show_header'] = esc_attr($instance['show_header']);
		$data['show_posts'] = esc_attr($instance['show_posts']);
		$data['show_border'] = esc_attr($instance['show_borer']);
		
		echo $args['before_widget'];
		
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		
		//Show Likebox
		echo $this->getLikebox($data);
		
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$this->getForm($instance);
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['page_url'] = ( ! empty( $new_instance['page_url'] ) ) ? strip_tags( $new_instance['page_url'] ) : '';
		$instance['height'] = ( ! empty( $new_instance['height'] ) ) ? strip_tags( $new_instance['height'] ) : '';
		$instance['width'] = ( ! empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : '';
		$instance['color'] = ( ! empty( $new_instance['color'] ) ) ? strip_tags( $new_instance['color'] ) : '';
		$instance['show_faces'] = ( ! empty( $new_instance['show_faces'] ) ) ? strip_tags( $new_instance['show_faces'] ) : '';
		$instance['show_header'] = ( ! empty( $new_instance['show_header'] ) ) ? strip_tags( $new_instance['show_header'] ) : '';
		$instance['show_posts'] = ( ! empty( $new_instance['show_posts'] ) ) ? strip_tags( $new_instance['show_posts'] ) : '';
		$instance['show_border'] = ( ! empty( $new_instance['show_border'] ) ) ? strip_tags( $new_instance['show_border'] ) : '';
		return $instance;
	}
	
	/*
	 * Get and Display Likebox
	 * @param  array $data
	 */
	 public function getLikebox($data){
		$output = '<div id="fb-root"></div>';
		
		$output .= '<div class="fb-like-box" 
		data-href= "'.$data["page_url"].'"
		data-width= "'.$data["width"].'"
		data-height= "'.$data["height"].'"
		data-colorscheme= "'.$data["color"].'"
		data-show-faces= "'.$data["show_faces"].'"
		data-header= "'.$data["show_header"].'"
		data-stream= "'.$data["show_posts"].'"
		data-show-border= "'.$data["show_border"].'"></div>';
		
		return $output;
	 }
	 
	 /*
	 * Get and Display Backend Form
	 * @param  array $instance
	 */
	 public function getForm($instance){
		if (isset( $instance[ 'title' ])) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'Like Us On Facebook', 'text_domain' );
		}
		
		if (isset( $instance[ 'page_url' ])) {
			$page_url = esc_attr($instance[ 'page_url' ]);
		} else {
			$page_url = 'https://www.facebook.com/FacebookDevelopers';
		}
		
		if (isset( $instance[ 'width' ])) {
			$width = esc_attr($instance[ 'width' ]);
		} else {
			$width = 250;
		}
		if (isset( $instance[ 'height' ])) {
			$height = esc_attr($instance[ 'height' ]);
		} else {
			$height = 500;
		}
		
		if (isset( $instance[ 'color' ])) {
			$color = esc_attr($instance[ 'color' ]);
		} else {
			$color = 'light';
		}
		
		if (isset( $instance[ 'show_faces' ])) {
			$show_faces = esc_attr($instance[ 'show_faces' ]);
		} else {
			$show_faces = 'true';
		}
		
		if (isset( $instance[ 'show_header' ])) {
			$show_header = esc_attr($instance[ 'show_header' ]);
		} else {
			$show_header = 'true';
		}
		
		if (isset( $instance[ 'show_posts' ])) {
			$show_posts = esc_attr($instance[ 'show_posts' ]);
		} else {
			$show_posts = 'false';
		}
		
		if (isset( $instance[ 'show_border' ])) {
			$show_border = esc_attr($instance[ 'show_border' ]);
		} else {
			$show_border = 'true';
		}

		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" 
				id="<?php echo $this->get_field_id( 'title' ); ?>" 
				name="<?php echo $this->get_field_name( 'title' ); ?>" 
				type="text" value="<?php echo esc_attr( $title ); ?>"
		>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'page_url' ); ?>"><?php _e( 'Page URL:' ); ?></label> 
		<input class="widefat" 
				id="<?php echo $this->get_field_id( 'page_url' ); ?>" 
				name="<?php echo $this->get_field_name( 'page_url' ); ?>" 
				type="text" value="<?php echo esc_attr( $page_url ); ?>"
		>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'color' ); ?>"><?php _e( 'Color:' ); ?></label> 
		<select class="widefat" 
				id="<?php echo $this->get_field_id( 'color' ); ?>" 
				name="<?php echo $this->get_field_name( 'color' ); ?>" 
				type="text">
			<option value="light" <?php echo ($color == 'light')?'selected':''; ?>>Light</option>
			<option value="dark" <?php echo ($color == 'dark')?'selected':''; ?>>Dark</option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width:' ); ?></label> 
		<input class="widefat" 
				id="<?php echo $this->get_field_id( 'width' ); ?>" 
				name="<?php echo $this->get_field_name( 'width' ); ?>" 
				type="text" value="<?php echo esc_attr( $width ); ?>"
		>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height:' ); ?></label> 
		<input class="widefat" 
				id="<?php echo $this->get_field_id( 'height' ); ?>" 
				name="<?php echo $this->get_field_name( 'height' ); ?>" 
				type="text" value="<?php echo esc_attr( $height ); ?>"
		>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'show_faces' ); ?>"><?php _e( 'Show Faces:' ); ?></label> 
		<select class="widefat" 
				id="<?php echo $this->get_field_id( 'show_faces' ); ?>" 
				name="<?php echo $this->get_field_name( 'show_faces' ); ?>" 
				type="text">
			<option value="true" <?php echo ($show_faces == 'true')?'selected':''; ?>>True</option>
			<option value="false" <?php echo ($show_faces == 'false')?'selected':''; ?>>False</option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'show_header' ); ?>"><?php _e( 'Show Header:' ); ?></label> 
		<select class="widefat" 
				id="<?php echo $this->get_field_id( 'show_header' ); ?>" 
				name="<?php echo $this->get_field_name( 'show_header' ); ?>" 
				type="text">
			<option value="true" <?php echo ($show_header == 'true')?'selected':''; ?>>True</option>
			<option value="false" <?php echo ($show_header == 'false')?'selected':''; ?>>False</option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'show_posts' ); ?>"><?php _e( 'Show Posts:' ); ?></label> 
		<select class="widefat" 
				id="<?php echo $this->get_field_id( 'show_posts' ); ?>" 
				name="<?php echo $this->get_field_name( 'show_posts' ); ?>" 
				type="text">
			<option value="true" <?php echo ($show_posts == 'true')?'selected':''; ?>>True</option>
			<option value="false" <?php echo ($show_posts == 'false')?'selected':''; ?>>False</option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'show_border' ); ?>"><?php _e( 'Show Border:' ); ?></label> 
		<select class="widefat" 
				id="<?php echo $this->get_field_id( 'show_border' ); ?>" 
				name="<?php echo $this->get_field_name( 'show_border' ); ?>" 
				type="text">
			<option value="true" <?php echo ($show_border == 'true')?'selected':''; ?>>True</option>
			<option value="false" <?php echo ($show_border == 'false')?'selected':''; ?>>False</option>
		</select>
		</p>
		<?php 
	 }

} // class Foo_Widget
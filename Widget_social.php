<?php
add_action('widgets_init', 'social_widget');

function social_widget() {
    register_widget('Social');
}

class Social extends WP_Widget {

    function Social() {
        $widget_ops = array( 'classname' => 'social', 'description' => 'Виджет выводит иконки социальных сетей' );
        
        $control_ops = array( 'id_base' => 'social-widget' );
        
        $this->WP_Widget( 'social-widget', __('Социальная сеть', 'social'), $widget_ops, $control_ops );

    }
    
    function widget( $args, $instance ) {
        extract( $args );

        //Our variables from the widget settings.
        $social = $instance['social'];
        $text = apply_filters( 'widget_text', $instance['text'] );

        echo $before_widget;
        
        if ( $social == 'facebook' )        
            echo '<a href="' . $text . '" target="_blank"><i class="fa fa-facebook"></i>Facebook</a>';
        
        elseif ( $social == 'vk' )        
            echo '<a href="' . $text . '" target="_blank"><i class="fa fa-vk"></i>VK</a>';
        
        elseif ( $social == 'youtube' )        
            echo '<a href="' . $text . '" target="_blank"><i class="fa fa-youtube"></i>Youtube</a>';
        
        elseif ( $social == 'instagram' )        
            echo '<a href="' . $text . '" target="_blank"><i class="fa fa-instagram"></i>Instagram</a>';
        
        echo $after_widget;
    }

    //Update the widget 
     
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        //Strip tags from title and name to remove HTML
        $instance['text'] = $new_instance['text'];
        $instance['social'] = $new_instance['social'];
        
        return $instance;
    }

    
    function form( $instance ) {
        //Set up some default widget settings.
        $defaults = array( 'text' => '', 'social' => '' );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $social = $instance['social'];
        $text = esc_attr($instance['text']); ?>
        
        <p>
            <select style="width: 100%;" id="<?php echo $this->get_field_id('social'); ?>" name="<?php echo $this->get_field_name( 'social' ); ?>">
                <option value="facebook"<?php echo ( $social == 'facebook' ) ? ' selected' : ''; ?>>Facebook</option>
                <option value="vk"<?php echo ( $social == 'vk' ) ? ' selected' : ''; ?>>Вконтакте</option>
                <option value="instagram"<?php echo ( $social == 'instagram' ) ? ' selected' : ''; ?>>Instagram</option>
                <option value="youtube"<?php echo ( $social == 'youtube' ) ? ' selected' : ''; ?>>Youtube</option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'text' ); ?>">Ссылка</label><br>
            <input id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" value="<?php echo $instance['text']; ?>" style="width:100%;" />
        </p>

    <?php
    }
}
?>

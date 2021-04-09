<?php

namespace passster;

/**
 * PS_Meta Class
 */
class PS_Meta
{
    /**
     * Contains instance or null
     *
     * @var object|null
     */
    private static  $instance = null ;
    /**
     * Returns instance of PS_Meta.
     *
     * @return object
     */
    public static function get_instance()
    {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor for PS_Meta.
     */
    public function __construct()
    {
        add_action( 'add_meta_boxes', array( $this, 'add_metaboxes' ) );
        add_action( 'save_post', array( $this, 'save_metaboxes' ) );
    }
    
    /**
     * Adds the meta box container.
     *
     * @param array $post_type array of post types.
     * @return void
     */
    public function add_metaboxes( $post_type )
    {
        add_meta_box(
            'passster_global',
            __( 'Passster (Global Protection)', 'content-protector' ),
            array( $this, 'render_passster_global' ),
            apply_filters( 'passster_post_types', array( 'post', 'page', 'product' ) ),
            'side',
            'high'
        );
        add_meta_box(
            'passster',
            __( 'Passster (Page Protection)', 'content-protector' ),
            array( $this, 'render_passster' ),
            apply_filters( 'passster_post_types', array( 'post', 'page', 'product' ) ),
            'side',
            'high'
        );
        add_meta_box(
            'passster_link',
            __( 'Passster (Link Protection)', 'content-protector' ),
            array( $this, 'render_passster_link' ),
            apply_filters( 'passster_post_types', array( 'post', 'page', 'product' ) ),
            'side',
            'high'
        );
    }
    
    /**
     * Render file download metabox.
     *
     * @param WP_Post $post The post object.
     */
    public function render_passwords( $post )
    {
    }
    
    /**
     * Render file options metabox.
     *
     * @param WP_Post $post The post object.
     */
    public function render_advanced_options( $post )
    {
    }
    
    /**
     * Render file download metabox.
     *
     * @param WP_Post $post The post object.
     */
    public function render_passster_global( $post )
    {
        wp_nonce_field( 'passster_nonce_check', 'passster_nonce_check_value' );
        $activate_global_protection = get_post_meta( $post->ID, 'passster_activate_global_protection', true );
        // check if protection active.
        
        if ( true == $activate_global_protection ) {
            $activate_global_protection = 'checked="checked"';
        } else {
            $activate_global_protection = '';
        }
        
        ?>
		<div class="passster-meta passster-admin">
			<p>
				<span><?php 
        esc_html_e( 'Activate Global Protection', 'content-protector' );
        ?></span><br>
				<label class="switch" for="passster-activate-global-protection">
						<input type="checkbox" class="toggle-checkbox" id="passster-activate-global-protection" name="passster-activate-global-protection" value="true" <?php 
        echo  $activate_global_protection ;
        ?> />
					<span class="slider round"></span>
				</label>
			</p>
			<p>
				<?php 
        _e( 'Configure the password, texts and everything else in Passster (Page Protection).', 'content-protector' );
        ?>
			</p>
			<small>
				<?php 
        _e( 'If activated every page will be redirected to that page as long as the user does not have unlocked the content. The global protection requires the cookie option activated (set by default).', 'content-protector' );
        ?>
			</small>
		</div>
		<?php 
    }
    
    /**
     * Render file download metabox.
     *
     * @param WP_Post $post The post object.
     */
    public function render_passster( $post )
    {
        wp_nonce_field( 'passster_nonce_check', 'passster_nonce_check_value' );
        $activate_protection = get_post_meta( $post->ID, 'passster_activate_protection', true );
        $protection_type = get_post_meta( $post->ID, 'passster_protection_type', true );
        $password = get_post_meta( $post->ID, 'passster_password', true );
        // check if protection active.
        
        if ( true == $activate_protection ) {
            $activate_protection = 'checked="checked"';
        } else {
            $activate_protection = '';
        }
        
        $protection_types = array(
            'password' => __( 'Password', 'content-protector' ),
            'captcha'  => __( 'Captcha', 'content-protector' ),
        );
        ?>
		<div class="passster-meta passster-admin">
			<p>
				<span><?php 
        esc_html_e( 'Activate Protection', 'content-protector' );
        ?></span><br>
				<label class="switch" for="passster-activate-protection">
						<input type="checkbox" class="toggle-checkbox" id="passster-activate-protection" name="passster-activate-protection" value="true" <?php 
        echo  $activate_protection ;
        ?> />
					<span class="slider round"></span>
				</label>
			</p>
			<p>
				<label><?php 
        esc_html_e( 'Protection Type', 'content-protector' );
        ?></label><br>
				<select id="passster-protection-type" name="passster-protection-type">
					<?php 
        foreach ( $protection_types as $key => $value ) {
            ?>
						<?php 
            
            if ( $key === $protection_type ) {
                ?>
							<option selected="selected" value="<?php 
                echo  esc_attr( $key ) ;
                ?>"><?php 
                echo  esc_html( $value ) ;
                ?></option>
						<?php 
            } else {
                ?>
							<option value="<?php 
                echo  esc_attr( $key ) ;
                ?>"><?php 
                echo  esc_html( $value ) ;
                ?></option>
						<?php 
            }
            
            ?>
					<?php 
        }
        ?>
				</select>
			</p>
			<p class="passster-hide-option">
				<label><?php 
        esc_html_e( 'Password', 'content-protector' );
        ?></label><br>
				<input type="text" name="passster-password" id="passster-password" value="<?php 
        echo  esc_attr( $password ) ;
        ?>" />
			</p>
			<?php 
        ?>
			<?php 
        ?>
			<?php 
        ?>
			<?php 
        ?>
			<p>
				<?php 
        _e( 'With <b style="color:#7200e5">Passster Pro</b> you can also use multiple passwords, Password Lists, Google ReCaptcha v2/v3 and link protection.', 'content-protector' );
        ?>
			</p>
			<?php 
        ?>
		</div>
		<?php 
    }
    
    /**
     * Render file download metabox.
     *
     * @param WP_Post $post The post object.
     */
    public function render_passster_link( $post )
    {
        wp_nonce_field( 'passster_nonce_check', 'passster_nonce_check_value' );
        $link = get_post_meta( $post->ID, 'passster_link', true );
        // check if bitly active.
        
        if ( true == $bitly ) {
            $bitly_on = 'checked="checked"';
        } else {
            $bitly_on = '';
        }
        
        ?>
		<div class="passster-meta passster-admin">
			<?php 
        ?>
			<?php 
        ?>
			<p>
				<?php 
        _e( 'With <b style="color:#7200e5">Passster Pro</b> you can also use multiple passwords, Password Lists, Google ReCaptcha v2/v3 and link protection.', 'content-protector' );
        ?>
			</p>
			<?php 
        ?>
		</div>
		<?php 
    }
    
    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save_metaboxes( $post_id )
    {
        // Check if our nonce is set.
        if ( !isset( $_POST['passster_nonce_check_value'] ) ) {
            return $post_id;
        }
        // Verify that the nonce is valid.
        if ( !wp_verify_nonce( $_POST['passster_nonce_check_value'], 'passster_nonce_check' ) ) {
            return $post_id;
        }
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        // Check the user's permissions.
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
        // global protection meta.
        
        if ( isset( $_POST['passster-activate-global-protection'] ) && !empty($_POST['passster-activate-global-protection']) ) {
            update_post_meta( $post_id, 'passster_activate_global_protection', $_POST['passster-activate-global-protection'] );
            // Activate page protection also.
            update_post_meta( $post_id, 'passster_activate_protection', true );
            // Activate cookie setting.
            $general_settings = wp_parse_args( get_option( 'passster_general_settings' ), PS_Admin::get_defaults( 'passster_general_settings' ) );
            $general_settings['toggle_cookie'] = 'on';
            update_option( 'passster_general_settings', $general_settings );
            update_option( 'passster_global_id', $post_id );
        } else {
            update_post_meta( $post_id, 'passster_activate_global_protection', null );
            //delete_option( 'passster_global_id' );
        }
        
        // page protection meta.
        
        if ( isset( $_POST['passster-activate-protection'] ) && !empty($_POST['passster-activate-protection']) ) {
            update_post_meta( $post_id, 'passster_activate_protection', $_POST['passster-activate-protection'] );
        } else {
            update_post_meta( $post_id, 'passster_activate_protection', null );
        }
        
        if ( isset( $_POST['passster-protection-type'] ) && !empty($_POST['passster-protection-type']) ) {
            update_post_meta( $post_id, 'passster_protection_type', sanitize_text_field( $_POST['passster-protection-type'] ) );
        }
        if ( isset( $_POST['passster-password'] ) && !empty($_POST['passster-password']) ) {
            update_post_meta( $post_id, 'passster_password', sanitize_text_field( $_POST['passster-password'] ) );
        }
    }

}
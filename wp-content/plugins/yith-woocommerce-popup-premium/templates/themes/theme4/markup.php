<?php
/**
 * Popup Theme 4 Template
 *
 * @author YITH
 * @package YITH WooCommerce Popup
 * @version 1.0.0
 *
 * @var int $popup_id
 * @var string $hiding_text
 */

if ( ! defined( 'YITH_YPOP_INIT' ) ) {
	exit;
} // Exit if accessed directly


$theme = '_theme4';
/* CONTENT */
$header_content = nl2br( YITH_Popup()->get_meta( $theme . '_header_title', $popup_id ) );
$footer_content = nl2br( YITH_Popup()->get_meta( $theme . '_footer_content', $popup_id ) );


/* LAYOUT */
$width                        = YITH_Popup()->get_meta( $theme . '_width', $popup_id );
$height                       = YITH_Popup()->get_meta( $theme . '_height', $popup_id );
$background_image             = apply_filters( 'ywpop_get_background_image', YITH_Popup()->get_meta( $theme . '_bg_image', $popup_id ), $theme, $popup_id );
$background_color             = YITH_Popup()->get_meta( $theme . '_body_bg_color', $popup_id );
$content_link_color           = YITH_Popup()->get_meta( $theme . '_content_link_color', $popup_id );
$content_link_color_hover     = YITH_Popup()->get_meta( $theme . '_content_link_color_hover', $popup_id );
$content_text_color           = YITH_Popup()->get_meta( $theme . '_text_color', $popup_id );
$submit_button_color          = YITH_Popup()->get_meta( $theme . '_submit_button_color', $popup_id );
$submit_button_bg_color       = YITH_Popup()->get_meta( $theme . '_submit_button_bg_color', $popup_id );
$submit_button_bg_color_hover = YITH_Popup()->get_meta( $theme . '_submit_button_bg_color_hover', $popup_id );

$close_button_icon     = YITH_Popup()->get_meta( '_close_button_icon', $popup_id );
$close_button_bg_color = YITH_Popup()->get_meta( '_close_button_background_color', $popup_id );
$content_type          = YITH_Popup()->get_meta( '_content_type', $popup_id );

$overlay_opacity = YITH_Popup()->get_meta( '_overlay_opacity', $popup_id );
$overlay_color   = YITH_Popup()->get_meta( '_overlay_color', $popup_id );

$checkzone_bg_color   = YITH_Popup()->get_meta( '_checkzone_bg_color', $popup_id );
$checkzone_text_color = YITH_Popup()->get_meta( '_checkzone_text_color', $popup_id );


/* Close icon */
if ( $close_button_icon == 'custom' ) {
	$close_button_icon_url = YITH_Popup()->get_meta( '_close_button_custom_icon', $popup_id );
} else {
	$close_button_icon_url = YITH_YPOP_ASSETS_URL . '/images/close-buttons/' . $close_button_icon . '.png';
}

/* Content type */
$template_part = '';
$shortcode     = '';
$args          = array(
	'popup_id' => $popup_id,
	'theme'    => $theme,
);

switch ( $content_type ) :
	case 'newsletter':
		$newsletter_integration = YITH_Popup()->get_meta( '_newsletter-integration', $popup_id );

		$template_part = '/newsletters/' . $newsletter_integration . '.php';
		break;
	case 'form':
		$form_type = YITH_Popup()->get_meta( '_form-type', $popup_id );
		$form      = YITH_Popup()->get_meta( '_form-' . $form_type, $popup_id );

		switch ( $form_type ) {
			case 'contact-form-7':
				$shortcode = '[contact-form-7 id="' . $form . '"]';
				break;
			case 'yit-contact-form':
				$shortcode = '[contact_form name="' . $form . '"]';
				break;
			default:
		}
		break;
	case 'social':
		$args['icon'] = YITH_Popup()->get_meta( '_social_view_icon', $popup_id );

		$args['socials']['facebook'] = array(
			'button' => YITH_Popup()->get_meta( '_facebook_button', $popup_id ),
			'url'    => YITH_Popup()->get_meta( '_facebook_url', $popup_id ),
		);

		$args['socials']['twitter'] = array(
			'button' => YITH_Popup()->get_meta( '_twitter_button', $popup_id ),
			'url'    => YITH_Popup()->get_meta( '_twitter_url', $popup_id ),
		);

		$args['socials']['google'] = array(
			'button' => YITH_Popup()->get_meta( '_google_button', $popup_id ),
			'url'    => YITH_Popup()->get_meta( '_google_url', $popup_id ),
		);

		$args['socials']['linkedin'] = array(
			'button' => YITH_Popup()->get_meta( '_linkedin_button', $popup_id ),
			'url'    => YITH_Popup()->get_meta( '_linkedin_url', $popup_id ),
		);

		$args['socials']['pinterest'] = array(
			'button' => YITH_Popup()->get_meta( '_pinterest_button', $popup_id ),
			'url'    => YITH_Popup()->get_meta( '_pinterest_url', $popup_id ),
		);

		$template_part = '/misc/social.php';
		break;
	case 'woocommerce':
		$template_part             = '/misc/woocommerce.php';
		$args['product_from']      = YITH_Popup()->get_meta( '_ypop_product_from', $popup_id );
		$args['products']          = YITH_Popup()->get_meta( '_ypop_products', $popup_id );
		$args['category']          = YITH_Popup()->get_meta( '_ypop_category', $popup_id );
		$args['show_title']        = YITH_Popup()->get_meta( '_show_title', $popup_id );
		$args['show_thumbnail']    = YITH_Popup()->get_meta( '_show_thumbnail', $popup_id );
		$args['show_price']        = YITH_Popup()->get_meta( '_show_price', $popup_id );
		$args['show_add_to_cart']  = YITH_Popup()->get_meta( '_show_add_to_cart', $popup_id );
		$args['add_to_cart_label'] = YITH_Popup()->get_meta( '_add_to_cart_label', $popup_id );
		$args['show_summary']      = YITH_Popup()->get_meta( '_show_summary', $popup_id );
		$args['redirect_opt']      = YITH_Popup()->get_meta( '_redirect_after_add_to_cart', $popup_id );
		break;
	default:
endswitch;

?>
<style>
	.ypop-overlay{
		background-color: <?php echo esc_attr( $overlay_color ); ?>;
		opacity: <?php echo esc_attr( $overlay_opacity / 100 ); ?>;
	}

	.ypop-wrapper{
		width: <?php echo esc_attr( $width ); ?>px;
		height: <?php echo ( $height ) ? esc_attr( $height ) . 'px' : 'auto'; ?>;
		padding: 15px;
	}
	.ypop-container-inner{
		background-color: <?php echo esc_attr( $background_color ); ?>;
	<?php if ( $background_image != '' ) : ?>
		background: <?php echo esc_attr( $background_color ); ?> url(<?php echo esc_url( $background_image ); ?> ) no-repeat center center;
	<?php endif; ?>

		background-size: cover;
	}

	.ypop-container{
		width: <?php echo esc_attr( $width ); ?>px;
		height: <?php echo ( $height ) ? esc_attr( $height ) . 'px' : 'auto'; ?>;
	}

	.ypop-container-inner a{
		color: <?php echo esc_attr( $content_link_color ); ?>;
	}

	.ypop-container-inner a:hover{
		color: <?php echo esc_attr( $content_link_color_hover ); ?>;
	}

	.ypop-content,
	.ypop-content h2, .ypop-content h3, .ypop-content h4
	{
		color: <?php echo esc_attr( $content_text_color ); ?>;
	}

	.ypop-wrapper a.close{
		background-image: url(<?php echo esc_url( $close_button_icon_url ); ?>);
		background-color: <?php echo esc_attr( $close_button_bg_color ); ?>;
		background-position: center center ;
		background-repeat: no-repeat;
	}

	.ypop-wrapper button,
	.ypop-content-type .contact-form input[type=submit],
	div.wpcf7 input[type=submit],
	.ypop-product-wrapper .add_to_cart a{
		background-color: <?php echo esc_attr( $submit_button_bg_color ); ?>;
		color: <?php echo esc_attr( $submit_button_color ); ?>;
		border-color: <?php echo esc_attr( $submit_button_bg_color_hover ); ?>;
	}

	.ypop-wrapper button:hover, .ypop-wrapper button:active,
	.ypop-content-type .contact-form input[type=submit]:hover, .ypop-content-type .contact-form input[type=submit]:active,
	div.wpcf7 input[type=submit]:hover, div.wpcf7 input[type=submit]:active,
	.ypop-product-wrapper .add_to_cart a:hover,  .ypop-product-wrapper .add_to_cart a:active{
		background-color: <?php echo esc_attr( $submit_button_bg_color_hover ); ?>;
	}

	.ypop-checkzone{
		background-color: <?php echo esc_attr( $checkzone_bg_color ); ?>;
	}

	.ypop-checkzone label{
		color:  <?php echo esc_attr( $checkzone_text_color ); ?>;
	}

</style>
<div class="ypop-modal">
	<div class="ypop-overlay"></div>
	<div class="ypop-wrapper">
		<!-- yit-newsletter-popup -->
		<div class="ypop-container">
			<div class="ypop-container-inner">
				<div class="ypop-content-wrapper">
					<div class="ypop-content">
						<div class="ypop-header">
							<?php echo wp_kses_post( do_shortcode( $header_content ) ); ?>
						</div>
						<div class="ypop-content-type">
							<?php
							if ( $template_part != '' ) {
								yit_plugin_get_template( YITH_YPOP_DIR, $template_part, $args ); //phpcs:ignore
							} elseif ( $shortcode != '' ) {
								echo do_shortcode( $shortcode ); //phpcs:ignore
							}
							?>
						</div>
					</div>
				</div>

				<!-- ypop-border -->
				<div class="ypop-footer">
					<?php echo do_shortcode( $footer_content ); //phpcs:ignore ?>
				</div>
				<div class="ypop-checkzone">
					<label for="hideforever">
						<input type="checkbox" id="hideforever" name="no-view" class="no-view yith-popup-checkbox"><span>&nbsp;</span><?php echo wp_kses_post( $hiding_text ); ?>
					</label>
				</div>
			</div>
		</div>
		<!-- ypop-container -->
		<!-- END yit-newsletter-popup -->
	</div>
</div>

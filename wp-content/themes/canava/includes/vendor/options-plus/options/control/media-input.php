<?php
/**
 * WARNING: This file is part of the OptionsPlus library. DO NOT edit
 * this file under any circumstances.
 */
namespace OptionsPlus\Options\Control;

/**
 * Prevent direct access to this file
 */
defined( 'ABSPATH' ) or die();


/**
 * This class will be present an videopicker control
 */
class MediaInput extends \OptionsPlus\Options\Control
{
	/**
	 * The control type
	 * 
	 * @var  string
	 */
	public $type = 'media-input';

	/**
	 * Library type of media manager
	 * 
	 * @var  string
	 */
	public $library;

	/**
	 * Enqueue control scripts
	 * 
	 * @return  void
	 */
	public function enqueue() {
		wp_enqueue_script( 'wp-plupload' );
		wp_enqueue_media();
	}
	
	/**
	 * Render the control markup
	 * 
	 * @return  void
	 */
	public function render_content() {
		$name = '_options-media-input-' . esc_attr( $this->id );
		$value = $this->value();
		?>
			<div class="options-control-inputs" data-library="<?php echo esc_attr( $this->library ) ?>">
				<input type="text" name="op-options[<?php echo esc_attr( $this->id ) ?>]" value="<?php echo esc_attr( $value ) ?>" />
				<button type="button" class="button button-browse"><?php esc_html_e( 'Browse...', 'canava' ) ?></button>
			</div>
		<?php
	}
}

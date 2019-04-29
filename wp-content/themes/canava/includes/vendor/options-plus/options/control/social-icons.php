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
 * This class will be present an social icons control
 */
class SocialIcons extends \OptionsPlus\Options\Control
{
	/**
	 * The control type
	 * 
	 * @var  string
	 */
	public $type = 'social-icons';

	public function render_content() {
		$name = '_options-social-icons-' . $this->id;
		$icons = op_available_social_icons();

		$value = $this->value();
		$order = $icons['__icons_ordering__'];

		if ( ! is_array( $value ) ) {
			$decoded_value = json_decode( trim( $value, '"' ), true );
			$value = is_array( $decoded_value ) ? $decoded_value : array();
		}

		if ( isset( $value['__icons_ordering__'] ) && is_array( $value['__icons_ordering__'] ) )
			$order = $value['__icons_ordering__'];
		?>

			<ul class="icons">
				<li class="item-properties">
					<label>
						<span class="input-title"></span>
						<input type="text" class="input-field" />
					</label>
					<button type="button" class="button button-primary confirm"><i class="fa fa-check"></i></button>
				</li>

				<?php foreach ( $order as $id ):
					$params = $icons[$id];
					?>
					<li class="item" data-id="<?php echo esc_attr( $id ) ?>"
						<?php isset( $value[$id] ) ? printf( 'data-link="%s"', esc_attr( $value[$id] ) ) : ''; ?>
						data-title="<?php echo esc_attr( $params['title'] ) ?>">
						<i class="fa <?php echo esc_attr( $params['icon_class'] ) ?>"></i>
					</li>
				<?php endforeach ?>
			</ul>
			<input type="hidden" name="op-options[<?php echo esc_attr( $this->id ) ?>]" value="<?php echo esc_attr( json_encode( $this->value() ) ) ?>" />
		<?php
	}
}

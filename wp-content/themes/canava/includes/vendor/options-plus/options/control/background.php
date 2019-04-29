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
 * This class will be present an colorpicker control
 */
class Background extends \OptionsPlus\Options\Control
{
	/**
	 * The control type
	 * 
	 * @var  string
	 */
	public $type = 'background';

	/**
	 * List of predefined background patterns
	 * 
	 * @var  array
	 */
	public $patterns;

	/**
	 * Enqueue assets for this control
	 * 
	 * @return  void
	 */
	public function enqueue() {
		wp_enqueue_style( 'op-colpick' );
		wp_enqueue_script( 'op-colpick' );
		wp_enqueue_script( 'wp-plupload' );
	}
	
	/**
	 * Render the control markup
	 * 
	 * @return  void
	 */
	public function render_content() {
		$name = '_options-control-background-' . $this->id;
		$values = $this->value();
		$default = array(
			'type'     => 'none',
			'pattern'  => 'none',
			'color'    => '#fff',
			'image'    => '',
			'repeat'   => 'repeat',
			'position' => 'top-left',
			'style'    => 'scroll'
		);

		if ( ! is_array( $values ) )
			$values = $default;
		else
			$values = array_merge( $default, $values );
		?>
			<div class="options-control-inputs">
				<div class="background-color">
					<div class="options-control-color-picker">
						<div class="options-control-inputs">
							<input type="text" id="<?php echo esc_attr( $name ) ?>-color" name="op-options[<?php echo esc_attr( $this->id ) ?>][color]" value="<?php echo esc_attr( $values['color'] ) ?>" />
							<button type="button" class="options-control-preview" style="background-color: <?php echo esc_attr( $values['color'] ) ?>;"></button>
							<div class="colorpicker-panel"></div>
						</div>
					</div>
				</div>

				<div class="background-type">
					<label>
						<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][type]" value="none" <?php checked( $values['type'], 'none' ) ?> />
						<span><?php esc_html_e( 'None', 'canava' ) ?></span>
					</label>
					<label>
						<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][type]" value="patterns" <?php checked( $values['type'], 'patterns' ) ?> />
						<span><?php esc_html_e( 'Patterns', 'canava' ) ?></span>
					</label>
					<label>
						<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][type]" value="custom" <?php checked( $values['type'], 'custom' ) ?> />
						<span><?php esc_html_e( 'Custom', 'canava' ) ?></span>
					</label>
				</div>
				
				<div class="background-patterns">
					<label>
						<input type="radio" value="none" name="op-options[<?php echo esc_attr( $this->id ) ?>][pattern]" <?php checked( $values['pattern'], 'none' ) ?> />
						<span> </span>
					</label>

					<?php foreach ( $this->patterns as $id => $url ): ?>
					<label>
						<input type="radio" value="<?php echo esc_attr( $id ) ?>" name="op-options[<?php echo esc_attr( $this->id ) ?>][pattern]" <?php checked( $values['pattern'], $id ) ?> />
						<span style="background: url(<?php echo esc_url( $url ) ?>)"> </span>
					</label>
					<?php endforeach ?>
				</div>

				<div class="background-custom">
					<div class="options-control-media-picker background-image">
						<div class="options-control-title"><?php esc_html_e( 'Background Image', 'canava' ) ?></div>
						<div class="options-control-inputs">
							<div class="upload-dropzone">
								<span class="upload-message">
									<?php esc_html_e( 'Drop a file here or', 'canava' ) ?>
									<a href="#" class="browse-media"><?php esc_html_e( 'select a file', 'canava' ) ?></a>
									<a href="#" class="upload"></a>
								</span>
								<span class="upload-preview"></span>
							</div>
							<a href="#" class="button remove"><?php esc_html_e( 'Remove', 'canava' ) ?></a>
						</div>
						<input type="hidden" name="op-options[<?php echo esc_attr( $this->id ) ?>][image]" value="<?php echo esc_attr( $values['image'] ) ?>" />
					</div>

					<div class="options-control-radio-images background-repeat">
						<div class="options-control-title"><?php esc_html_e( 'Background Repeat', 'canava' ) ?></div>
						<div class="options-control-inputs">
							<label class="background-no-repeat">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][repeat]" value="no-repeat" <?php checked( $values['repeat'], 'no-repeat' ) ?> />
								<span data-title="<?php echo esc_attr( 'No Repeat', 'canava' ) ?>"><?php esc_html_e( 'No Repeat', 'canava' ) ?></span>
							</label>
							<label class="background-repeat-x">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][repeat]" value="repeat-x" <?php checked( $values['repeat'], 'repeat-x' ) ?> />
								<span data-title="<?php echo esc_attr( 'Repeat X', 'canava' ) ?>"><?php esc_html_e( 'Repeat X', 'canava' ) ?></span>
							</label>
							<label class="background-repeat-y">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][repeat]" value="repeat-y" <?php checked( $values['repeat'], 'repeat-y' ) ?> />
								<span data-title="<?php echo esc_attr( 'Repeat Y', 'canava' ) ?>"><?php esc_html_e( 'Repeat Y', 'canava' ) ?></span>
							</label>
							<label class="background-repeat-all">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][repeat]" value="repeat" <?php checked( $values['repeat'], 'repeat' ) ?> />
								<span data-title="<?php echo esc_attr( 'Repeat All', 'canava' ) ?>"><?php esc_html_e( 'Repeat All', 'canava' ) ?></span>
							</label>
						</div>
					</div>

					<div class="options-control-radio-images background-position">
						<div class="options-control-title"><?php esc_html_e( 'Background Position', 'canava' ) ?></div>
						<div class="options-control-inputs">
							<label class="background-top-left">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][position]" value="top-left" <?php checked( $values['position'], 'top-left' ) ?> />
								<span data-title="<?php echo esc_attr( 'Top Left', 'canava' ) ?>"><?php esc_html_e( 'Top Left', 'canava' ) ?></span>
							</label>
							<label class="background-top-center">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][position]" value="top-center" <?php checked( $values['position'], 'top-center' ) ?> />
								<span data-title="<?php echo esc_attr( 'Top Center', 'canava' ) ?>"><?php esc_html_e( 'Top Center', 'canava' ) ?></span>
							</label>
							<label class="background-top-right">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][position]" value="top-right" <?php checked( $values['position'], 'top-right' ) ?> />
								<span data-title="<?php echo esc_attr( 'Top Right', 'canava' ) ?>"><?php esc_html_e( 'Top Right', 'canava' ) ?></span>
							</label>

							<label class="background-middle-left">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][position]" value="center-left" <?php checked( $values['position'], 'center-left' ) ?> />
								<span data-title="<?php echo esc_attr( 'Middle Left', 'canava' ) ?>"><?php esc_html_e( 'Middle Left', 'canava' ) ?></span>
							</label>
							<label class="background-middle-center">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][position]" value="center-center" <?php checked( $values['position'], 'center-center' ) ?> />
								<span data-title="<?php echo esc_attr( 'Middle Center', 'canava' ) ?>"><?php esc_html_e( 'Middle Center', 'canava' ) ?></span>
							</label>
							<label class="background-middle-right">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][position]" value="center-right" <?php checked( $values['position'], 'center-right' ) ?> />
								<span data-title="<?php echo esc_attr( 'Middle Right', 'canava' ) ?>"><?php esc_html_e( 'Middle Right', 'canava' ) ?></span>
							</label>

							<label class="background-bottom-left">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][position]" value="bottom-left" <?php checked( $values['position'], 'bottom-left' ) ?> />
								<span data-title="<?php echo esc_attr( 'Bottom Left', 'canava' ) ?>"><?php esc_html_e( 'Bottom Left', 'canava' ) ?></span>
							</label>
							<label class="background-bottom-center">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][position]" value="bottom-center" <?php checked( $values['position'], 'bottom-center' ) ?> />
								<span data-title="<?php echo esc_attr( 'Bottom Center', 'canava' ) ?>"><?php esc_html_e( 'Bottom Center', 'canava' ) ?></span>
							</label>
							<label class="background-bottom-right">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][position]" value="bottom-right" <?php checked( $values['position'], 'bottom-right' ) ?> />
								<span data-title="<?php echo esc_attr( 'Bottom Right', 'canava' ) ?>"><?php esc_html_e( 'Bottom Right', 'canava' ) ?></span>
							</label>
						</div>
					</div>

					<div class="options-control-radio-images background-style">
						<div class="options-control-title"><?php esc_html_e( 'Background Style', 'canava' ) ?></div>
						<div class="options-control-inputs">
							<label class="background-fixed">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][style]" value="fixed" <?php checked( $values['style'], 'fixed' ) ?> />
								<span data-title="<?php echo esc_attr( 'Fixed', 'canava' ) ?>"><?php esc_html_e( 'Fixed', 'canava' ) ?></span>
							</label>
							<label class="background-scroll">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][style]" value="scroll" <?php checked( $values['style'], 'scroll' ) ?> />
								<span data-title="<?php echo esc_attr( 'Scroll', 'canava' ) ?>"><?php esc_html_e( 'Scroll', 'canava' ) ?></span>
							</label>
							<label class="background-cover">
								<input type="radio" name="op-options[<?php echo esc_attr( $this->id ) ?>][style]" value="cover" <?php checked( $values['style'], 'cover' ) ?> />
								<span data-title="<?php echo esc_attr( 'Cover', 'canava' ) ?>"><?php esc_html_e( 'Cover', 'canava' ) ?></span>
							</label>
						</div>
					</div>
				</div>
			</div>
		<?php
	}
}

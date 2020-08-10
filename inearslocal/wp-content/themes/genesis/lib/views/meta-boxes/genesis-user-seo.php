<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package StudioPress\Genesis
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

?>
<h2><?php esc_html_e( 'Author Archive SEO Settings', 'genesis' ); ?></h2>
<p><span class="description"><?php esc_html_e( 'These settings apply to this author\'s archive pages.', 'genesis' ); ?></span></p>
<table class="form-table">
	<tbody>
		<tr>
			<th scope="row"><label for="genesis-meta[doctitle]"><?php esc_html_e( 'Custom Document Title', 'genesis' ); ?></label></th>
			<td>
				<input name="genesis-meta[doctitle]" id="genesis-meta[doctitle]" type="text" value="<?php echo esc_attr( get_the_author_meta( 'doctitle', $object->ID ) ); ?>" class="regular-text" />
				<p class="description"><?php esc_html_e( 'The Custom Document Title sets the page title as seen in browsers and search engines. ', 'genesis' ); ?></p>
			</td>
		</tr>

		<tr>
			<th scope="row"><label for="genesis-meta[meta-description]"><?php esc_html_e( 'Meta Description', 'genesis' ); ?></label></th>
			<td>
				<textarea name="genesis-meta[meta_description]" id="genesis-meta[meta-description]" rows="5" cols="30"><?php echo esc_textarea( get_the_author_meta( 'meta_description', $object->ID ) ); ?></textarea>
				<p class="description"><?php esc_html_e( 'Text entered in the Meta Description field is used as the short page description under the title on search engine results pages.', 'genesis' ); ?></p>
			</td>
		</tr>

		<tr>
			<th scope="row"><label for="genesis-meta[meta-keywords]"><?php esc_html_e( 'Meta Keywords', 'genesis' ); ?></label></th>
			<td>
				<input name="genesis-meta[meta_keywords]" id="genesis-meta[meta-keywords]" type="text" value="<?php echo esc_attr( get_the_author_meta( 'meta_keywords', $object->ID ) ); ?>" class="regular-text" /><br />
				<p class="description"><?php esc_html_e( 'A comma-separated list of keywords relevant to the page can be entered in the Meta Keywords field. Keywords are generally ignored by Search Engines.', 'genesis' ); ?></p>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php esc_html_e( 'Robots Meta', 'genesis' ); ?>
				<a href="https://yoast.com/robots-meta-tags/" target="_blank" rel="noopener noreferrer">[?]</a>
			</th>
			<td>
				<label for="genesis-meta[noindex]"><input id="genesis-meta[noindex]" name="genesis-meta[noindex]" type="checkbox" value="1" <?php checked( get_the_author_meta( 'noindex', $object->ID ) ); ?> />
				<?php
				/* translators: %s: robots meta content attribute value, such as 'noindex', 'nofollow' or 'noarchive'. */
				printf( esc_html__( 'Apply %s to this archive?', 'genesis' ), genesis_code( 'noindex' ) );
				?>
				</label>
				<br />

				<label for="genesis-meta[nofollow]"><input id="genesis-meta[nofollow]" name="genesis-meta[nofollow]" type="checkbox" value="1" <?php checked( get_the_author_meta( 'nofollow', $object->ID ) ); ?> />
				<?php
				/* translators: %s: robots meta content attribute value, such as 'noindex', 'nofollow' or 'noarchive'. */
				printf( esc_html__( 'Apply %s to this archive?', 'genesis' ), genesis_code( 'nofollow' ) );
				?>
				</label><br />

				<label for="genesis-meta[noarchive]"><input id="genesis-meta[noarchive]" name="genesis-meta[noarchive]" type="checkbox" value="1" <?php checked( get_the_author_meta( 'noarchive', $object->ID ) ); ?> />
				<?php
				/* translators: %s: robots meta content attribute value, such as 'noindex', 'nofollow' or 'noarchive'. */
				printf( esc_html__( 'Apply %s to this archive?', 'genesis' ), genesis_code( 'noarchive' ) );
				?>
				</label>
			</td>
		</tr>
	</tbody>
</table>

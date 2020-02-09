<div class="<?php echo $module->get_classname(); ?>">
	<?php if ( isset( $settings->click_action ) && 'lightbox' == $settings->click_action ) : ?>
		<a href="<?php echo 'video' == $settings->lightbox_content_type ? $settings->lightbox_video_link : '#'; ?>" class="<?php echo $module->get_bs_classname(); ?> fl-bs-button-lightbox<?php echo ( 'enable' == $settings->icon_animation ) ? ' fl-bs-button-icon-animation' : ''; ?>" role="button">
	<?php else : ?>
		<a href="<?php echo $settings->link; ?>" target="<?php echo $settings->link_target; ?>" class="<?php echo $module->get_bs_classname(); ?> <?php echo ( 'enable' == $settings->icon_animation ) ? ' fl-bs-button-icon-animation' : ''; ?>" role="button"<?php echo $module->get_rel(); ?>>
	<?php endif; ?>
		<?php if ( ! empty( $settings->icon ) && ( 'before' == $settings->icon_position || ! isset( $settings->icon_position ) ) ) : ?>
		<i class="fl-bs-button-icon fl-bs-button-icon-before <?php echo $settings->icon; ?>" aria-hidden="true"></i>
		<?php endif; ?>
		<?php if ( ! empty( $settings->text ) ) : ?>
		<span class="fl-bs-button-text"><?php echo $settings->text; ?></span>
		<?php endif; ?>
		<?php if ( ! empty( $settings->icon ) && 'after' == $settings->icon_position ) : ?>
		<i class="fl-bs-button-icon fl-bs-button-icon-after <?php echo $settings->icon; ?>" aria-hidden="true"></i>
		<?php endif; ?>
	</a>
</div>
<?php if ( 'lightbox' == $settings->click_action && 'html' == $settings->lightbox_content_type && isset( $settings->lightbox_content_html ) ) : ?>
	<div class="fl-node-<?php echo $id; ?> fl-bs-button-lightbox-content mfp-hide">
		<?php echo $settings->lightbox_content_html; ?>
	</div>
<?php endif; ?>

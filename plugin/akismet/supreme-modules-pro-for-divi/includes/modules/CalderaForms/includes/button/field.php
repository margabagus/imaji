<?php

$btnType    = $field['config']['type'];
$btn_action = null;

$attrs = array(
	'class'      => $field['config']['class'],
	'type'       => $btnType,
	'name'       => $field_name,
	'id'         => $field_id,
	'value'      => $field['label'],
	'data-field' => $field_base_id,
);



if ( $field['config']['type'] == 'next' || $field['config']['type'] == 'prev' ) {
	$btnType                  = 'button';
	$attrs['data-page']       = $field['config']['type'];
	$field['config']['class'] = $field['config']['class'] . ' cf-page-btn cf-page-btn-' . $field['config']['type'];
} elseif ( 'button' == $field['config']['type'] ) {
	$btnType = 'button';
	if ( ! empty( $field['config']['target'] ) ) {
		$field['config']['class'] .= ' cf-form-trigger';
		$attrs['data-target']      = esc_attr( $field['config']['target'] );
	}
} elseif ( 'reset' == $field['config']['type'] ) {
	$btnType = 'reset';
} else {
	$btnType = 'submit';
}

if ( ! empty( $field['config']['class'] ) ) {
	// add css.
	$attrs['class'] = $field['config']['class'] . ' et_pb_button dsm-cf-submit-button';
}

$attrs['type'] = $btnType;
// get btn value.
$dsm_btn_value = $attrs['value'];

$attr_string_button = caldera_forms_field_attributes( $attrs, $field, $form );

$attrs                    = array(
	'class'      => 'button_trigger_' . Caldera_Forms_Render_Util::get_current_form_count(),
	'type'       => 'hidden',
	'name'       => $field_name,
	'id'         => $field_id . '_btn',
	'value'      => $field_value,
	'data-field' => $field_base_id,
);
$attr_string_hidden_field = caldera_forms_implode_field_attributes( caldera_forms_escape_field_attributes_array( $attrs ) );

?>
<?php echo et_core_intentionally_unescaped( $wrapper_before, 'html' ); ?>
<?php if ( ! empty( $field['config']['label_space'] ) ) { ?>
	<label class="control-label">&nbsp;</label>
<?php } ?>

<?php /* echo $field_before; */ ?>
	<div class="et_pb_button_module_wrapper">
		<button <?php echo et_core_intentionally_unescaped( $attr_string_button . ' ' . $field_structure['aria'], 'html' ); ?>><?php echo et_core_intentionally_unescaped( $dsm_btn_value, 'html' ); ?></button>
	</div>
<?php /* echo $field_after; */ ?>
<?php echo et_core_intentionally_unescaped( $wrapper_after, 'html' ); ?>
	<input <?php echo et_core_intentionally_unescaped( $attr_string_hidden_field, 'html' ); ?> />
<?php
ob_start();
?>
<script>	
	window.addEventListener("load", function(){

		jQuery(document).on('click dblclick', '#<?php echo et_core_intentionally_unescaped( $field_id, 'html' ); ?>', function( e ){
			jQuery('#<?php echo et_core_intentionally_unescaped( $field_id, 'html' ); ?>_btn').val( e.type ).trigger('change');
		});

	});
</script>
<?php
	$script_template = ob_get_clean();
	Caldera_Forms_Render_Util::add_inline_data( $script_template, $form );

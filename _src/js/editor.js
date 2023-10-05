import "../scss/style-editor.scss";

wp.domReady( () => {

	wp.blocks.unregisterBlockStyle(
		'core/separator', [ 'default', 'wide', 'dots' ]
	);
	
});
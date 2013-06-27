/**
 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

// Toolbar configuration generated automatically by the editor based on config.toolbarGroups.
config.toolbar = 'Full';
config.toolbar_Full = [
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source'/*, '-', 'Save', 'NewPage', 'Preview', 'Print', '-'*/ ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', 'Templates' ] },
	//{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
	//{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
	{ name: 'insert', items: [ 'Image', 'Flash', 'Iframe', 'Table', 'HorizontalRule'/*, 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' */] },
	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
	'/',
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
	'/',
	{ name: 'styles', items: [ 'Styles', 'Format'/*, 'Font'*/, 'FontSize' ] },
	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] }
	//{ name: 'others', items: [ '-' ] },
	//{ name: 'about', items: [ 'About' ] }
];
config.toolbar_Basic = [
	{ name: 'document', groups: [ 'mode' ], items: [ 'Source'] },
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', '-', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'BidiLtr', 'BidiRtl' ] }
]
	// Toolbar groups configuration.
	config.toolbarGroups = null;

    config.height = 420;
    config.width = 700;

	config.bodyClass = 'ck';
	config.format_tags = 'h3;h4;h5;h6;pre;address;div;p';

    config.enterMode = CKEDITOR.ENTER_BR;
};


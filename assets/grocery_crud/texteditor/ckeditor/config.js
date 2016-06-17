/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.skin = 'bootstrapck';
	// added code for ckfinder ------>
	 config.filebrowserBrowseUrl = '/ControlEscolar/assets/grocery_crud/texteditor/ckfinder/ckfinder.html';
	 config.filebrowserImageBrowseUrl = '/ControlEscolar/assets/grocery_crud/texteditor/ckfinder/ckfinder.html?type=Images';
	 config.filebrowserFlashBrowseUrl = '/ControlEscolar/assets/grocery_crud/texteditor/ckfinder/ckfinder.html?type=Flash';
	 config.filebrowserUploadUrl = '/ControlEscolar/assets/grocery_crud/texteditor/ckfinder/core/connector /php/connector.php?command=QuickUpload&type=Files';
	 config.filebrowserImageUploadUrl = '/ControlEscolar/assets/grocery_crud/texteditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	 config.filebrowserFlashUploadUrl = '/ControlEscolar/assets/grocery_crud/texteditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
// end: code for ckfinder ------>
};

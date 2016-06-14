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
	 config.filebrowserBrowseUrl = '/grocery/assets/grocery_crud/texteditor/ckfinder/ckfinder.html';
	 config.filebrowserImageBrowseUrl = '/grocery/assets/grocery_crud/texteditor/ckfinder/ckfinder.html?type=Images';
	 config.filebrowserFlashBrowseUrl = '/grocery/assets/grocery_crud/texteditor/ckfinder/ckfinder.html?type=Flash';
	 config.filebrowserUploadUrl = '/grocery/assets/grocery_crud/texteditor/ckfinder/core/connector /php/connector.php?command=QuickUpload&type=Files';
	 config.filebrowserImageUploadUrl = '/grocery/assets/grocery_crud/texteditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	 config.filebrowserFlashUploadUrl = '/grocery/assets/grocery_crud/texteditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
// end: code for ckfinder ------>
};

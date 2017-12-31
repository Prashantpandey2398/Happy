/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    // Define the toolbar: http://docs.ckeditor.com/#!/guide/dev_toolbar
    // The full preset from CDN which we used as a base provides more features than we need.
    // Also by default it comes with a 3-line toolbar. Here we put all buttons in a single row.
    config.toolbarGroups = [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
        { name: 'styles', groups: [ 'styles' ] },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'links', groups: [ 'links' ] },
        { name: 'paragraph', groups: [ 'blocks', 'list', 'align', 'indent', 'bidi', 'paragraph' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
        { name: 'forms', groups: [ 'forms' ] },
        { name: 'insert', groups: [ 'insert' ] },
        { name: 'colors', groups: [ 'colors' ] },
        { name: 'tools', groups: [ 'tools' ] },
        { name: 'others', groups: [ 'others' ] },
        { name: 'about', groups: [ 'about' ] }
    ];

    config.removeButtons = 'Form,Scayt,Source,Templates,NewPage,SelectAll,Radio,TextField,Textarea,TextColor,Maximize,About,Image,CreateDiv,BidiRtl,BidiLtr,Anchor,Unlink,Flash,Language,HorizontalRule,Table,Smiley,SpecialChar,PageBreak,Iframe,BGColor,ShowBlocks,RemoveFormat,Strike,Subscript,Superscript,ImageButton,Button,HiddenField,Find,Checkbox,Select,Save';

};

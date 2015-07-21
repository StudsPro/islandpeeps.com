// Add WYSIWYG editing events into the Text Editor.
var hb_silk_icon_set_blue = $("#htmlbox_silk_icon_set_blue").css("height","300").css("width","600").htmlbox({
    toolbars:[
	     ["separator_dots","bold","italic","underline","strike","sub","sup","separator_dots","undo","redo","separator_dots",
		 "left","center","right","justify","separator_dots","ol","ul","indent","outdent","separator_dots","link","unlink","image"],
		
	],
	icons:"silk",
	skin:"deeppink"
});
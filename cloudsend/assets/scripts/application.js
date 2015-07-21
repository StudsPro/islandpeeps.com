/**
 * CloudSend
 *
 * @package    CloudSend
 * @author     codingking.co
 * @copyright  Copyright (c) 2013 codingking.co - all rights reserved
 * @license    Commercial
 * @link       http://www.codingking.co/
 * 
 * 
 * This source file is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
 * or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.
 */

/** Bootstrap Typeahead extension - thanks to @jcroll - http://stackoverflow.com/a/18471203 **/
 $.fn.typeahead.Constructor.prototype.select = function() {
    var val = this.$menu.find('.active').attr('data-value');
    if (val) {
        this.$element
            .val(this.updater(val))
            .change();
    }
    return this.hide()
};
var newRender = function(items) {
    var that = this

    items = $(items).map(function (i, item) {
        i = $(that.options.item).attr('data-value', item);
        i.find('a').html(that.highlighter(item));
        return i[0];
    });

    this.$menu.html(items);
    return this;
};
$.fn.typeahead.Constructor.prototype.render = newRender;

/** CloudSend application scripts **/
$(document).ready(function() {
    
    /** Scroll to top **/
    $('a[href=#top]').click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });   
    
    /** Colorbox **/
    $('a[rel="colorbox"]').colorbox();
    
    /** Open link in new tab **/
    $('a[rel="newtab"]').click(function() {
        $(this).target = "_blank";
        window.open($(this).prop('href'));
        return false;
    });

    /** set publishing **/
    $('a.publish').click(function(e) {
	e.preventDefault();
	var $this = $(this);
	var link = $this.attr('href');
	
	$.getJSON( link, function( result ) {
	    if( result.type == 'success' ) {
		$this.html('').html('<i class="'+result.icon+'"></i>');
	    } else {
		alert( result.message );
	    }
	});
	
    });

    /** set autodelete **/
    $('a.autodelete').click(function(e) {
	e.preventDefault();
	var $this = $(this);
	var link = $this.attr('href');
	
	$.getJSON( link, function( result ) {
	    if( result.type == 'success' ) {
		$this.html('').html('<i class="'+result.icon+'"></i>');
		$this.removeAttr('title').attr("title",result.info);
	    } else {
		alert( result.message );
	    }
	});
	
    });
   
});

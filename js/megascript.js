/**
 # mega_alatinum - Mega Alatinum Template for Joomla! 1.7
 # author 		OmegaTheme.com
 # copyright 	Copyright(C) 2011 - OmegaTheme.com. All Rights Reserved.
 # @license 	http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Website: 	http://omegatheme.com
 # Technical support: Forum - http://omegatheme.com/forum/
**/
/**------------------------------------------------------------------------
 * file: megascript.js 1.7.0 00001, April 2011 12:00:00Z OmegaTheme $
 * package:	Mega Alatinum Template
 *------------------------------------------------------------------------*/
function equalHeightTop () {
	var elements = $$('.box div div div div div');
	var elements_i=$$('.box div div div div div div');
	var maxHeight = 0;
	/* Get max height */
	elements.each(function(item, index){
		var height = parseInt(item.getStyle('height'));
		if(height > maxHeight){ maxHeight = height; }
	});
	elements.setStyle('height', maxHeight+'px');
	elements_i.setStyle('height', 'auto');
}
window.addEvent ('load', function() {
	equalHeightTop();
});
<?php

/*
Plugin Name: Multi-page Toolkit
Plugin URI:  http://www.tarkan.info/20080106/tutorials/wordpress-plugin-multipage-tool-kit/
Description: Multipage post replacement for wp_link_page with page titling
Version: 1.2
Author: Tarkan Akdam
Author URI: http://www.tarkan.info


	Copyright (c) 2007, 2008 Tarkan Akdam (http://www.tarkan.info)
	Please consider making a donation if you found this plugin useful
	
	Multi Page Toolkit is released under the GNU General Public
	License: http://www.gnu.org/licenses/gpl.txt

	This is a WordPress plugin (http://wordpress.org). WordPress is
	free software; you can redistribute it and/or modify it under the
	terms of the GNU General Public License as published by the Free
	Software Foundation; either version 2 of the License, or (at your
	option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
	General Public License for more details.

	For a copy of the GNU General Public License, write to:

	Free Software Foundation, Inc.
	59 Temple Place, Suite 330
	Boston, MA  02111-1307
	USA

	You can also view a copy of the HTML version of the GNU General
	Public License at http://www.gnu.org/copyleft/gpl.html

CHANGELOG

v1.2 -	Added a check for trailing slashs and permalink structure for paging
		Cleaned up readme.txt
		Checked compatibility with WP 2.5rc1
v1.1 -	NEW quick jump method - page list / content menu
v1.0 -	Initial release

*/

function TA_display_pages($firsttext = ' Page ' , $lasttext = ' ' , $midtext = ' of ' , $display_type = 'all' ) {
	global $numpages, $multipage, $page;
	

	if ( $multipage ) {
		if ( $display_type == 'all' ) {
			$output = $firsttext .$page . $midtext .$numpages . $lasttext;
		}
		
		if ( $display_type == 'current' ) {
			$output = $firsttext . $page . $lasttext;
		}
		
		if ( $display_type == 'total' ) {
			$output = $firsttext . $numpages . $lasttext;
		}	
		
		echo $output;			
	
		return $output;
	}	
	
}

function TA_content_jump($before = '<p>', $after = '</p>', $title_number = 2, $quick_type = 1, $nav_type = 2, $nav_number = TRUE, $previouspagelink = '&laquo;', $nextpagelink = '&raquo;', $firstpagetext = 'On First Page', $lastpagetext = 'On Last Page' ) {

	global $numpages, $multipage, $page, $posts;	

	if ( $multipage ) {
	
			$pagetitlestring = '/<!--pagetitle:(.*)-->/';
			preg_match_all($pagetitlestring, $posts[0]->post_content, $titlesarray, PREG_PATTERN_ORDER);
			$pagetitles = $titlesarray[1];
			
			$previouslink = $page - 1;
			$nextlink = $page + 1;
				
			$previoustitle = $pagetitles[$previouslink - 1];
			$nexttitle = $pagetitles[$nextlink - 1];
			
			if ( '' == get_option('permalink_structure') || 'draft' == $post->post_status ) $page_link_type = '&amp;page=';
			else $page_link_type = '/';
			
			if ( (empty($previoustitle)) && (empty($nexttitle)) && ($quick_type == 1) ) $nav_type = 2;
			
			if ($nav_number) {
				$previoustitle = $previouslink .'. '. $previoustitle;
				$nexttitle = $nextlink .'. '. $nexttitle;
			}
			
			$output = $before;
			if ($quick_type ==1) $output .= '<form name="content_jump">';
			
			if ($previouslink == 1) $previouslink_checked = '">';
			else $previouslink_checked = $page_link_type . $previouslink . '/">';

			if ($page > 1) {
				if ($nav_type == 2) $output .= '<a class="contentjumplink" href="' . untrailingslashit(get_permalink()) . $previouslink_checked . $previouspagelink.'</a>';
				if ($nav_type == 1) $output .= '<a class="contentjumptitle" href="' . untrailingslashit(get_permalink()) . $previouslink_checked . $previoustitle.'</a>';
				}
			else {
				if ($nav_type == 2) $output .= '<span class="contentjumplink" >'. $previouspagelink.'</span>';
				if ($nav_type == 1) $output .= '<span class="contentjumptitle" >'.$firstpagetext.'</span>';
			}	
			
			if (($quick_type == 0) && ($nav_type == 1)) {
				if (empty($pagetitles[$page - 1])) $output .= '<span class="contentjumptitle" >Page '.$page.'</span>';
				else {
					if ($nav_number) $output .= '<span class="contentjumptitle" >'. $page . '. ' . $pagetitles[$page - 1] . '</span>';
					else $output .= '<span class="contentjumptitle" >'. $pagetitles[$page - 1].'</span>';
				}
			}
			
			if ($quick_type == 1) {
				$output .= '<select class="contentjumpddl" onchange="location = this.options[this.selectedIndex].value;">' ;
			
				for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {
					$pagename = $pagetitles[$i-1];				
					
					if ( 1 == $i ) $output .='<option value="'. get_permalink().'"' ;
					else $output .='<option value="'. untrailingslashit(get_permalink()) . $page_link_type . $i.'/"' ;
					
					if ($page == $i) $output .= 'selected="selected"' ;
				
					if (empty($pagename)) $output .= '>Page '.$i;
					else {
						$output .= '>';
						if ($title_number == 0) $output.= $pagename ;
						if ($title_number == 1) $output.= $pagename .' (' .$i.'/'.$numpages.')';
						if ($title_number == 2) $output.= $i .'. ' . $pagename ;
					}
					$output .='</option>';	
				}
				$output .= '</select>';
			}
			
			if ($quick_type == 2) {
			
				for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {
					$output .= ' ';
					if ( ($i != $page) && (!$more) ) {
						if ( 1 == $i ) {
							$output .= '<a class="contentjumpnumber" href="' . get_permalink() . '">';
						} else {
							$output .= '<a class="contentjumpnumber" href="' . untrailingslashit(get_permalink()) . $page_link_type . $i . '/">';
						}	
						$output .= $i . '</a>';
					}
					if ($page == $i) $output .= '<span class="contentjumpnumber">'.$i.'</span>';	
				}
			}

			if ($quick_type == 3) {
				$output .= '<ol class="contentlist">' ;
				$title_number = 0 ;
				
				for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {
					$pagename = $pagetitles[$i-1];				
					
					if ($page == $i) {
						$output .= '<li><span class="contentlist" >';
						if ($title_number == 0) $output.= $pagename ;
						if ($title_number == 1) $output.= $pagename .' (' .$i.'/'.$numpages.')';
						if ($title_number == 2) $output.= $i .'. ' . $pagename ;					
						$output .= '</span></li>';
					}
					else {
						if ( 1 == $i ) $output .='<li><a class="contentlist" href="' . get_permalink().'"' ;
						else $output .='<li><a class="contentlist" href="' . untrailingslashit(get_permalink()) . $page_link_type . $i.'/"' ;
					
						if (empty($pagename)) $output .= '>Page '.$i;
						else {
							$output .= '>';
							if ($title_number == 0) $output.= $pagename ;
							if ($title_number == 1) $output.= $pagename .' (' .$i.'/'.$numpages.')';
							if ($title_number == 2) $output.= $i .'. ' . $pagename ;
						}
						$output .='</a></li>';
					}			
					
				}
				$output .= '</ol>';
			}		
			
			if ($page < $numpages) {
				if ($nav_type == 2) $output .= '<a class="contentjumplink" href="' . untrailingslashit(get_permalink()) . $page_link_type. $nextlink . '/" >'.$nextpagelink.'</a>';
				if ($nav_type == 1) $output .= '<a class="contentjumptitle" href="' . untrailingslashit(get_permalink()) . $page_link_type . $nextlink . '/" >'.$nexttitle.'</a>';
				}	
			else {
				if ($nav_type == 2) $output .= '<span class="contentjumplink" >'.$nextpagelink.'</span>';
				if ($nav_type == 1) $output .= '<span class="contentjumptitle" >'.$lastpagetext.'</span>';
			}	
			
	if ($quick_type == 1) $output .= '</form>' ;	
	
	$output .= $after;
	echo $output ;
	}
}

?>
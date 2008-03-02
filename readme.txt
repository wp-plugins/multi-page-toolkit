=== Plugin Name ===
Contributors: Tarkan Akdam
Donate link: http://www.tarkan.info/tag/plugin/
Tags: posts, link_pages, multi-page, quicktag, navigation, 2.3,  paginate, pagination, titles, heading, content menu
Requires at least: 2.3
Tested up to: 2.3.3
Stable tag: 1.1

Multi-page toolkit create titles for pages and configurable navigation features

== Description ==

Multi-page toolkit

This plugin is the ultimate companion for people who use the multi-page capabilities of wordpress

Using the <!--nextpage--> quicktag you can create multi-page posts, and this plugin gives you three functions that extend this functionality even more!!

* Quicktag <!--pagetitle:-->

Using this quicktag you can create a title or header for each page in your multi-page post

* TA_display_pages

With this function you can quickly and easily display how many pages a particular post has on your index page. Choose from 3 formats ( 1 of 2 , Page 1, 3 pages)

* TA_content_jump

This function give you several pagination options choose from simply previous and next links, page title links and numbered links.
Quick jump options include dropdown menu or a list menu using page numbers or page titles.


== Installation ==

1. Unzip the file archive and put the directory into your "plugins" folder (/wp-content/plugins/)
2. Activate the plugin

** To use TA_display_pages **

Place this in your template file (e.g. index.php)

	<?php if(function_exists('TA_display_pages')) { TA_display_pages(); } ?>

Parameters (defaults shown)

	$firsttext = ' Page '
	$lasttext = ' '
	$midtext = ' of ' (only used when display_type is all)
	$display_type = 'all' (total , current, all)

Examples
	
	Default
				Page 1 of 3
				
	TA_display_pages('(',' pages)','','total');
				
				(3 pages)	
	
	TA_display_pages('(you are on page ',' now)','','current');
	
				(you are on page 1 now)
				
** To create pagetitles for your posts **

When you are editing or writing a post, switch to CODE view
	
type in the following tag <!--nextpage--> to create page breaks
within each page add (including the starting page) <!--pagetitle:TYPE IN PAGE TITLE HERE-->
	
To display or navigate using page titles use the following function in your template files
	
				
** To use TA_content_jump **
	
Place this in your template file used to display posts (normally single.php)
	
	<?php TA_content_jump(); ?>
	
Parameters (defaults shown)
	
	$before = '<p>'
	$after = '</p>'
	$title_number = 2 	(used when quick_type set to 2, adds page number to page title
						0 = no number, 1 = Page Title (1/3), 2 =  1. Page Title )	
						
	$quick_type = 1		(quick jump navigation type 0 = disable ,1 = Drop Down List ,2 = page number links ,3 = list menu) 
	
	$nav_type = 2		(navigation type 0 = disable, 1 = use page titles as next or previous, 
						2 = use $previous/$nextpagelink as next or previous links)
						
	$nav_number = TRUE	(only used when nav_type = 1, if TRUE page titles preceeded by page number)
	
	$previouspagelink = '&laquo;'
	$nextpagelink = '&raquo;'
	
	$firstpagetext = 'On First Page' (text to display when on first or last page when using nav_type 1)
	$lastpagetext = 'On Last Page'
	
**NOTE** nav_type is switched to 2 when post has no page titles !!!
	
Example
	
	<?php TA_content_jump('Page :','', 2, 2, 0, False, '&laquo;', '&raquo;'); ?>
	
CSS Styling
	
The plugin display will follow your existing CSS styling
	
You can do more targeted styling by adding the following ID's in to your templates style.css file
	
	span.contentjumplink {	font-size: 2em; 
							color: #aaa; 
							vertical-align:middle; 
							font-weight: bold; 
							padding: 0 3px 0px 3px}
							
	a.contentjumplink {		font-size: 2em; 
							color: #25A; 
							vertical-align:middle; 
							font-weight: bold; 
							padding: 0 3px 0px 3px}

	span.contentjumptitle { vertical-align: middle ; 
							color: #aaa; 
							font-weight: bold;
							border:1px #ddd solid ;
							border-top-color: #a7a7a7;
							padding: 3px 3px 3px 3px }
							
	a.contentjumptitle { 	vertical-align: middle;
							border:1px #ddd solid ; 
							border-top-color: #a7a7a7; 
							padding: 3px 3px 3px 3px}

	select.contentjumpddl { vertical-align: middle; 
							margin: 0px 0px 0px 0px ; 
							color: #25A;
							font-weight:bold; 
							font-family:Verdana, Arial, Helvetica, sans-serif;
							width: 160px }

	ol.contentlist { background-color:#f5f5f5; width: 20%; text-align:left; line-height: 3px; padding: 0px; }
	
	ol.contentlist li { padding: 0px; }
	
	span.contentlist { color: #aaa; font-weight: bold; }
	
	a.contentlist { padding: 0px; }

	span.contentjumpnumber { 	vertical-align: middle ;
								color: #ccc; 
								font-weight: bold;
								border:1px #ddd solid ; 
								border-top-color: #a7a7a7; 
								background-color: #25a; 
								padding: 3px 3px 3px 3px }
								
	a.contentjumpnumber { 	vertical-align: middle; 
							border:1px #ddd solid ; 
							border-top-color: #a7a7a7; 
							padding: 3px 3px 3px 3px}
							
	a.contentjumpnumber:hover { border-top-color: #25a; }
				
				
== Frequently Asked Questions ==

Examples of the types of navigation available using this plugin please visit :-
http://www.tarkan.info/archives/multipage/

== Screenshots ==

1. Example navigation methods with code required to create them.

== Arbitrary section ==

* Version 1.1
	* Add new quickjump method - list menu / content table
* Version 1.0
	* Initial version
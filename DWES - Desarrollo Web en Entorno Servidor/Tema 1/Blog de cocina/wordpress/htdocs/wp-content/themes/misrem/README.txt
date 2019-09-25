=== Misrem ===
Contributors: Arkadiusz Wawrzyniak, Before After Team
Requires at least: WordPress 4.7
Tested up to: WordPress 5.0-trunk
Version: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: two-columns, left-sidebar, grid-layout, custom-header, custom-menu, editor-style, featured-images, footer-widgets, sticky-post, theme-options, translation-ready, blog

== Description ==

Misrem is theme for sites relying on categories and give you a lot of customizing options. Misrem will make your site logicaly ordered by categories and give your users best UI experience.
Misrem will give you a lot of customizing options:
 * changing view style - grid/list,
 * changing promoted posts in main page header and in footer,
 * setting and changing default post thumbnail (if post don't have one)
Misrem work best on all modern browsers, but there is no support for Internet Explorer.

== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Type in Misrem in the search form and press the 'Enter' key on your keyboard.
3. Click on the 'Activate' button to use your new theme right away.
4. Read below 'Usage of theme' on how to customize this theme.
5. Navigate to Appearance > Customize in your admin panel and customize to taste.

== Usage of theme options ==

1. Select category displaying in header slider
	This option allow you to decide which category will be displaying in header slider. Admit that category with child category will also display posts from child category.
	Home slider can display maximum 3 posts. 
	There are also three additional options: 
		- disable this option - simply turn off slider
		- latest posts from all categories, which means that in slider you will see 3 latest posts,
		- latest sticky posts, which mean that in slider you will see 3 latest post marked as 'sticky post' (read more about sticky posts https://codex.wordpress.org/Sticky_Posts ).
	Home slider will use post thumbnail as background so to display properly img should have resolution at least 2560x1440 or just be prepered depends on which devices you want to display your site.  
	Home slider will not use default post thumbnail (read belowe about default post thumbnail) as a background. Posts without post thumbnail will use static img as background which is 'Header Image' (read more about header image https://en.support.wordpress.com/custom-header-image/ ). 

2. Select the categories displayed in the footer
	This option allow you to decide which category will be displaying in top of the footer. It works almost the same as previous option, but you can also choose the number of displaying posts from 1 to 3.

3. Select the way of displaying posts on home, archives and search pages.
	This option let you to decide how display posts on your site. In grid style or in list style. Grid style have sliders in home page on categories with more than 4 posts and it's recommended for pages with a lot of content. For smaller pages is recommended to use list style.

4. Upload a default post thumbnail.
	Allow you to add default post thumbnail. If you don't set any posts without post thumbnail will display without it. If you choose your default img posts without post thumbnail will display with default thumbnail of your choose.
	To see the changes of this option you have to refresh your page.

== Copyright ==

Misrem, Copyright 2018 Before After
Misrem is distributed under the terms of the GNU GPL

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

Misrem bundles the following third-party resources:

Eric Meyer’s “Reset CSS” 2.0 | 20110126
License: none
Source: http://meyerweb.com/eric/tools/css/reset/ 

Font Awesome
Copyright: Dave Gandy
Resource URI: http://fontawesome.io
License: MIT
Version: 4.7.0

Slick the last carousel you'll ever need, Copyright (c) 2017 Ken Wheeler
License: MIT License
Source: http://kenwheeler.github.io/slick/

Genericons icon font, Copyright 2013-2017 Automattic.com
License: GNU GPL, Version 2 (or later)
Source: http://www.genericons.com

Misrem incorporates code from Twenty Seventeen WordPress Theme, Copyright 2016 WordPress.org
Twenty Seventeen is distributed under the terms of the GNU GPL

jQuery offscreen plugin
Copyright 2017 A Beautiful Site, LLC
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
License: MIT License
Source: https://github.com/claviska/jquery-offscreen

Custom Breadcrumbs
Author: The Web Taylor
Author URI: https://www.thewebtaylor.com/
Source: https://www.thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
License: GNU GPL, Version 2 (or later)
License Source: http://www.genericons.com

debouncing function from John Hann
License: MIT License
Additional license source: http://unscriptable.com/license/
Source: http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/

Theme using images which are tacken from Pexels:
Img original URI: https://www.pexels.com/photo/illuminated-cityscape-against-blue-sky-at-night-316093/
Img name: illuminated-cityscape-against-blue-sky-at-night-316093
Img file name in theme: bg-slider.jpg
License: CC0 License
License URI: https://www.pexels.com/creative-commons-images/

== Changelog ==

= 1.0 =
* Released: July 9, 2018

= 1.0.1 =
* Released: July 9, 2018

Initial release

= 1.0.2 =
* Released: August 17, 2018
	Changes: 
		*added option in customizer, theme option - disable slider, now users can disable slider from home page,
		*added option in customizer, theme option - disable top footer highlighted posts, now users can disable top of the footer from home page,
		*fixed errors with slider, and footer categories - now only categories with posts show in list to choose,
		*WordPress Breadcrumbs function by Dimox has been removed,
		*fixed code errors with data sanitization,
		*fixed code errors,
		*fixed some layout errors,
		*changed position and name of file with styles to /assets/css/main.css

= 1.0.3 =
* Released: August 20, 2018
Changes: 
		*fixed error with wrong hook,
		*fixed error with escaping (various occurances),
		*fixed errors with wrong ussage of wp_reset_postdata,
		*changed licence in readme (this file),
		*removed the_archive_title and the_archive_description from search.php
		*fixed some other minor errors

= 1.0.4 =
* Released: August 21, 2018
Changes: 
		*fixed error with customizers errors with default values on fresh theme install

= 1.0.5 =
* Released: August 21, 2018
Changes: 
		*fixed some minor issues
		*fixed error with license of Twenty Seventeen WordPress Theme (missing reference in comments.php file)

= 1.1.0 =
* Released: September 25, 2018
Changes: 
		*added author archive (using nick)
		*fixed slick slider issue with height
		*fixed loading jump in slick slider
		*fixed error with adminbar
		*added new, better styles for widets in footer
		*deleted social media menu - now you have to add menu in footer using widget
		*from now all excerpts on page using Misrem are trim to 20-30 words depends on place
		*changed background color of fixed header
		*from now thumbnail in latest post sidebar is clickable link
		*changed search input look
		*added breadcrumbs to page (option to disable soon)
		*fixed some others minor issues

= 1.1.1 =
* Released: September 25, 2018
Changes: 
		*fixed version numbers in scripts and styles

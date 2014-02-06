![tect logo](https://rawgithub.com/Arty2/tect/master/graphics/tect.svg)

tect • an architect’s WordPress theme
===================================

> Safe to deploy, but still experimental!


This theme aims to:
-----------------------------------
* Be an unobtrusive, contemporary and responsive, suitable for visual designers and writers.
* Be a deployable ecosystem with own plugin functions and style classes.
* Pose as a semantic HTML5 and CSS3 snob experiment, which degrades (almost) gracefully for older browsers.
* Break free from WordPress' dated content behaviors, bad output code and template–like PHP code.
* Be suitable for bilingual users. English & Greek localization included.

Included enhancements / Credits
-----------------------------------
* [GitHub Updater](https://github.com/afragen/github-updater) enabled.
* [Magnific Popup](https://github.com/dimsemenov/Magnific-Popup)
* [Prism.js](http://www.prismjs.com)
* bits and pieces from [roots.io](http://roots.io/starter-theme/)

Suggested plugins & settings
-----------------------------------
* [Magic Widgets](http://wordpress.org/plugins/magic-widgets/)
* [Polylang](http://wordpress.org/plugins/polylang/) (theme uses own language switcher when plugin is enabled)
	* ☑ Hide URL language information for default language.
	* ☐ Activate languages and translations for media. (poorly applied)
	* ☐ Synchronization: Custom fields. (they may be translatable)
* [Greeklish Permalinks](https://github.com/dyrer/greeklish-permalinks)
* [Font emoticons](http://wordpress.org/plugins/font-emoticons/)
* [Stage switcher](http://roots.io/plugins/stage-switcher/)
* ?[Raw HTML](http://wordpress.org/extend/plugins/raw-html/)

Known bugs / Undocumented behaviors
-----------------------------------
* Caption shortcode requires width=1 for fluid width.
* It is suggested to use full-size for images if you want them to be fluid, filesize will be addressed with a plugin in the future.
* RSS feeds have not been tested thus they may not work as expected.
* If your blog already contains media, they may not work as expected.
* Visual editor calls for images in the wrong directory resulting in 404.


To-do
-----------------------------------

### high priority
* Always complete Greek l10n.
* Make use of [Gentium](scripts.sil.org/gentium) → [FontSquirrel](http://www.fontsquirrel.com/tools/webfont-generator)
* [Better](http://wordpress.stackexchange.com/questions/125784/each-custom-image-size-in-custom-upload-directory) [thumbnail](https://github.com/markjaquith/WordPress/blob/master/wp-includes/media.php) [filenames](http://wordpress.stackexchange.com/questions/51920/set-custom-name-for-generated-thumbnails).
* Move generated images to alternate directories [1](https://github.com/markjaquith/WordPress/blob/master/wp-includes/class-wp-image-editor.php) (2)[http://wordpress.stackexchange.com/questions/125784/each-custom-image-size-in-custom-upload-directory]
* Work on Pagination.
* Rethink archive view and work it from scratch.
* Fix errors with long and UTF8 titles.
* Test page display.
* Hidden pages should not appear as 404?

### low priority
* Pick a semantic alternative to <aside>
* Fix visual editor bug; images don't show up.
* Enable and make use of [Post Formats](http://codex.wordpress.org/Post_Formats)
* Clean useless code WordPress includes in the header by default.
* Theme options:
	* twitter handle
	* Categories that are displayed in homepage. (default: all)
	* Media directory → /media (default: true)
	* Hyper-relative links toggle. (default: true)
	* Prism.js and Magnific Popup toggle. (default: true)
	* Google Analytics
* Flexbox CSS at .gallery.
* Turn styleguide-raw.html into a proper accompanying page. (you can currently Copy & Paste the code into a post)
* Test and work on RSS feeds.
* Test if sticky posts work.
* Test if what works for Posts, works for Pages as well.
* Add Location custom field. ([OSM](http://wordpress.org/plugins/osm/)
* Add download related media link and field. (?)
* Semantic HTML for [curator’s code](http://www.brainpickings.org/index.php/2012/03/09/curators-code/).

### even lower priority
* Singled-out page template for cleaner .html (offline) copies of content.
* Write documentation on styles.
* Simplify CSS selectors and remove redundant !importants
* Ensure output code has better linebreaks.
* Add style options to Customizer:
	* custom background
	* logo height
	* text colors
	* link colors

### may never happen priority
* Add buttons and proper display styles for original classes to the Visual editor.


Plugins to select or write in functions.php
-----------------------------------
* Adaptive images using alternate sizes as already generated by WordPress.
	* http://mobile.smashingmagazine.com/2013/10/08/responsive-website-design-with-ress/
	* https://github.com/joeyvandijk/rimg
* Improved wpautop() (currently breaks custom HTML, WordPress "bug")
* Endless scroll.
* Footnote / sidenote plugin.
* vCard widget.
* Tag filter navigation.
* Remove revisions.


References
-----------------------------------
* [Github flavored markdown](https://help.github.com/articles/github-flavored-markdown)
* [hAtmo microformat](http://microformats.org/wiki/hAtom)
* [hnews microformat](http://microformats.org/wiki/hnews)
* [Readability™ developer guidelines](http://www.readability.com/developers/guidelines)
* [Normalize.css](http://necolas.github.io/normalize.css/)
* [ARIA roles](http://alistapart.com/article/aria-and-progressive-enhancement)
* [Common HTML idioms W3C draft](http://www.w3.org/html/wg/drafts/html/master/common-idioms.html#footnotes)
* [Roots Theme](http://roots.io/)
* [How to Hide The Fact That You're Using WordPress](http://benword.com/how-to-hide-that-youre-using-wordpress/)
* [WordPress Coding Standards](http://codex.wordpress.org/WordPress_Coding_Standards) (not sticking to them, but close enough)
* [I18n for WordPress developers](http://codex.wordpress.org/I18n_for_WordPress_Developers)
* [WordPress Theme Customization API](https://codex.wordpress.org/Theme_Customization_API)
* [FontSquirel webfont generator](http://www.fontsquirrel.com/tools/webfont-generator)



Site that do similar things to what tect aims to
-----------------------------------
* [Wired.co.uk](http://www.wired.co.uk/magazine/archive/2013/03/features/up) articles [dev post](http://views.fromthe7th.com/posts/2013/04/wired-uk-website-launches-new-articles) or [CQ](http://www.gq-magazine.co.uk/entertainment/articles/2013-04/09/steve-martin-david-walliams-in-conversation/viewall)

~ a pet project by [Heracles Papatheodorou](http://archi.tect.gr) a.k.a [Arty2](http://www.twitter.com/Arty2)
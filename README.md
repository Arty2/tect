![tect logo](https://rawgithub.com/Arty2/tect/master/graphics/tect.svg)

tect • an architect’s WordPress theme
===================================
> “In the beginning there was only chaos.”

A bespoke ecosystem created out of frustration for untidy, complex and unnecessary code in WordPress themes. 
Safe to deploy, but still experimental!

This theme aims to:
-----------------------------------
* Be an unobtrusive, contemporary and responsive, suitable for visual designers and writers.
* Be a deployable ecosystem with select plugins and style classes.
* Pose as a semantic HTML5 and CSS3 snob experiment, which degrades (almost) gracefully for older browsers.
* Break free from WordPress' dated content behaviors, bad output code and template–like PHP code.
* Be suitable for bilingual users. English & Greek localization included.

Included enhancements / Credits
-----------------------------------
* [GitHub Updater](https://github.com/afragen/github-updater) enabled.
* [Magnific Popup](https://github.com/dimsemenov/Magnific-Popup)
* [normalize.css](http://necolas.github.io/normalize.css/)
* [Gentium](scripts.sil.org/gentium) font in Latin & Greek.
* [Ubuntu Light](http://font.ubuntu.com/) font in Latin & Greek.
* [Graphe Alpha](https://github.com/Arty2/graphe) font in Latin & Greek.
* bits and pieces from [roots.io](http://roots.io/starter-theme/)

Known bugs / Undocumented behaviors
-----------------------------------
* Caption shortcode requires width=1 for fluid width.
* It is suggested to use full-size for images if you want them to be fluid, filesize will be addressed with a plugin in the future.
* RSS feeds have not been tested thus they may not work as expected.
* If your blog already contains media, they may not work as expected.

Suggested plugins
-----------------------------------
* [tect-media](https://github.com/Arty2/wp-tect-media)
* [Magic Widgets](http://wordpress.org/plugins/magic-widgets/)
* [Polylang](http://wordpress.org/plugins/polylang/) (theme uses own language switcher when plugin is enabled)
	* ☑ Hide URL language information for default language.
	* ☐ Activate languages and translations for media. (poorly applied)
	* ☐ Synchronization: Custom fields. (they may be translatable)
* [Greeklish Permalinks](https://github.com/dyrer/greeklish-permalinks)
* [Stage switcher](https://github.com/roots/wp-stage-switcher)
* [Regenerate Thumbnails](http://wordpress.org/plugins/regenerate-thumbnails/)
* [Prism Syntax Highlighter](http://wordpress.org/plugins/prism-syntax-highlighter/)
* [Font emoticons](http://wordpress.org/plugins/font-emoticons/)
* ?[Dynamic Featured Image](http://wordpress.org/plugins/dynamic-featured-image/)
* ?[Raw HTML](http://wordpress.org/extend/plugins/raw-html/)
* ?[Better Delete Revision](http://wordpress.org/plugins/better-delete-revision/)
* ?[Root Relative URLs](http://wordpress.org/plugins/root-relative-urls/)


To-do
-----------------------------------

### high priority
* Hierarchical sizes for flex items via custom field.
* Make tect_lang _witcher a widget.
* Rename #logo and add navigation field for widgets
* Finalize image post type looks.
* Style single pages differently from posts (?)
* Find (or write) a responsive/fluid post slider plugin.

* Finilize normal post looks.
* Draggables ← [touch enable](http://popdevelop.com/2010/08/touching-the-web/).
* Move *Magnific Popup* into a separate plugin.
* Always complete Greek l10n.
* Option to display select taxonomies in home.

### medium priority
* Reduce echo functions, see content-single.php (?)
* Add description to widget areas.
* Option to group select taxonomies in home by week or month (emphemera).
* Look into [Markdown](http://en.support.wordpress.com/markdown-quick-reference/) for WordPress.
* HTML 5 for Galleries and captions: `add_theme_support( 'html5', array( 'gallery', 'caption' ) );`
* Enable [h-entry](http://microformats.org/wiki/h-entry)
* Add social icon font for header stuff (github, twitter etc)
* Make use of [Attachment](http://wordpress.org/plugins/attachments/) plugin.
* Remove junk HTML from header.php and better meta description.
* Menu enable & own menu walker.
* Style [Post Formats](http://codex.wordpress.org/Post_Formats)
* Theme options:
	* Categories that are displayed in homepage. (default: all)
	* Media directory → /media (default: true)
	* Hyper-relative links toggle. (default: true)
* Test and work on RSS feeds.
* Turn styleguide-raw.html into a [proper accompanying page](http://wordpress.stackexchange.com/posts/35487/revisions) and write documentation on styles.


### low priority
* Semantic HTML for [curator’s code](http://www.brainpickings.org/index.php/2012/03/09/curators-code/).
* Do something similar to [Roots Rewrites](http://roots.io/plugins/roots-rewrites/)(?)
* Polish [caption] shortcode enhancements.
* Add Location custom field w/ [OSM](http://wordpress.org/plugins/osm/)?
* Singled-out page template for cleaner .html (offline) copies of content.
* Ensure output code has better linebreaks.
* Add style options to Customizer:
	* logo height
	* text colors
	* link colors
* *utilities/delete_deprecated_thumbs.php* → seperate plugin

### may never happen priority
* Custom [editor styles](http://codex.wordpress.org/Function_Reference/add_editor_style).


Plugins to select or write
-----------------------------------
* Adaptive images using alternate sizes as already generated by WordPress.
	* Use [img] shortcode for images to return <picture>?
	* http://mobile.smashingmagazine.com/2013/10/08/responsive-website-design-with-ress/
	* https://github.com/joeyvandijk/rimg
	* http://jetpack.me/support/photon/
* Improved wpautop() (currently breaks custom HTML, WordPress "bug")
* Infinite scroll ([via JetPack?](http://jetpack.me/support/infinite-scroll/))
* References (footnotes or sidenotes) plugin.
* vCard widget.
* Tag filter navigation.
* WordPress → Twitter.


References
-----------------------------------
* [Github flavored markdown](https://help.github.com/articles/github-flavored-markdown)
* [Theme options page](http://codex.wordpress.org/Creating_Options_Pages)
* [Theme Guidelines](http://make.wordpress.org/themes/guidelines/)
* [hAtom microformat](http://microformats.org/wiki/hAtom)
* [hnews microformat](http://microformats.org/wiki/hnews)
* [Readability™ developer guidelines](http://www.readability.com/developers/guidelines)
* [Normalize.css](http://necolas.github.io/normalize.css/)
* [ARIA roles](http://alistapart.com/article/aria-and-progressive-enhancement)
* [Common HTML idioms W3C draft](http://www.w3.org/html/wg/drafts/html/master/common-idioms.html#footnotes)
* [How to Hide The Fact That You're Using WordPress](http://benword.com/how-to-hide-that-youre-using-wordpress/)
* [WordPress Coding Standards](http://codex.wordpress.org/WordPress_Coding_Standards) (not sticking to them, but close enough)
* [I18n for WordPress developers](http://codex.wordpress.org/I18n_for_WordPress_Developers)
* [WordPress Theme Customization API](https://codex.wordpress.org/Theme_Customization_API)
* [Gridlover](http://www.gridlover.net/app/)
* [Bootstrap](http://getbootstrap.com/components/)



Some things that “tect” likes
-----------------------------------
* [Roots Theme](http://roots.io/)
* [Wired.co.uk](http://www.wired.co.uk/magazine/archive/2013/03/features/up) articles / see [dev post](http://views.fromthe7th.com/posts/2013/04/wired-uk-website-launches-new-articles) or [CQ](http://www.gq-magazine.co.uk/entertainment/articles/2013-04/09/steve-martin-david-walliams-in-conversation/viewall)
* [The Guardian: Adventures in content](http://next.theguardian.com/blog/bison/)

~ a pet project by [Heracles Papatheodorou](http://archi.tect.gr) a.k.a [Arty2](http://www.twitter.com/Arty2)
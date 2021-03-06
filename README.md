![tect logo](https://rawgithub.com/Arty2/tect/master/graphics/tect.svg)

#tect • an architect’s WordPress theme

> “In the beginning there was only chaos.”

A bespoke ecosystem created out of frustration for untidy, complex and unnecessary code in WordPress themes. **Safe to deploy, but still experimental!**

## This theme aims to:

* Be an unobtrusive, contemporary and responsive, suitable for visual designers and writers.
* Be a deployable ecosystem with select plugins and style classes.
* Pose as a semantic HTML5 and CSS3 snob experiment, which degrades (almost) gracefully for older browsers.
* Break free from WordPress' dated content behaviors, bad output code and template–like PHP code.
* Be suitable for bilingual users. English & Greek localization included.

## Required plugins

* [GitHub Updater](https://github.com/afragen/github-updater): enables theme updates


## Included / Credits

* [TGM Plugin Activation](http://tgmpluginactivation.com/)
* [Magnific Popup](https://github.com/dimsemenov/Magnific-Popup)
* [normalize.css](http://necolas.github.io/normalize.css/)
* [Gentium](scripts.sil.org/gentium) font in Latin & Greek.
* [Ubuntu Light](http://font.ubuntu.com/) font in Latin & Greek.
* [Graphe Alpha](https://github.com/Arty2/graphe) font in Latin & Greek.
* bits and pieces from [roots.io](http://roots.io/starter-theme/)

#####Known issues / Undocumented behaviors

* Caption shortcode requires width=1 for fluid width.
* It is suggested to use full-size for images if you want them to be fluid, filesize will be addressed with a plugin in the future.
* RSS feeds have not been tested thus they may not work as expected.


## To-do

<!--

- [X] item 1
    * [X] item A
    * [ ] item B
        more text
        + [x] item a
        + [ ] item b
        + [x] item c
    * [X] item C
- [ ] item 2
- [ ] item 3

## Check
http://www.ifdo.co/
* https://github.com/wilddeer/stickyfill
* https://github.com/weaintplastic/jquery-unveiled-navigation
* look into https://github.com/daveliepmann/tufte-css
* https://developer.wordpress.org/themes/advanced-topics/customizer-api/
* https://wordpress.org/plugins/simple-responsive-slider/installation/
* more print styles: http://www.smashingmagazine.com/2015/01/07/designing-for-print-with-css/

## Inspirations
* http://www.phasesmag.com/
-->

### high priority
* restructure this list
* image post → link different than thumb (link inside content?)
* style prev and next links below the header, horizontally
* link styles in .single header
* improve galleries (center, animations)
* expand second language → more understandable?
* remove body > selectors (they cause issues with wrappers)
* debug draggables, not working in Android
* Test and work on RSS feeds.
* header animations
* test why wp-stage-switcher messes up
* Finalize image post type looks (custom widths).
* Finilize normal post looks.
* fade out header in article view
* sort article header and footer widths
* IE issue with header svg
* Add styles for pages, categories and menus in head
* Hierarchical sizes for flex items via custom field.
* Make tect_lang a widget.
* Rename #logo and add navigation field for widgets
* Style single pages differently from posts (?)
* Find (or write) a responsive/fluid post slider plugin.
* float prev/next posts links
* replicate functionality of http://greaterthanorequalto.net/ as plugin
* add https://github.com/csscomb/csscomb-for-sublime support
* Move *Magnific Popup* into a separate plugin?
* Option to display select taxonomies in home.
* Always complete Greek l10n.

### medium priority
* Reduce echo functions, see content-single.php (?)
* Add description to widget areas.
* Option to group select taxonomies in home by week or month (emphemera).
* HTML 5 for Galleries and captions: `add_theme_support( 'html5', array( 'gallery', 'caption' ) );`
* Add social icon font for header stuff (github, twitter etc)
* Menu enable & own menu walker.
* Style [Post Formats](http://codex.wordpress.org/Post_Formats)
* Theme options:
	* Categories that are displayed in homepage. (default: all)
	* Media directory → /media (default: true)
* Turn styleguide-raw.html into a [proper accompanying page](http://wordpress.stackexchange.com/posts/35487/revisions) and write documentation on styles.


### low priority
* Semantic HTML for [curator’s code](http://www.brainpickings.org/index.php/2012/03/09/curators-code/).
* Polish [caption] shortcode enhancements.
* Add Location custom field w/ [OSM](http://wordpress.org/plugins/osm/)?
* Singled-out page template for cleaner .html (offline) copies of content.
* Add style options to Customizer:
	* logo height
	* text colors
	* link colors
* *utilities/delete_deprecated_thumbs.php* → seperate plugin

### may never happen priority
* Custom [editor styles](http://codex.wordpress.org/Function_Reference/add_editor_style).


## Plugins to select or write

* http://wordpress.org/plugins/attachments/
* http://dimsemenov.com/plugins/royal-slider/
* https://wordpress.org/plugins/soliloquy-lite/
* https://github.com/roots/roots-rewrites
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


## References

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



## Some things that “tect” likes

* [Wired.co.uk](http://www.wired.co.uk/magazine/archive/2013/03/features/up) articles / see [dev post](http://views.fromthe7th.com/posts/2013/04/wired-uk-website-launches-new-articles) or [CQ](http://www.gq-magazine.co.uk/entertainment/articles/2013-04/09/steve-martin-david-walliams-in-conversation/viewall)

~ a pet project by [Heracles Papatheodorou](http://archi.tect.gr) a.k.a [Arty2](http://www.twitter.com/Arty2)

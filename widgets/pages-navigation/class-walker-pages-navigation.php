<?php
namespace BSAElementorWidgets\Walkers;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Walker_Pages_Navigation extends \Walker_Page {
	private $root_page;
	private $root_page_children;
	private $above_page_children;
	private $current_page_children;

	public function setRootPage($root_page) {
    $this->root_page = get_post($root_page);
  }
  public function getRootPage() {
    return $this->root_page;
  }

	public function setRootPageChildren($root_page_children) {
    $this->root_page_children = $root_page_children;
  }
  public function getRootPageChildren() {
    return $this->root_page_children;
	}

	public function setAbovePageChildren($above_page_children) {
    $this->above_page_children = $above_page_children;
  }
  public function getAbovePageChildren() {
    return $this->above_page_children;
  }

	public function setCurrentPageChildren($current_page_children) {
    $this->current_page_children = $current_page_children;
  }
  public function getCurrentPageChildren() {
    return $this->current_page_children;
  }

  /**
	 * Outputs the beginning of the current element in the tree.
	 *
	 * @see Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string  $output       Used to append additional content. Passed by reference.
	 * @param WP_Post $page         Page data object.
	 * @param int     $depth        Optional. Depth of page. Used for padding. Default 0.
	 * @param array   $args         Optional. Array of arguments. Default empty array.
	 * @param int     $current_page Optional. Page ID. Default 0.
	 */
	public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
    if ( isset( $args['item_spacing'] ) && 'preserve' === $args['item_spacing'] ) {
			$t = "\t";
			$n = "\n";
		} else {
			$t = '';
			$n = '';
		}
		if ( $depth ) {
			$indent = str_repeat( $t, $depth );
		} else {
			$indent = '';
		}

		$css_class = array( 'page_item', 'page-item-' . $page->ID );

		if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
			$css_class[] = 'page_item_has_children';
		}

		if ( ! empty( $current_page ) ) {
			$_current_page = get_post( $current_page );
			if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {
				$css_class[] = 'current_page_ancestor';
			}
			elseif ($depth > 1) {
				if ($depth > 3) {
					if ((!in_array($page->ID, $this->getCurrentPageChildren()))) {
						return "";
					}
				}
				if ((!in_array($page->ID, $this->getCurrentPageChildren()) && $page->ID !== $current_page && !in_array($page->ID, $this->getAbovePageChildren()))) {
					return "";
				}
			}
			if ( $page->ID == $current_page ) {
				$css_class[] = 'current_page_item';
			} elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
				if (empty($this->getCurrentPageChildren()) && $depth === 0) {
					$css_class[] = 'current_page_root';
				}
				else {
					$css_class[] = 'current_page_parent';
				}
			}
		} elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent';
    }

		/**
		 * Filters the list of CSS classes to include with each page item in the list.
		 *
		 * @since 2.8.0
		 *
		 * @see wp_list_pages()
		 *
		 * @param array   $css_class    An array of CSS classes to be applied
		 *                              to each list item.
		 * @param WP_Post $page         Page data object.
		 * @param int     $depth        Depth of page, used for padding.
		 * @param array   $args         An array of arguments.
		 * @param int     $current_page ID of the current page.
		 */
    $css_classes = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

		if ( '' === $page->post_title ) {
			/* translators: %d: ID of a post */
			$page->post_title = sprintf( __( '#%d (no title)' ), $page->ID );
		}

		$args['link_before'] = empty( $args['link_before'] ) ? '' : $args['link_before'];
		$args['link_after'] = empty( $args['link_after'] ) ? '' : $args['link_after'];

		$atts = array();
		$atts['href'] = get_permalink( $page->ID );

		/**
		 * Filters the HTML attributes applied to a page menu item's anchor element.
		 *
		 * @since 4.8.0
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $href The href attribute.
		 * }
		 * @param WP_Post $page         Page data object.
		 * @param int     $depth        Depth of page, used for padding.
		 * @param array   $args         An array of arguments.
		 * @param int     $current_page ID of the current page.
		 */
		$atts = apply_filters( 'page_menu_link_attributes', $atts, $page, $depth, $args, $current_page );

		$link_target = get_post_meta($page->ID, 'bsa_pages_navigation_target', true);
		if ($link_target === '_blank') {
			$atts['target'] = $link_target;
		}

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$output .= $indent . sprintf(
			'<li class="%s"><a%s>%s%s%s</a>',
			$css_classes,
			$attributes,
			$args['link_before'],
			/** This filter is documented in wp-includes/post-template.php */
			apply_filters( 'the_title', $page->post_title, $page->ID ),
			$args['link_after']
		);

		if ( ! empty( $args['show_date'] ) ) {
			if ( 'modified' == $args['show_date'] ) {
				$time = $page->post_modified;
			} else {
				$time = $page->post_date;
			}

			$date_format = empty( $args['date_format'] ) ? '' : $args['date_format'];
			$output .= " " . mysql2date( $date_format, $time );
		}
	}
}
?>

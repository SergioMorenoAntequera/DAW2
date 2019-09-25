<?php

class Meow_Gallery_Custom_Links_Linker {

	public function __construct( $core ) {
    $this->core = $core;
    //add_filter( 'mgcl_linkers', array( $this, 'linker' ), 100, 6 );
	}

	function linker( $element, $parent, $mediaId, $url, $rel, $target ) {
    // Let's look for the closest link tag enclosing the image
    $potentialLinkNode = $parent;
    $maxDepth = 5;
    do {
      if ( !empty( $potentialLinkNode ) && $potentialLinkNode->tag === 'a' ) {

        if ( $this->core->enableLogs ) {
          error_log( 'Linker: The current link (' . $potentialLinkNode->{'href'} . ') will be replaced.' );
        }

        if ( $this->core->parsingEngine === 'HtmlDomParser' ) {
          $potentialLinkNode->{'href'} = $url;
          $class = $potentialLinkNode->{'class'};
          $class = empty( $class ) ? 'custom-link no-lightbox' : ( $class . ' custom-link no-lightbox' );
          $potentialLinkNode->{'class'} = $class;
          $potentialLinkNode->{'onclick'} = 'event.stopPropagation()';
          $potentialLinkNode->{'target'} = $target;
          $potentialLinkNode->{'rel'} = $rel;
        }
        else {
          $potentialLinkNode->attr( 'href', $url );
          $class = $potentialLinkNode->attr( 'class' );
          $class = empty( $class ) ? 'custom-link no-lightbox' : ( $class . ' custom-link no-lightbox' );
          $potentialLinkNode->attr( 'class', $class );
          $potentialLinkNode->attr( 'onclick', 'event.stopPropagation()' );
          $potentialLinkNode->attr( 'target', $target );
          $potentialLinkNode->attr( 'rel', $rel );
        }
        return true;
      }
      if ( method_exists( $potentialLinkNode, 'parent' ) )
        $potentialLinkNode = $potentialLinkNode->parent();
      else
        break;
    }
    while ( $potentialLinkNode && $maxDepth-- >= 0 );

    // There is no link tag, so we add one and move the image under it
    if ( $this->core->enableLogs ) {
      error_log( 'Linker: Will embed the IMG tag.' );
    }
    if ( $this->core->parsingEngine === 'HtmlDomParser' ) {
      $element->outertext = '<a href="' . $url . '" class="custom-link no-lightbox" onclick="event.stopPropagation()" target="' . 
        $target . '" rel="' . $rel . '">' . $element . '</a>';
    }
    else {
      if ( $parent->tag === 'figure' )
        $parent = $parent->parent();
      $a = new DiDom\Element('a');
      $a->attr( 'href', $url );
      $a->attr( 'class', 'custom-link no-lightbox' );
      $a->attr( 'onclick', 'event.stopPropagation()' );
      $a->attr( 'target', $target );
      $a->attr( 'rel', $rel );
      $a->appendChild( $parent->children() );
      foreach( $parent->children() as $img ) {
        $img->remove();
      }
      $parent->appendChild( $a );
    }
    return true;
	}
}

?>
/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y }
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function

function scaleTagCloud() {
    var maxWidth = 382;
    var $jobTags = jQuery( '#sidebar > .skills' );
    var $jobTagsWidth = $jobTags.width();
    
    if ( $jobTagsWidth < maxWidth ) {
	var $fontSize = ( $jobTagsWidth / maxWidth ) * 42;
	$jobTags.css( 'font-size', $fontSize + '%' );
    }
    else {
	$jobTags.css( 'font-size', '0.42em' );
    }
    
    maxWidth = $jobTags = $jobTagsWidth = null;
}

/* .view-all handling */ 
jQuery( '.view-all' ).click(
    function( event ) {
	event.preventDefault();
	jQuery( '.job' ).show();
	jQuery( '.skill > a' ).css( 'color', '#8fa68e' );
	jQuery( '.project-content, .project-footer' ).slideUp();
	jQuery( '.arrow' ).html( '&#9662;' );
	jQuery( this ).fadeOut( 200 );

	var $header = jQuery( '#container > .header' );
	jQuery( 'body' ).animate({
	    scrollTop: ( $header.outerHeight() + parseFloat( $header.css( 'padding-bottom' ) ) )
	});
    }
);


/* Tag cloud filter */
function initTagCloudFilter( initialColor, selectedColor ) {
    jQuery( '.skill > a' ).click(
	function( event ) {
	    event.preventDefault();

	    var $clickedSkill = jQuery( this );
	    var clickedSkillText = jQuery.trim( $clickedSkill.text() );
	    var $jobs = jQuery( '.job' );
	    var $viewAll = jQuery( '.view-all' );
	    
	    if ( $viewAll.css( 'display' ) === 'none' ) {
		$viewAll.fadeIn( 200 );
	    }

	    jQuery( '.project-content, .project-footer' ).slideUp();
	    jQuery( '.arrow' ).html( '&#9662;' );
	    jQuery( '.skill > a' ).css( 'color', initialColor );
	    $clickedSkill.css( 'color', selectedColor );

	    var $jobs = jQuery( '.job' );
	    $jobs.show();

	    $jobs.each(
		function() {
		    var $job = jQuery( this );

		    var skills = [];

		    $job.find( '.skill' ).each(
			function() {
			    var $skillAnchor = jQuery( this ).find( '> a' );
			    var skillText = jQuery.trim( $skillAnchor.text() );

			    if ( skillText === clickedSkillText ) {
				var $projectFooter = $skillAnchor.parent().parent().parent();
				var $projectContent = $projectFooter.prev();
			
				$projectContent.slideDown();
				$projectFooter.slideDown();
				$skillAnchor.css( 'color', selectedColor );
				$projectContent.prev().find( '.arrow' ).html( '&#9656;' );
			    
				$projectFooter = $projectContent = null;
			    }

			    skills.push( skillText );
			    
			    $skillAnchor = null;
			}
		    ).promise().done(  
			function() {
			    var $header = jQuery( '#container > .header' );
			    
			    jQuery( 'body' ).animate( {
				scrollTop: ( $header.outerHeight() + parseFloat( $header.css( 'padding-bottom' ) ) )
			    } );

			    $header = null;
			}
		    );
		    
		    if ( skills.indexOf( clickedSkillText ) === -1 ) {
			$job.hide();
		    }

		    $job = skills = null;
		}
	    );
	}
    );
}

// Function to slabtext the logo
function slabTextHeadlines() {
    jQuery( '#logo' ).slabText();
};

/*
 * Put all your regular jQuery in here.
*/
jQuery( document ).ready( function( $ ) {
    /*
     * Let's fire off the gravatar function
     * You can remove this if you don't need it
     */
    loadGravatars();

    jQuery( window ).scroll( 
	function() {
	    var offset = jQuery( window ).scrollTop();
	    var headerOuterHeight = jQuery( '#container > .header' ).outerHeight();
	    var $sidebar = jQuery( '#sidebar' );

	    if ( offset >= headerOuterHeight ) {
		$sidebar.css( 'position','relative' ).css( 'top', ( offset - headerOuterHeight ) );
	    }

	    else {
		$sidebar.css( 'position', 'static' );
	    }

	    $sidebar = null;
	}
    );
    
    /* Initialize tag cloud */
    jQuery( '#sidebar .skill > a' ).each(
	function() {
	    var $tagAnchor = jQuery( this ); 

	    $tagAnchor.css( 'font-size', $tagAnchor.attr( 'count' ) + 'em' );

	    // setting min font-size 
	    if ( parseInt( $tagAnchor.css( 'font-size' ) ) < 16 ) {
		$tagAnchor.css( 'font-size', '16px'  );
	    }

	    $tagAnchor = null;
	}
    );

    /* Initialize tag cloud filter */
    initTagCloudFilter( '#8fa68e', '#586657' );
    
    /* TODO: add matchMedia */
    scaleTagCloud();
    
    jQuery( window ).resize(
	function() {
	    scaleTagCloud();
	}
    );

    /* Project hide/show */
    jQuery( '.project-name' ).click(
	function() {
	    var $projectName = jQuery( this );
	    var $arrow = $projectName.find( '> .arrow' );
	    var $projectContent = $projectName.parent().next();
	    var $projectFooter = $projectContent.next();

	    jQuery( '.project-content, .project-footer' ).slideUp();
	    jQuery( '.project-name > .arrow' ).html( '&#9662;' );

	    if ( $projectContent.css( 'display' ) === 'none' ) {
		$projectContent.slideDown();
		$projectFooter.slideDown();
		$arrow.html( '&#9656;' );
	    }
	    else {
		$projectContent.slideUp();
		$projectFooter.slideUp();
		$arrow.html( '&#9662;' );
	    }

	    $projectName = $arrow = $projectContent = null;
	}
    );		
} ); /* end of as page load scripts */

jQuery( window ).load(
    function() {
	slabTextHeadlines();
    }
);

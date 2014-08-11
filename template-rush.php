<?php
/*
Template Name: Rush page
*/
?>
<?php get_header(); ?>
<main class="rush">
	<section class="calendar">
		<div class="container">	
			<section class="main">
				<div class="custom-calendar-wrap">
					<div id="custom-inner" class="custom-inner">
						<div class="custom-header clearfix">
							<nav>
								<span id="custom-prev" class="custom-prev"></span>
								<span id="custom-next" class="custom-next"></span>
							</nav>
							<h2 id="custom-month" class="custom-month"></h2>
							<h3 id="custom-year" class="custom-year"></h3>
						</div>
						<div id="calendar" class="fc-calendar-container"></div>
					</div>
				</div>
			</section>
		</div>
	</section>
</main>

<script type='text/javascript' src="<?php bloginfo('template_directory'); ?>/scripts/calendario/modernizr.custom.63321.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/calendario/jquery.calendario.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/calendario/data.js"></script>
<script type="text/javascript">	
	$(function() {
	
		var transEndEventNames = {
				'WebkitTransition' : 'webkitTransitionEnd',
				'MozTransition' : 'transitionend',
				'OTransition' : 'oTransitionEnd',
				'msTransition' : 'MSTransitionEnd',
				'transition' : 'transitionend'
			},
			transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
			$wrapper = $( '#custom-inner' ),
			$calendar = $( '#calendar' ),
			cal = $calendar.calendario( {
				onDayClick : function( $el, $contentEl, dateProperties ) {

					if( $contentEl.length > 0 ) {
						showEvents( $contentEl, dateProperties );
					}

				},
				caldata : codropsEvents,
				displayWeekAbbr : true
			} ),
			$month = $( '#custom-month' ).html( cal.getMonthName() ),
			$year = $( '#custom-year' ).html( cal.getYear() );

		$( '#custom-next' ).on( 'click', function() {
			cal.gotoNextMonth( updateMonthYear );
		} );
		$( '#custom-prev' ).on( 'click', function() {
			cal.gotoPreviousMonth( updateMonthYear );
		} );

		function updateMonthYear() {				
			$month.html( cal.getMonthName() );
			$year.html( cal.getYear() );
		}

		// just an example..
		function showEvents( $contentEl, dateProperties ) {

			hideEvents();
			
			var $events = $( '<div id="custom-content-reveal" class="custom-content-reveal"><h4>Events for ' + dateProperties.monthname + ' ' + dateProperties.day + ', ' + dateProperties.year + '</h4></div>' ),
				$close = $( '<span class="custom-content-close"></span>' ).on( 'click', hideEvents );

			$events.append( $contentEl.html() , $close ).insertAfter( $wrapper );
			
			setTimeout( function() {
				$events.css( 'top', '0%' );
			}, 25 );

		}
		function hideEvents() {

			var $events = $( '#custom-content-reveal' );
			if( $events.length > 0 ) {
				
				$events.css( 'top', '100%' );
				Modernizr.csstransitions ? $events.on( transEndEventName, function() { $( this ).remove(); } ) : $events.remove();

			}

		}
	
	});
</script>
<?php get_footer(); ?>
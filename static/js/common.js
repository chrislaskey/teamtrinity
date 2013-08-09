$(document).ready(function(){

	// Sticky navigation modified from CoworkChicago
	// See: http://coworkchicago.com
	
	var stickyNav = {}

	stickyNav.nav = $('#navigation ul'),
	stickyNav.wrapper = $('#wrapper-navigation'),
	stickyNav.wrapperPos = stickyNav.wrapper.offset().top;
	stickyNav.activeClass = 'current';
	stickyNav.contentSections = $('.content');

	$(window).resize(function(e) {
		stickyNav.wrapperPos = stickyNav.wrapper.offset().top;
	});

	$(window).on('scroll', function(e) {
		var scrollTop = $(this).scrollTop();

		window.clearTimeout(window.timeout);

		window.timeout = setTimeout(function() {

			// Set the sticky nav
			if (scrollTop > stickyNav.wrapperPos) {
				stickyNav.wrapper.not('.sticky').addClass('sticky');
			} else {
				stickyNav.wrapper.filter('.sticky').removeClass('sticky');
			}

			// Determine the current section
			var currentOffset = scrollTop + stickyNav.wrapper.outerHeight(),
				selectedSectionIndex;

			stickyNav.contentSections.each(function(e){
				var currentSection = stickyNav.contentSections.eq(e),
					elementOffset = currentSection.offset().top;

				if( currentOffset >= elementOffset ){
					selectedSectionIndex = e;
				}
			});

			stickyNav.activateNewSection(selectedSectionIndex);

		}, 10);
	});

	stickyNav.activateNewSection = function(elementIndex) {
		if( elementIndex !== undefined ){
			$('.' + stickyNav.activeClass).removeClass(stickyNav.activeClass);
			stickyNav.nav.find('li').eq(elementIndex).addClass(stickyNav.activeClass);
		}
	}

});

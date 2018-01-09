/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function($) {
    var container, button, menu, links, i, len;

    container = document.getElementById('site-navigation');
    if (!container) {
        return;
    }

    button = container.getElementsByTagName('button')[0];
    if ('undefined' === typeof button) {
        return;
    }

    menu = container.getElementsByTagName('ul')[0];

    // Hide menu toggle button if menu is empty and return early.
    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    menu.setAttribute('aria-expanded', 'false');
    if (-1 === menu.className.indexOf('nav-menu')) {
        menu.className += ' nav-menu';
    }

    button.onclick = function() {
        if (-1 !== container.className.indexOf('toggled')) {
            container.className = container.className.replace(' toggled', '');
            button.setAttribute('aria-expanded', 'false');
            menu.setAttribute('aria-expanded', 'false');
        } else {
            container.className += ' toggled';
            button.setAttribute('aria-expanded', 'true');
            menu.setAttribute('aria-expanded', 'true');
        }
    };

    // Get all the link elements within the menu.
    links = menu.getElementsByTagName('a');

    // Each time a menu link is focused or blurred, toggle focus.
    for (i = 0, len = links.length; i < len; i++) {
        links[i].addEventListener('focus', toggleFocus, true);
        links[i].addEventListener('blur', toggleFocus, true);
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while (-1 === self.className.indexOf('nav-menu')) {

            // On li elements toggle the class .focus.
            if ('li' === self.tagName.toLowerCase()) {
                if (-1 !== self.className.indexOf('focus')) {
                    self.className = self.className.replace(' focus', '');
                } else {
                    self.className += ' focus';
                }
            }

            self = self.parentElement;
        }
    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    (function(container) {
        var touchStartFn, i,
            parentLink = container.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

        if ('ontouchstart' in window) {
            touchStartFn = function(e) {
                var menuItem = this.parentNode,
                    i;

                if (!menuItem.classList.contains('focus')) {
                    e.preventDefault();
                    for (i = 0; i < menuItem.parentNode.children.length; ++i) {
                        if (menuItem === menuItem.parentNode.children[i]) {
                            continue;
                        }
                        menuItem.parentNode.children[i].classList.remove('focus');
                    }
                    menuItem.classList.add('focus');
                } else {
                    menuItem.classList.remove('focus');
                }
            };

            for (i = 0; i < parentLink.length; ++i) {
                parentLink[i].addEventListener('touchstart', touchStartFn, false);
            }
        }
    }(container));
})(jQuery);



// Smooth Scroll Anchor Links
(function($) {
    var headerHeight = parseInt($(".site-header").css("top")) - 125;
    var postNav = $(".post-nav").height();

    // Add smooth scrolling to all links
    $("a").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {

            if ($(this.hash).length) {
                // Prevent default anchor click behavior
                event.preventDefault();
            }

            // Store hash
            var hash = this.hash;

            if ($(".post-nav").length) {
                var headerHeight = parseInt($(".site-header").css("top")) - 125;
                var postNav = $(".post-nav").height();
                var scrollTo = $(hash).offset().top - headerHeight - postNav;
            } else {
                var scrollTo = $(hash).offset().top - 125;
            }

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area

            function runOnce(fn) {
                var count = 0;
                return function() {
                    if (++count == 1)
                        fn.apply(this, arguments);
                };
            };

            $('body, html').animate({ scrollTop: scrollTo }, 800, runOnce(function() {
                // Remove currentScroll class from ToC link
                $(".post-nav-toc a.currentScroll").removeClass("currentScroll");

                // Update URL Hash
                if (history.replaceState) {
                    history.replaceState(null, null, hash);
                } else {
                    location.hash = hash;
                }
            }));
        } // End if
    });
})(jQuery);

(function($) {
    var sBrowser, sUsrAg = navigator.userAgent;
    var headerChange = parseInt($(".header-top").css('height'));

    if ($('.entry-content').length) {
        var entryContentTop = $('.entry-content').offset().top;
    }

    var previousScroll = 0;
    $(window).scroll(function() {
        var currentScroll = $(this).scrollTop();

        if (currentScroll > headerChange) {
            $(".site-header").addClass("is-small");
        } else {
            $(".site-header").removeClass("is-small");
        }

        // If we're on a single post page, we need to swap out the menu bar for the header-post-bar once we reach the entry content, but go back to the navigation when we scroll up.
        if ($('body').hasClass('single')) {
            if (currentScroll > entryContentTop) {
                $('.site-header').addClass('top-hidden');
            } else {
                $('.site-header').removeClass('top-hidden');
            }

            if (currentScroll < previousScroll) {
                $('.site-header').removeClass('top-hidden');
            }



            previousScroll = currentScroll;
        }
    });

    // Create Table of Contents
    var counter = 0;
    $("h2.post-section").each(function() {
        var text = $(this).text();
        var ID = $(this).attr('id');
        var hash;

        if (ID) {
            hash = ID;
        } else {
            hash = "toc-" + counter;
            //Add ID to element
            $(this).attr('id', hash);
        }

        var linkClass = '';
        if (counter == 0) {
            linkClass = ' class="active"';
        }

        // Add to Table of Contents
        var listItem = '<li><a href="#' + hash + '" id="link-' + hash + '"' + linkClass + '>' + text + '</a></li>';
        $(".post-nav-toc").append(listItem);

        // Increase Counter
        counter++;
    });

    // Active Table of Contents Link on click
    $(".post-nav-toc").on("click", "li a", function() {
        $(".post-nav-toc a.active").removeClass("active");
        $(this).addClass("active currentScroll");
    })

    // Active Table of Contents Link on scroll
    var $sections = $('h2.post-section ');

    $(window).scroll(function() {

        var currentScroll = $(this).scrollTop();
        var currentSection = 'toc-0';

        $sections.each(function() {
            var headingPosition = $(this).offset().bottom;
            var headerHeight = parseInt($(".site-header").css("top"));
            var postNav = $(".post-nav").height();
            var sectionHeading = headingPosition - headerHeight - postNav;

            // Switch active table of content link based on which section the user is in. However, don't run this if the user clicked on a link to prevent the scroll classes from overriding the clicked classes
            if (sectionHeading - 1 < currentScroll && !$(".post-nav-toc a").hasClass('currentScroll')) {
                currentSection = $(this).attr('id');

                $('.post-nav-toc a').not('#link-' + currentSection).removeClass('active');
                $("#link-" + currentSection).addClass('active');
            }

        });

    });



    // Show post chapters on click
    $(".header-post-header-chapters").on("click", function(e) {

        if ($(".post-links").hasClass("active")) {
            $(".post-links").removeClass("active");

        } else {
            if ($(".post-share").hasClass("active")) {
                $(".post-share").removeClass("active");
            }
            $(".post-links").addClass("active");
        }
    })

    // Show post chapters on click
    $(".header-post-header-share").on("click", function(e) {

        if ($(".post-share").hasClass("active")) {
            $(".post-share").removeClass("active");

        } else {
            if ($(".post-links").hasClass("active")) {
                $(".post-links").removeClass("active");

            }


            $(".post-share").addClass("active");


        }


    });

    $(document).on('click', function(e) {


        if ((!$(e.target).closest('.post-nav-container').length) && (!$(e.target).closest('.header-post-header-share').length)) {
            $(".post-share").removeClass("active");
        }

        if ((!$(e.target).closest('.post-nav-container').length) && (!$(e.target).closest('.header-post-header-chapters').length)) {
            $(".post-links").removeClass("active");
        }
    });





    // Open mobile menu
    $("#mobile-menu").click(function() {
        if ($("#masthead").hasClass("mobile-open")) {
            $("#masthead").removeClass("mobile-open");
        } else {
            $("#masthead").addClass("mobile-open");
        }
    });


    $('a[href*="#"]')
        // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function(event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function() {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
            }
        });

})(jQuery);
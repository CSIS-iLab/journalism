/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function() {
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
})();



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


    //Chapter List


    /* $(".post a").each(function() {
        $title = $(this).html();
        $link = $(this).attr('href');
        $str = $title.replace(/\s/g, '');
        $(this).attr('id', $str);
        $('#chapters-list ul').append('<li><a href="#' + $str + '" alt="' + $title + '">' + $title + '</a></li>');
    })

    $(".header-post-header-chapters").on('click', function() {
        // $('#chapters-list').toggleClass('open');
        $('#page').addClass('toggle');
        event.stopPropagation();

    })

    $("#page").on('click', function(event) {
        if ($('#page').hasClass('toggle')) {
            $('#page').removeClass('toggle');
        }
    })*/

    // Create Table of Contents
    var counter = 0;
    $(".entry-content h2").each(function() {
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
    var $sections = $('.entry-content h2');

    $(window).scroll(function() {

        var currentScroll = $(this).scrollTop();
        var currentSection = 'toc-0';

        $sections.each(function() {
            var headingPosition = $(this).offset().top;
            var headerHeight = parseInt($(".site-header").css("top")) + 75;
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
    $(".header-post-header-chapters").on("click", function() {
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
    $(".header-post-header-share").on("click", function() {
        if ($(".post-share").hasClass("active")) {
            $(".post-share").removeClass("active");

        } else {
        	 if ($(".post-links").hasClass("active")) {
                $(".post-links").removeClass("active");
            }
            $(".post-share").addClass("active");

        }
    })


    // Open mobile menu
    $("#mobile-menu").on("click", function() {
        if ($("#masthead").hasClass("mobile-open")) {
            $("#masthead").removeClass("mobile-open");
        } else {
            $("#masthead").addClass("mobile-open");
        }
    });


    //Homepage play/pause button
    var vid = document.getElementById("bgvid");
    var pauseButton = document.querySelector("#home-pause");

    pauseButton.on("click", function() {
        if (vid.paused) {
            vid.play();
            pauseButton.innerHTML = "<i class='icon-pause'></i>";
        } else {
            vid.pause();
            pauseButton.innerHTML = "<i class='icon-play'></i>";
        }
    });

})(jQuery);



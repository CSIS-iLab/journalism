/**
 * File audio-video-player.js.
 *
 */
(function($) {
    //console.log("it's working")

    var container, button, menu, links, i, len;


    //Homepage play/pause button
    var vid = document.getElementById("bgvid");
    $pauseButton = $("#home-pause");

    $pauseButton.click(function() {
        if (vid.paused) {
            vid.play();
            $pauseButton.html("<i class='icon-pause'></i>");
        } else {
            vid.pause();
            $pauseButton.html("<i class='icon-play'></i>");
        }
    });
    $('#bgvid').on('ended', function() { $pauseButton.html("<i class='icon-play'></i>") });


    //AUDIO PLAYER
    //// http://tranzi.ev2test.com/wp-content/uploads/2017/10/75.mp3\
    /*$container = $('.audio-container');
    $container.each(function(i) {
        //console.log(i);

        $('.music', this).attr('id', 'audioplayer-' + i);
        $('.pButton', this).attr('id', 'playbutton-' + i);
        $('.timeline', this).attr('id', 'timeline-' + i);
        $('.playhead', this).attr('id', 'playhead-' + i);
        $('.time', this).attr('id', 'time-' + i);
        var music = document.getElementById('audioplayer-' + i); // play button

        var pButton = document.getElementById('playbutton-' + i); // play button

        var timeline = document.getElementById('timeline-' + i); // play button

        var playhead = document.getElementById('playhead-' + i); // play button

        var time = document.getElementById('time-' + i); // play button

        var duration = music.duration;
        $updated = calctime(duration);
        $('.duration', this).text($updated);

        var onplayhead = false;


        music.addEventListener("canplaythrough", function() { durationc(music, time) }, false);


        var timelineWidth = timeline.offsetWidth - playhead.offsetWidth;


        pButton.addEventListener("click", function() { play(music, pButton) });

        music.addEventListener("timeupdate", function(event) { timeUpdate(event, music, playhead, pButton, timeline, duration, time) }, false);


        // makes timeline clickable
        timeline.addEventListener("click", function(event) { clickTimeline(event, music, duration, timeline, timelineWidth, playhead, onplayhead) }, false);



        // makes playhead draggable
        playhead.addEventListener('mousedown', function(event) { mouseDown(event, music, playhead, pButton, timeline, onplayhead, timelineWidth) }, false);
        window.addEventListener('mouseup', function(event) { mouseUp(event, music, playhead, pButton, timeline, onplayhead, timelineWidth, duration, time) }, false);

        //pause, return to start when done
        music.addEventListener('ended', function(event) { ended(event, music, playhead, pButton, timeline, onplayhead, timelineWidth) }, false);


    });

    function durationc(music, time) {
        var duration = music.duration;
        $updated = calctime(duration);
        $(time).children('.duration').text($updated);
    };


    //Play and Pause
    function play(music, pButton) {
        // start music
        //console.log(this);
        //var music = this;
        if (music.paused) {
            music.play();


            var thisColor = pButton.getAttribute('data-color');
            //$pauseColor = $thisButton.data('color');
            $(pButton).children().addClass('icon-pausebtn-filled').css('color', thisColor);
            $(pButton).children().removeClass('icon-play');

            //console.log(pButton);
        } else { // pause music
            music.pause();
            $(pButton).children().removeClass('icon-pausebtn-filled');
            $(pButton).children().addClass('icon-play').css('color', 'black');
        }

    }

    function clickTimeline(event, music, duration, timeline, timelineWidth, playhead, onplayhead) {
        moveplayhead(event, timeline, timelineWidth, playhead, onplayhead);
        //var tester = duration * clickPercent(event, timeline, timelineWidth);
        //console.log(music.currentTime)
        var test = clickPercent(event, timeline, timelineWidth);
        
        music.currentTime = duration * clickPercent(event, timeline, timelineWidth);
    }

    // timeUpdate
    // Synchronizes playhead position with current point in audio
    function timeUpdate(event, music, playhead, pButton, timeline, duration, time) {

        var timelineWidth = timeline.offsetWidth - playhead.offsetWidth;

        var playPercent = timelineWidth * (music.currentTime / duration);
        playhead.style.marginLeft = playPercent + "px";
        if (music.currentTime == duration) {
            pButton.className = "";
            pButton.className = "play";
        }
        $currenttime = calctime(music.currentTime);
        $(time).children('.currenttime').text($currenttime + ' / ');

    }

    function mouseDown(event, music, playhead, pButton, timeline, onplayhead, timelineWidth) {
        onplayhead = true;
        window.addEventListener('mousemove', function(event) { moveplayhead(event, timeline, timelineWidth, playhead, onplayhead) }, true);
        music.removeEventListener('timeupdate', function(event) { timeUpdate(event, music, playhead, pButton, timeline, duration, time) }, false);
    }

    // mouseUp EventListener
    // getting input from all mouse clicks
    function mouseUp(event, music, playhead, pButton, timeline, onplayhead, timelineWidth, duration, time) {
        if (onplayhead == true) {
            moveplayhead(event, timeline, timelineWidth, playhead, onplayhead);
            window.removeEventListener('mousemove', function(event) { moveplayhead(event, timeline, timelineWidth, playhead, onplayhead) }, true);
            // change current time
            //console.log(music.currentTime);
            music.currentTime = duration * clickPercent(event, timeline, timelineWidth);
            music.addEventListener('timeupdate', function(event) { timeUpdate(event, music, playhead, pButton, timeline, duration, time) }, false);
        }
        var onplayhead = false;
    }
    // mousemove EventListener
    // Moves playhead as user drags
    function moveplayhead(event, timeline, timelineWidth, playhead, onplayhead) {
        var newMargLeft = event.clientX - getPosition(timeline);

        if (newMargLeft >= 0 && newMargLeft <= timelineWidth) {
            playhead.style.marginLeft = newMargLeft + "px";
        }
        if (newMargLeft < 0) {
            playhead.style.marginLeft = "0px";
        }
        if (newMargLeft > timelineWidth) {
            playhead.style.marginLeft = timelineWidth + "px";
        }

    }


    // Returns elements left position relative to top-left of viewport
    function getPosition(el) {
        var test = el.getBoundingClientRect().left;
        console.log(test);
        return el.getBoundingClientRect().left;
    }

 // returns click as decimal (.77) of the total timelineWidth
    function clickPercent(event, timeline, timelineWidth) {
        return (event.clientX - getPosition(timeline)) / timelineWidth;
    }

        // music has ended
    function ended(event, music, playhead, pButton, timeline, onplayhead, timelineWidth, duration, time) {
        music.currentTime = 0;
        music.pause();
        timeUpdate(event, music, playhead, pButton, timeline, duration, time);
        $(pButton).children().removeClass('icon-pausebtn-filled');
        $(pButton).children().addClass('icon-play').css('color', 'black');
    }

    function calctime(seconds) {
        var numhours = Math.floor((seconds % 86400) / 3600);
        var numminutes = Math.floor(((seconds % 86400) % 3600) / 60);
        var formattedminutes = ("0" + numminutes).slice(-2);
        var numseconds = Math.floor(((seconds % 86400) % 3600) % 60);
        var formattedseconds = ("0" + numseconds).slice(-2);
        return formattedminutes + ":" + formattedseconds;
    }*/

    $container = $('.audio-container');
    $container.each(function(i) {
        //console.log(i);

        $('.music', this).attr('id', 'audioplayer-' + i);
        $('.pButton', this).attr('id', 'playbutton-' + i);
        $('.timeline', this).attr('id', 'timeline-' + i);
        $('.playhead', this).attr('id', 'playhead-' + i);
        $('.time', this).attr('id', 'time-' + i);
        var music = document.getElementById('audioplayer-' + i); // play button

        var pButton = document.getElementById('playbutton-' + i); // play button

        var timeline = document.getElementById('timeline-' + i); // play button

        var playhead = document.getElementById('playhead-' + i); // play button

        var time = document.getElementById('time-' + i); // play button


       var  duration;
        // Gets audio file duration
        music.addEventListener("canplaythrough", function() {
            duration = music.duration;
               // Gets audio file duration
            $updated = calctime(duration);
            $(time).children('.duration').text($updated);
        }, false);



        // timeline width adjusted for playhead
        var timelineWidth = timeline.offsetWidth - playhead.offsetWidth;

        // play button event listenter
        pButton.addEventListener("click", play);

        // timeupdate event listener
        music.addEventListener("timeupdate", timeUpdate, false);

        // makes timeline clickable
        timeline.addEventListener("click", function(event) {
            moveplayhead(event);
            music.currentTime = duration * clickPercent(event);
        }, false);

        // returns click as decimal (.77) of the total timelineWidth
        function clickPercent(event) {
            return (event.clientX - getPosition(timeline)) / timelineWidth;
        }

        // makes playhead draggable
        playhead.addEventListener('mousedown', mouseDown, false);
        window.addEventListener('mouseup', mouseUp, false);


        music.addEventListener('ended', ended);

        // Boolean value so that audio position is updated only when the playhead is released
        var onplayhead = false;

        // mouseDown EventListener
        function mouseDown() {
            onplayhead = true;
            window.addEventListener('mousemove', moveplayhead, true);
            music.removeEventListener('timeupdate', timeUpdate, false);
        }

        // mouseUp EventListener
        // getting input from all mouse clicks
        function mouseUp(event) {
            if (onplayhead == true) {
                moveplayhead(event);
                window.removeEventListener('mousemove', moveplayhead, true);
                // change current time
                music.currentTime = duration * clickPercent(event);
                music.addEventListener('timeupdate', timeUpdate, false);
            }
            onplayhead = false;
        }
        // mousemove EventListener
        // Moves playhead as user drags
        function moveplayhead(event) {
            var newMargLeft = event.clientX - getPosition(timeline);

            if (newMargLeft >= 0 && newMargLeft <= timelineWidth) {
                playhead.style.marginLeft = newMargLeft + "px";
            }
            if (newMargLeft < 0) {
                playhead.style.marginLeft = "0px";
            }
            if (newMargLeft > timelineWidth) {
                playhead.style.marginLeft = timelineWidth + "px";
            }
        }

        // timeUpdate
        // Synchronizes playhead position with current point in audio
        function timeUpdate() {
            var playPercent = timelineWidth * (music.currentTime / duration);
            playhead.style.marginLeft = playPercent + "px";
            if (music.currentTime == duration) {
                //pButton.className = "";
                //pButton.className = "play";
            }
            $currenttime = calctime(music.currentTime);
        $(time).children('.currenttime').text($currenttime + ' / ');
        }

        //Play and Pause
        function play() {
            // start music
            if (music.paused) {
                music.play();


                var thisColor = pButton.getAttribute('data-color');
                //$pauseColor = $thisButton.data('color');
                $(pButton).children().addClass('icon-pausebtn-filled').css('color', thisColor);
                $(pButton).children().removeClass('icon-play');

                //console.log(pButton);
            } else { // pause music
                music.pause();
                $(pButton).children().removeClass('icon-pausebtn-filled');
                $(pButton).children().addClass('icon-play').css('color', 'black');
            }

        }

        function ended() {
            //console.log('end');
            //music.pause();
            $(pButton).children().removeClass('icon-pausebtn-filled');
            $(pButton).children().addClass('icon-play').css('color', 'black');
            music.addEventListener('timeupdate', timeUpdate, true);

        };


        // getPosition
        // Returns elements left position relative to top-left of viewport
        function getPosition(el) {
            return el.getBoundingClientRect().left;
        }


    });

    function calctime(seconds) {
        var numhours = Math.floor((seconds % 86400) / 3600);
        var numminutes = Math.floor(((seconds % 86400) % 3600) / 60);
        var formattedminutes = ("0" + numminutes).slice(-2);
        var numseconds = Math.floor(((seconds % 86400) % 3600) % 60);
        var formattedseconds = ("0" + numseconds).slice(-2);
        return formattedminutes + ":" + formattedseconds;
    }



})(jQuery);
/**
 * File audio-video-player.js.
 *
 */
(function($) {
    console.log("it's working")

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
    //// http://tranzi.ev2test.com/wp-content/uploads/2017/10/75.mp3
    var container = document.getElementsByClassName('audio-container');
    for (var i = 0; i < container.length; i++) {


        var music = document.getElementsByClassName("music")[i]; // id for audio element
        var duration;
        //music.onloadedmetadata = function(music) {
            var duration = music.duration;
            $duration = music.duration;
        //};


        var pButton = document.getElementsByClassName("pButton")[i]; // play button
        $pButton = $('.pButton'); // play button

        var playhead = document.getElementsByClassName("playhead")[i] // playhead
        var timeline = document.getElementsByClassName("timeline")[i]; // timeline

        // timeline width adjusted for playhead
        var timelineWidth = timeline.offsetWidth - playhead.offsetWidth;

        // play button event listenter
        pButton.addEventListener("click", play);

        // timeupdate event listener
        music.addEventListener("timeupdate", timeUpdate, false);


        $updated = calctime(duration);
        $('.duration').text($updated);

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
                pButton.className = "";
                pButton.className = "play";
            }
            $currenttime = calctime(music.currentTime);
            $('.currenttime').text($currenttime + ' / ');
        }

        //Play and Pause
        function play() {
            // start music
            if (music.paused) {
                music.play();
                // remove play, add pause
                //pButton.className = "";
                //pButton.className = "pause";
                $pauseColor = $('.pButton').data('color');
                console.log($pauseColor)
                $('.pButton i').addClass('icon-pausebtn-filled').css('color', $pauseColor);
                $('.pButton i').removeClass('icon-play');
            } else { // pause music
                music.pause();
                // remove pause, add play
                //pButton.className = "";
                //pButton.className = "play";
                $('.pButton i').removeClass('icon-pausebtn-filled');
                $('.pButton i').addClass('icon-play').css('color', 'black');
            }

        }




        function calctime(seconds) {
            var numhours = Math.floor((seconds % 86400) / 3600);
            var numminutes = Math.floor(((seconds % 86400) % 3600) / 60);
            var formattedminutes = ("0" + numminutes).slice(-2);
            var numseconds = Math.floor(((seconds % 86400) % 3600) % 60);
            var formattedseconds = ("0" + numseconds).slice(-2);
            return formattedminutes + ":" + formattedseconds;
        }
        // Gets audio file duration
        music.addEventListener("canplaythrough", function() {
            duration = music.duration;
        }, false); // getPosition
        // Returns elements left position relative to top-left of viewport
        function getPosition(el) {
            return el.getBoundingClientRect().left;
        }
    }

})(jQuery);
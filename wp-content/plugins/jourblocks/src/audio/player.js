// =====	Audio Player JS ===== //
console.log("hey");
$("audio").each(function() {
  $(this).on(
    "ended",
    function() {
      this.play();
    },
    false
  );

  // Audio Duration Timers

  $(this).on("canplay", function() {
    var s = parseInt(this.duration % 60);
    s = ("0" + s).slice(-2);
    var m = parseInt((this.duration / 60) % 60);
    $(this)
      .siblings(".progress-wrap")
      .find(".audio-length")
      .text(m + ":" + s);
    console.log(this.duration);
  });

  $(this).on("timeupdate", function() {
    var s = parseInt(this.currentTime % 60);
    s = ("0" + s).slice(-2);
    var m = parseInt((this.currentTime / 60) % 60);
    $(this)
      .siblings(".progress-wrap")
      .find(".audio-current-time")
      .text(m + ":" + s);
  });

  // Audio Progress Bar

  $(this).on("timeupdate", function() {
    var currentTime = this.currentTime;
    var duration = this.duration;
    $(this)
      .siblings(".progress-wrap")
      .find(".audio-seekbar .audio-slide")
      .animate(
        {
          width: (currentTime / duration) * 100 + "%"
        },
        250,
        "linear"
      );
  });

  // Play/Pause Audio

  $(this)
    .siblings(".button-wrap")
    .find(".audio-play")
    .on("click", function() {
      if (
        !$(this)
          .parents()
          .siblings("audio")[0].paused
      ) {
        $(this)
          .parents()
          .siblings("audio")[0]
          .pause();
        $(this).removeClass("playing");
      } else {
        $(this)
          .parents()
          .siblings("audio")[0]
          .play();
        $(this).addClass("playing");
        $(this)
          .parents()
          .siblings(".progress-wrap")
          .find(".audio-title")
          .css("opacity", "0");
        $(this)
          .parents()
          .siblings(".progress-wrap")
          .find(".audio-seekbar")
          .css("opacity", "1.0");
      }
    });
});

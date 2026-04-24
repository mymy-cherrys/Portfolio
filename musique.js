let currentTrack = 0;
let isShuffleEnabled = false;

const audio = new Audio();

$(document).ready(function () {
  const playlist = [
    {
      name: "Driving With the Top Down",
      artist: "Emma Guilbaud",
      src:
        "https://raw.githubusercontent.com/SKAL04172247/MUSIC-FILES/main/Driving-With-the-Top-Down.mp3"
    },
    {
      name: "Pacific Rim",
      artist: "Emma Guilbaud",
      src:
        "https://raw.githubusercontent.com/SKAL04172247/MUSIC-FILES/main/Pacific-Rim.mp3"
    },
    {
      name: "What Are You Going To Do When You Are Not Saving the World",
      artist: "Emma Guilbaud",
      src:
        "https://raw.githubusercontent.com/SKAL04172247/MUSIC-FILES/main/What-Are-You-Going-To-Do-When-You-Are-Not-Saving-the-World.mp3"
    },
    {
      name: "Cornfield Chase",
      artist: "Emma Guilbaud",
      src:
        "https://raw.githubusercontent.com/SKAL04172247/MUSIC-FILES/main/Cornfield-Chase.mp3"
    },
    {
      name: "Survival Of The Fittest",
      artist: "Emma Guilbaud",
      src:
        "https://raw.githubusercontent.com/SKAL04172247/MUSIC-FILES/main/Survival-Of-The-Fittest.mp3"
    }
  ];

  let currentTrack = 0;
  let audio = new Audio(playlist[currentTrack].src);
  let isShuffle = false;

  const updateSongDetails = () => {
    const song = playlist[currentTrack];
    $(".song-name").text(song.name);
    $(".artist-name").text(song.artist);
    if (song.name.split(" ").length > 5 || song.name.length > 30) {
      $(".song-name").addClass("scroll");
    } else {
      $(".song-name").removeClass("scroll");
    }
    if (!audio.src.includes(song.src)) {
      audio.src = song.src;
      audio.load();
    }
    if (song.cover) {
      $(".album").css(
        "background-image",
        `linear-gradient(rgba(54, 79, 60, 0.25), rgba(73, 101, 77, 0.55)), url('${song.cover}')`
      );
    }
  };

  const playTrack = () => {
    updateSongDetails();
    audio.play();
    $(".play").hide();
    $(".pause").show();
  };

  $(".pause").hide();
  updateSongDetails();

  $(".thunderbolt").click(() => $(".thunderbolt").toggleClass("clicked"));
  $(".shuffle").on("click", function () {
    $(this).toggleClass("clicked");
    isShuffleEnabled = $(this).hasClass("clicked");
  });
  $("#player").hover(() => $(".info").toggleClass("up"));
  $(".play").click(() => playTrack());
  $(".pause").click(() => {
    audio.pause();
    $(".play").show();
    $(".pause").hide();
  });
  $(".next").click(() => {
    currentTrack = isShuffle
      ? Math.floor(Math.random() * playlist.length)
      : (currentTrack + 1) % playlist.length;
    playTrack();
  });
  function shuffleTrack() {
    let randomIndex;
    do {
      randomIndex = Math.floor(Math.random() * playlist.length);
    } while (randomIndex === currentTrack);
    currentTrack = randomIndex;
    updateSongDetails();
    audio.play();
    $(".play").hide();
    $(".pause").show();
  }
  $(".previous").click(() => {
    currentTrack = (currentTrack - 1 + playlist.length) % playlist.length;
    playTrack();
  });
  window.addEventListener("load", () => {
    if (playlist.length > 0) {
      currentTrack = Math.floor(Math.random() * playlist.length);
      const song = playlist[currentTrack];
      audio.src = song.src;
      $(".song-name").text(song.name);
      $(".artist-name").text(song.artist);
      function applyScrollingTitle() {
        const $song = $(".song-name");
        const songText = $song.text();
        const wordCount = songText.trim().split(/\s+/).length;
        if (wordCount >= 20) {
          $song.addClass("scroll-song-name");
        } else {
          $song.removeClass("scroll-song-name");
        }
      }
      applyScrollingTitle();
      audio
        .play()
        .then(() => {
          $(".play").hide();
          $(".pause").show();
        })
        .catch((err) => {
          $(document).one("click", () => {
            audio.play();
            $(".play").hide();
            $(".pause").show();
          });
        });
    }
  });
  function formatTime(seconds) {
    if (isNaN(seconds)) return "0:00";
    const min = Math.floor(seconds / 60);
    const sec = Math.floor(seconds % 60);
    return `${min}:${sec < 10 ? "0" : ""}${sec}`;
  }
  audio.addEventListener("timeupdate", () => {
    if (audio.duration) {
      const percent = (audio.currentTime / audio.duration) * 100;
      $(".fill").css("width", `${percent}%`);
      $(".time--current").text(formatTime(audio.currentTime));
      $(".time--total").text(
        `-${formatTime(audio.duration - audio.currentTime)}`
      );
    }
  });
  let isScrubbing = false;
  let scrubPreviewTime = 0;
  const progressBar = $(".progress-bar");
  const fillBar = $(".fill");
  progressBar.on("mousedown", function (e) {
    isScrubbing = true;
    updateScrubPreview(e);
  });
  $(document).on("mousemove", function (e) {
    if (isScrubbing) {
      updateScrubPreview(e);
    }
  });
  $(document).on("mouseup", function () {
    if (isScrubbing && audio.duration) {
      audio.currentTime = scrubPreviewTime;
    }
    isScrubbing = false;
  });
  function updateScrubPreview(e) {
    const offset = progressBar.offset();
    const width = progressBar.width();
    const x = e.pageX - offset.left;
    const percent = Math.max(0, Math.min(1, x / width));
    scrubPreviewTime = percent * audio.duration;
    fillBar.css("width", `${percent * 100}%`);
    $(".time--current").text(formatTime(scrubPreviewTime));
    $(".time--total").text(`-${formatTime(audio.duration - scrubPreviewTime)}`);
  }
  audio.addEventListener("timeupdate", () => {
    if (!isScrubbing && audio.duration) {
      const percent = (audio.currentTime / audio.duration) * 100;
      fillBar.css("width", `${percent}%`);
      $(".time--current").text(formatTime(audio.currentTime));
      $(".time--total").text(
        `-${formatTime(audio.duration - audio.currentTime)}`
      );
    }
  });
  $(".volume-slider").on("input change", function () {
    const value = parseFloat($(this).val());
    audio.volume = value;
    const icon = $(".volume i");
    if (value === 0) {
      icon.removeClass().addClass("fas fa-volume-mute");
    } else if (value < 0.5) {
      icon.removeClass().addClass("fas fa-volume-down");
    } else {
      icon.removeClass().addClass("fas fa-volume-up");
    }
  });
  $(".volume i").on("click", function (e) {
    e.stopPropagation();
    $(".volume").toggleClass("active");
  });
  $(document).on("click", function () {
    $(".volume").removeClass("active");
  });
  let optionsTimeout;
  $(".option").click(function () {
    const panel = $(".options-panel");
    panel.stop(true, true).slideDown(100);
    clearTimeout(optionsTimeout);
    optionsTimeout = setTimeout(() => {
      panel.slideUp(300);
    }, 5000);
  });
  playlist.forEach((song, index) => {
    $(".song-list").append(
      `<li data-index="${index}">${song.name} - ${song.artist}</li>`
    );
  });
  $(".song-list").on("click", "li", function () {
    currentTrack = parseInt($(this).data("index"));
    updateSongDetails();
    playTrack();
  });
  $(".progress-bar").click(function (e) {
    const offset = $(this).offset();
    const width = $(this).width();
    const clickX = e.pageX - offset.left;
    const percent = clickX / width;
    audio.currentTime = percent * audio.duration;
  });
  $(".fill").css("width", "0%");
  $(".time--current").text("0:00");
  $(".time--total").text("-0:00");
  const $fileInput = $(
    '<input type="file" accept="audio/*" multiple style="display:none">'
  );
  $("body").append($fileInput);
  $(".add").click(() => $fileInput.click());
  $fileInput.on("change", (e) => {
    const files = e.target.files;
    for (let file of files) {
      const url = URL.createObjectURL(file);
      playlist.push({
        name: file.name,
        artist: "Local",
        src: url
      });
    }
    alert(`${files.length} local file(s) added.`);
  });
  $(window).on("beforeunload", () => audio.pause());
});

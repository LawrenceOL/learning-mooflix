function volumeToggle(button) {
  let muted = $(".previewVideo").prop("muted");
  $(".previewVideo").prop("muted", !muted);

  $(button).find("i").toggleClass("fa-solid fa-volume-xmark");
  $(button).find("i").toggleClass("fa-solid fa-volume-up");
}

function previewEnded() {
  $(".previewVideo").toggle();
  $(".previewImage").toggle();
}

function goBack() {
  window.history.back();
}

function startHideTimer() {
  let timeout = null;

  $(document).on("mousemove", function () {
    clearTimeout(timeout);
    $(".watchNav").fadeIn();

    timeout = setTimeout(function () {
      $(".watchNav").fadeOut();
    }, 2000);
  });
}

function initVideo(videoId, username) {
  startHideTimer();
  updateProgressTimer(videoId, username);
}

function updateProgressTimer(videoId, username) {
  addDuration(videoId, username);
}

function addDuration(videoId, username) {
  $.post(
    "ajax/addDuration.php",
    { videoId: videoId, username: username },
    function (data) {
      if (data) alert(data);
    }
  );
}

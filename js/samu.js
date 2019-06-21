$(function() {
  $("#touch").on("touchstart", function(e) {
    // touch行為が禁止されているか
    if (e.cancelable) {
      // touch行為が禁止されているか
      if (!e.defaultPrevented) {
        e.preventDefault();
      }
    }
    (startX = e.originalEvent.changedTouches[0].pageX),
      (startY = e.originalEvent.changedTouches[0].pageY);
  });
  $("#touch").on("touchend", function(e) {
    // touch行為が禁止されているか
    if (e.cancelable) {
      // touch行為が禁止されているか
      if (!e.defaultPrevented) {
        e.preventDefault();
      }
    }
    (moveEndX = e.originalEvent.changedTouches[0].pageX),
      (moveEndY = e.originalEvent.changedTouches[0].pageY),
      (X = moveEndX - startX),
      (Y = moveEndY - startY);
    //down
    if (Y > 0) {
      alert("down");
    }
    //up
    else if (Y < 0) {
      alert("up");
    }
    //click
    else {
      alert("click");
    }
  });
});

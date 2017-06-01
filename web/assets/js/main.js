$(document).ready(function() {
  $('.category-container').mousewheel(function(e, delta) {
    this.scrollLeft -= (delta * 40);
    e.preventDefault();
  });
});

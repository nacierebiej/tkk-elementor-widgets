function isZipCode(value) {
  return /(^\d{5}$)/.test(value);
}
jQuery(function($) {
  $(".scouting_beascout_form").on("submit", function(e) {
    // var zipcode = $(this).children(".zipcode").val();
    var zipcode = $(this).find('.zipcode');
    if (!isZipCode(zipcode.val() )) {
      e.preventDefault();
      alert("Please enter a five digit zipcode");
    }
  });
});

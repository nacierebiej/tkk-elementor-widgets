jQuery(function ($) {
  var searchContainer = $(jetsSearchAjax.searchScopeID).find(jetsSearchAjax.itemTag);
  $("#elementorFilterInputWidgetInput").on("input", function () {
    var value = $(this).val().toLowerCase();
    $(searchContainer).filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});

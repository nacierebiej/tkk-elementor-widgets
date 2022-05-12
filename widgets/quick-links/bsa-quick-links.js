jQuery(function($){
  $(document).on("click", "[data-add-quick-links-input]", function (e) {
    var field_name = $(this).attr("data-field-name");

    var links_count = $(this).closest(".widget").find(".link").length;

    var input = "";
    input += '<div class="link">';
      input += '<h5 style="margin-bottom: 0;">Link <a style="float: right;" data-remove-quick-links-input href="javascript:void(0);">Remove</a></h5>';
      input += '<label>Label</label>';
      input += '<input type="text" class="widefat" name="' + field_name + '[' + links_count + '][label]">';
      input += '<label>URL</label>';
      input += '<input type="text" class="widefat" name="' + field_name + '[' + links_count + '][url]">';
    input += '</div>';
    $(this).closest(".widget-content").children("#bsa-quick-links-inputs").append(input);
  });

  $(document).on("click", "[data-remove-quick-links-input]", function(e){
    $(this).closest(".widget").find(".widget-control-save").removeAttr("disabled");
    $(this).closest(".link").remove();
  });
});


function getZipData(elem) {
  $.ajax({
    url: "http://zip.elevenbasetwo.com",
    cache: false,
    dataType: "json",
    type: "GET",
    data: "zip=" + $("#" + elem).val(),
    success: function(result, success) {

      $(".zip-autofill").val(result.city + ", " + result.state);

    }
  });
}

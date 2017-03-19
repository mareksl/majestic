var source;
$('#vid-id').keyup(function () {
  source = $('#vid-id').val();
  $('#img-vid').attr('src', "http://img.youtube.com/vi/" + source + "/sddefault.jpg");
  $('#img-vid-txt').hide();
});

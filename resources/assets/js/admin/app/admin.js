$(document).ready(function(){
  $('#group-depart').datepicker({
          uiLibrary: 'bootstrap4',
          iconsLibrary: 'fontawesome'
      });
  $('#group-return').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome'
    });

  if ($(".show-account-user")) {
    $(document).mouseup(function(e)
    {
        var container = $(".admin-helper-modal");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
          $(".show-account-user").removeClass('active');
          $('.admin-helper-modal').addClass('hidden');
        }
    });
    $(".show-account-user").mouseover(function(){
      if (!$(this).hasClass('active')){
        $(".show-account-user").removeClass('active');
        $('.admin-helper-modal').addClass('hidden');
      }
        $(this).children('.admin-helper-modal').removeClass('hidden');
    });
    $(".show-account-user").mouseleave(function(){
      if (!$(this).hasClass('active'))
      $(this).children('.admin-helper-modal').addClass('hidden');
    });
    $(".show-account-user").click(function(){
      $(".show-account-user").removeClass('active');
      $('.admin-helper-modal').addClass('hidden');
      $(this).addClass('active');
      $(this).children('.admin-helper-modal').removeClass('hidden');
    });
  }
});

$(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) ;
          }

      });
  });

});

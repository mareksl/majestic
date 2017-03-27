$(document).ready(function() {
  $("form[name|='form']").submit(function(event) {
    // get the form data
    var formData = new FormData(this);
    // process the form
    $.ajax({
        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url: './process.php', // the url where we want to POST
        data: formData, // our data object
        dataType: 'json', // what type of data do we expect back from the server
        encode: true,
        // Tell jQuery not to process data or worry about content-type
        // You *must* include these options!
        cache: false,
        contentType: false,
        processData: false,
      })
      // using the done promise callback
      .done(function (data) {
        // log data to the console so we can see
        switch (data.success) {
        case true:
          // alert(data.message
          genAlert(data.success, "Gratulacje!", data.message);
          break;
        case false:
          var errorsArr = [];
          for (var error in data.errors) {
            errorsArr.push(data.errors[error]);
          }
          // alert('Niepowodzenie:\n' + errorsArr.join('\n'));
          genAlert(data.success, "Niepowodzenie!\n", errorsArr.join('<br>'));
          break;
        }
        // here we will handle errors and validation messages
      });
    // stop the form from submitting the normal way and refreshing the page
    event.preventDefault();
  });
});

function genAlert(alertSuccess, alertHeading, alertContent) {
  var html = '';
  if (alertSuccess) {
    html += '<div class="alert alert-success alert-dismissable">';
  } else {
    html += '<div class="alert alert-danger alert-dismissable">';
  }
  html += '<a class="close" data-dismiss="alert">×</a>';
  html += '<h4>' + alertHeading + '</h4>';
  html += '<p>' + alertContent + '</p>';
  html += '</div>';
  $('.modal').modal('hide');
  $(html).hide().prependTo($('h1')).slideDown(400);
  $('.alert').fadeIn(400);
  if (alertSuccess) {
    setTimeout(function () {
      $('.alert').slideUp(400, function () {
        $(this).remove();
      });
    }, 2000);
  }

}

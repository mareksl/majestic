// VALIDATE PASSWORD
function validate() {
  var password = document.getElementById("pass").value;
  var confirmPassword = document.getElementById("conf_pass").value;
  if (password != confirmPassword) {
    var passgroup = document.getElementById('passgroup');
    passgroup.className += " has-error";
    var passerror = document.getElementById('passerror');
    passerror.innerHTML = "Hasła nie zgadzają się!";
    return false;
  }
  return true;
}

// RANDOM NEW PASSWORD
function randomize_new() {
  var randomstring = Math.random().toString(36).slice(-8);
  var randompass = document.querySelector('#randompass');
  randompass.innerHTML = 'Your random pass is: <b>' + randomstring + '</b>';
  document.querySelector('#pass_new').value = randomstring;
  document.querySelector('#conf_pass_new').value = randomstring;
  randompass.style.display = 'block';
}

document.addEventListener('DOMContentLoaded', function () {
  document.querySelector('#pass-btn').addEventListener('click', function () {
    randomize_new();
  });
});

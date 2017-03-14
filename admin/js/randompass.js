// RANDOM NEW PASSWORD
function randomize_new() {
var randomstring = Math.random().toString(36).slice(-8);
var randompass = document.getElementById('randompass');
document.getElementById('randompass').innerHTML = 'Your random pass is: <b>' + randomstring + '</b>';
document.getElementById('pass_new').value = randomstring;
document.getElementById('conf_pass_new').value = randomstring;
if (randompass.innerHTML == '') list.style.display = 'none';
else randompass.style.display = 'block';
};

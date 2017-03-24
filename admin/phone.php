<?php
function localize_number($phone) {
  $numbers_only = preg_replace("/[^\d]/", "", $phone);
  return preg_replace("/^(\d{2})(\d{3})(\d{3})(\d{3})$/", "+$1-$2-$3-$4", $numbers_only);
}

echo localize_number("48585515507"), "\n";
echo localize_number("numer to 48 787 855 195"), "\n";

?>

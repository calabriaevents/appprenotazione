<?php
// privacy-policy.php
// This file redirects to the dynamic page handler 'page.php' with the correct slug.
// This centralizes content management.

header("HTTP/1.1 301 Moved Permanently");
header("Location: page.php?slug=privacy-policy");
exit();
?>

<!--
    HEADER - included at the TOP of every page.
    Sets up the HTML document, page title, and loads the stylesheet.
    Every page sets $pageTitle before including this file, e.g.:
        $pageTitle = 'About Us';
        include 'includes/header.php';
-->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- If the page set $pageTitle, show "Page Name | Direct Link Hands".
     Otherwise just show the site name. -->
<title><?= isset($pageTitle) ? e($pageTitle) . ' | Direct Link Hands' : 'Direct Link Hands' ?></title>

<!-- Use a root-relative path so the stylesheet works on InfinityFree and locally. -->
<link rel="stylesheet" href="<?= defined('BASE_URL') ? BASE_URL : '' ?>/css/style.css">
</head>
<body>
<!-- Every page's own content is printed below this line,
     and includes/footer.php closes </body></html> at the end. -->

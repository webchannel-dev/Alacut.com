<?php
$url=urlencode('http://www.alacut.com/test/script/gmail/oauth.php');
echo $url;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <a href="https://accounts.google.com/o/oauth2/auth?client_id=119139720768.apps.googleusercontent.com&redirect_uri=<?php echo $url ?>&scope=https://www.google.com/m8/feeds/&response_type=code">Import</a>
    </body>
</html>

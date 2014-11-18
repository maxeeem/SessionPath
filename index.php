<?php
/*
* "Hello World!" example using SessionPath
*/
session_start();

$default = isset($_SESSION['default']) ? $_SESSION['default'] : null;
$name    = isset($_SESSION['name'])    ? $_SESSION['name']    : 'Stranger';
?>
<html>
<head>
<title>"Hello World!" example</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
function sPath(key,id) {
    var url = '../ajax/sPath.php?key='+key;
    if (typeof id !== 'undefined') {
        url .= '&value='+id;
    }
    $.ajax({
        type: 'GET',
        url: url
    }).done(function(response) {
        try {
            response = JSON.parse(response);
        } catch (e) {
            console.log(e);
        }
        if (response && response.status == 'OK') {
            if (!history.state) {            
                history.pushState(response.source, '');
            }
            history.pushState(response.destination, '');
            window.location.reload();
        }
    });
}

window.onpopstate = function(event) {
    if (event.state) {
        $.ajax({
            type: 'POST',
            url: '../ajax/sPath.php',
            data: {
                'snapshot' : event.state
            }
        }).done(function(response) {
            if (response == 'READY') {
                window.location.reload();
            }
        });
    } else if (history.state == null && document.referrer == window.location.href) {
        history.back();
    }
};
</script>
</head>
<body>
<center>

<?php if ($default) { ?>
<h3>This is the default output</h3>
<?php } ?>

<h1>Hello <?=$name?>!</h1>

</center>
</body>
</html>

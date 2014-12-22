/*
* SessionPath js
*/

function sPathAJAX(path) {
    sPathAJAX = path;
}

function sPath(key,value) {
    var url = sPathAJAX+'?key='+key;
    if (typeof value !== 'undefined') {
        url += '&value='+value;
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
            url: sPathAJAX,
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

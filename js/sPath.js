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
    
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            try {
                response = JSON.parse(ajax.responseText);
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
        }
    };
    ajax.open('GET', url);
    ajax.send();
}

window.onpopstate = function(event) {
    if (event.state) {
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200 && ajax.responseText == 'READY') {
            window.location.reload();
        }
        ajax.open('POST', sPathAJAX);
        ajax.setRequestHeader("Content-Type", "application/json");
        ajax.send(JSON.stringify({ snapshot : event.state }));
    } else if (history.state == null && document.referrer == window.location.href) {
        history.back();
    }
};

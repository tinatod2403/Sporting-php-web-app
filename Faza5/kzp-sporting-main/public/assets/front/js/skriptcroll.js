function scrollfunction_nov() {
    var body = document.body,
        html = document.documentElement;
    var height = Math.max(body.scrollHeight, body.offsetHeight,
        html.clientHeight, html.scrollHeight, html.offsetHeight);
    $('html, body').animate({
        scrollTop: height / 2
    }, 200);
}

function scrollfunction_pro() {
    var body = document.body,
        html = document.documentElement;
    var height = Math.max(body.scrollHeight, body.offsetHeight,
        html.clientHeight, html.scrollHeight, html.offsetHeight);
    $('html, body').animate({
        scrollTop: height - innerHeight - innerHeight / 2
    }, 200);
}

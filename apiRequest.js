// APIリクエストJS
var values = document.getElementById('ad').getAttribute('value');
var parameters = values.split('&');
var result = new Object();
var pid;
for ( var i = 0; i < parameters.length; i++ )
{
    var element = parameters[i].split('=');
    var paramName = element[0];
    var paramValue = element[1];
    result[ paramName ] = paramValue;
}
pid = result['pid'];
var data;
var url ='http://192.168.33.10/vc/AdApi.php?pid=';
var request = new XMLHttpRequest();
request.open('GET', url+pid, true);
request.responseType = 'json';
request.onload = function () {
    var data = this.response;
    if ( data ) {
        h = '<a href="' +data.URL+'">'+data.NAME+'</a>';
    } else {
        h = '<a href="#>広告の表示ができません</a>';
    }
    document.getElementById('ad').innerHTML = h;
    // 後で消す
    console.log(data);
}
request.send();
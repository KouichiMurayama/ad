// APIリクエストJS
var adTag = document.getElementById('ad');
var values = adTag.getAttribute('value');
var parameters = values.split('&');
var result = new Object();
var pid;
// sctiptタグ内に存在するパラメータの取得
for ( var i = 0; i < parameters.length; i++ )
{
    var element = parameters[i].split('=');
    var paramName = element[0];
    var paramValue = element[1];
    result[ paramName ] = paramValue;
}
pid = result['pid'];
// pid = null
if ( pid ) {
    var data;
    var url ='http://192.168.33.10/vc/api/AdApi.php?pid=';
    var request = new XMLHttpRequest();
    request.open('GET', url+pid, true);
    request.responseType = 'json';
    request.onload = function () {
        var data = this.response;
        if ( data ) {
            h = '<a href="redirector.php?link=' +data.URL+';"><img src="data:'+data.MIME+';base64,'+data.IMG_DATA+'"></a>';
        } else {
            // 広告情報が取得できない場合
            h = '<a href="#>広告の表示ができません</a>';
        }
        adTag.innerHTML = h;
        // TODO:デバッグ用json確認 後で消す
        console.log(data);
    }
    request.send();

} else {
    // pidが取得できなかった際の処理
    h = '<a href="#>広告情報が正しくないため表示できません</a>';
    adTag.innerHTML = h;
}
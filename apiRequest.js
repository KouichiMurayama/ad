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
sid = result['sid'];
// pidが取得できない場合は広告を表示しない
if ( pid ) {
    var data;
    var url = 'http://192.168.33.10/vc/api/AdApi.php?pid=';
    var request = new XMLHttpRequest();
    request.open('GET', url+pid, true);
    request.responseType = 'json';
    request.onload = function () {
        var data = this.response;
        // APIから広告情報を取得することができなかった場合は表示しない
        if ( data ) {
            // APIから取得してきた情報とタグのSIDが異なる場合は広告を表示しない
            if ( data.ASID == sid ) {
                h = '<a href="redirector.php?pid=' +data.OID+'&asid='+data.ASID+'&adid='+data.ADID+'&url='+data.URL+';"><img src="data:'+data.MIME+';base64,'+data.IMG_DATA+'"></a>';
            } else {
                h = '<a href="#">広告の表示ができません</a>';
            }
        } else {
            h = '<a href="#">広告の表示ができません</a>';
            console.log(1);
        }
        adTag.innerHTML = h;
        // TODO:デバッグ用json確認 後で消す
        console.log(data);
        // console.log(result);
    }
    request.send();

} else {
    h = '<a href="#">広告の表示ができません</a>';
    adTag.innerHTML = h;
}
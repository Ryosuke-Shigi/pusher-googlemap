function initMap(){
    let activeMarker       //位置指定中マーカー
    let getPosition = new Promise(function(resolve,reject){//promiseでgetPositionを作成
    let panto;

        //一度だけ通る（MAP初期　現在地を取得してセッティング
        //現在地を取得
        navigator.geolocation.getCurrentPosition(   //一度だけ現在地取得　 //定期的にとる 　navigator.geolocation.watchPosition(  移動ルート取得するのに使いそう
            function(pos){
                //pos.coords.heading 方角
                player_position={lat:pos.coords.latitude,lng:pos.coords.longitude};//連想配列 "lat"=>現在の緯度 "lng"=>現在の経度 latLng

                //現在位置で、bladeにはいる緯度経度を初期化
                //cords.latitude longitudeは現在位置での変数であることに注意！！
                //ここにはいるのは、自分自身の座標
                document.getElementById('latitude').value = pos.coords.latitude;
                document.getElementById('longitude').value = pos.coords.longitude;
                document.getElementById('zoom').value = 15;

                resolve();
                return 0;
            }
        );
    });


    //上記初期設定が終了したらこちらへ
    //Promiseオブジェクト
    getPosition.then(function(){    //成功resolve

        // mapインスタンス化用：オプションを設定 連想配列で作成
        let opt = {
            zoom: Number(document.getElementById('zoom').value),                           //地図の縮尺を指定
            center: player_position,              //現在地からスタート
            disableDoubleClickZoom: true,       //ダブルクリックによるズームをさせない falseで可能になる
            mapTypeControl: false,              //地図・航空地図切り替えをなくす
            fullscreenControl: false,           //全体画面表示ボタンキャンセル
            streetViewControl: false            //ストリートビューボタンキャンセル
        };

        // 地図のインスタンスを作成します。第一引数にはマップを描画する領域、第二引数にはオプションを指定
        // mapはgooglemap.blade.phpのdivのid
        mapObj = new google.maps.Map(document.getElementById("map"), opt);
        //初期の拡大率
        mapObj.setZoom(Number(document.getElementById("zoom").value));
        //ボタン設置
        const input = document.getElementById("mapButtonSector");
        //位置指定してマップにプッシュ
        mapObj.controls[google.maps.ControlPosition.TOP_CENTER].push(input);



        //検索用の窓のID取得
        const searchBox = new google.maps.places.SearchBox(document.getElementById('searchBox'));
        //検索窓設定
        //境界取得
        mapObj.addListener('bounds_charged',()=>{
            searchBox.setBounds(mapObj.getBounds());
        });
        //サーチボックスに変化があった時
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }
            const bounds = new google.maps.LatLngBounds();
            places.forEach((place) => {
                if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
            });
            mapObj.fitBounds(bounds);
            document.getElementById('searchBox').value="";
        });


        //latitudeをクリック（javascriptで叩いている)をクリックした時
        //pusherで受信した時
        document.getElementById('latitude').addEventListener('click',function(){
            //拡大率取得
            panto = new google.maps.LatLng(document.getElementById('latitude').value,document.getElementById('longitude').value);

            //アクティブマーカーが存在していたら
            if(activeMarker != null){
                //指定中マーカーを消す
                activeMarker.setMap();
            }
            //アクティブマーカー作成
            activeMarker=new google.maps.Marker({
                position:panto,          //位置
                map:mapObj,                     //どの地図に入れるか
                title:"activate"       //マウスをホバーした時にでるタイトルDate(pos.timestamp)

            });
            //拡大率反映
            mapObj.setZoom(Number(document.getElementById('zoom').value));
            //表示領域の中心を、アクティブマーカーの位置に移動
            mapObj.panTo(panto);
        });




        //シングルクリックでマーカー（どこを登録するか）作成
        google.maps.event.addListener(mapObj, 'click', function(pos)
        {
            //マーカーが存在していたら
            if(activeMarker != null){
                //指定中マーカーを消す
                activeMarker.setMap();
            }

            //現在日時取得
            let nowDate = new Date();

            //Bladeにチェックした位置を保存
            document.getElementById('latitude').value = pos.latLng.lat();
            document.getElementById('longitude').value = pos.latLng.lng();
            //document.getElementById('nowTime').value = nowDate.getTime();
            document.getElementById('zoom').value=mapObj.getZoom();
            //中心へ移動
            //mapObj.panTo(e.latLng);

            //指定中マーカー作成
            activeMarker=new google.maps.Marker({
                position:pos.latLng,          //位置
                map:mapObj,                     //どの地図に入れるか
                title:"経度："+pos.latLng.lat()+" 緯度："+pos.latLng.lng()+" チェック時間："+nowDate.getTime()         //マウスをホバーした時にでるタイトルDate(pos.timestamp)

            });

        });



/*         //ダブルクリック　登録表示
        google.maps.event.addListener(mapObj,'dblclick',function(e)
        {
            document.getElementById('latitude').click();
            document.getElementById('mapButtonA').click();
        }); */


        //////////////////////////////////////////////////////////////////
        /*
        /*      ポイントのマーカーを表示する
        */
        //テーブルで送られてきたデータ分　マーカーを設置する
        // tableデータ table マーカー保存用空配列 markers
/*         for(let key in table){
            let tempLatLng=new google.maps.LatLng(table[key].latitude,table[key].longitude)
            //ルートマーカー設置(初期位置に)
            let tempMarker = new google.maps.Marker({
                // ピンを差す位置を決めます。
                position: tempLatLng,//経度・緯度で指定
                // ピンを差すマップを決めます。 上記の地図のインスタンス
                map: mapObj,
                // ホバーしたときに
                title: " ",
                animation: google.maps.Animation.DROP,
                icon: {
                    url:  'https://mt.googleapis.com/vt/icon/name=icons/onion/SHARED-mymaps-container_4x.png,icons/onion/1592-heart_4x.png&highlight=ff5252&scale=1.7', //円を指定
                },
                //現在地アイコン
                //map_icon_label:'<span class=""></span>',
                label: {
                    text:"P",
                    //text: String(table[key].point_no),                           //ラベル文字
                    color: '#FF0000',                    //文字の色
                    fontSize: '15px'                     //文字のサイズ
                }
            });
            markers.push(tempMarker);
        } */




        //ユーザのマーカーを設置(初期位置に)
/*         player_marker = new google.maps.Marker({
            // ピンを差す位置を決めます。
            position: player_position,//経度・緯度で指定
            // ピンを差すマップを決めます。 上記の地図のインスタンス
            //17行目の作成した地図のインスタンス
            map: mapObj,
            // ホバーしたときに「tokyotower」と表示されるようにします。
            title: " ",
            //animation: google.maps.Animation.BOUNCE,    //アニメーション
            icon: {
                fillColor: "#FF0000",                //塗り潰し色
                fillOpacity: 0.5,                    //塗り潰し透過率
                path: google.maps.SymbolPath.CIRCLE, //円を指定
                scale: 12,                           //円のサイズ
                strokeColor: "#000000",              //枠の色
                strokeWeight: 1.0                    //枠の透過率
            },
            //現在地アイコン
            //map_icon_label:'<span class=""></span>',
            label: {
                text: " ",
                color: '#FFFFFF',                    //文字の色
                fontSize: '10px'                     //文字のサイズ
            }
        });
 */
        //定期的（自分の位置が移動していることを認識されたら）に
        //自分をさすマーカーを移動させる
/*         navigator.geolocation.watchPosition(function(pos){
            //pos.coords.heading 方角
            player_position={lat:pos.coords.latitude,lng:pos.coords.longitude};//連想配列 "lat"=>現在の緯度 "lng"=>現在の経度 latLng
            //mapObj.panTo(g_latLng);
            //BLADEのデータも更新する
            //これを利用してリアルタイムの座標を取得していく
            document.getElementById('latitude').value = pos.coords.latitude;
            document.getElementById('longitude').value = pos.coords.longitude;
            document.getElementById('nowTime').value = pos.timestamp;
            //自分の位置のマーカーを更新する
            //ひとまずマーカーを消す
            player_marker.setMap(null);
            //新しくマーカーをつける
            player_marker=new google.maps.Marker({
                position:player_position,          //位置
                map:mapObj,                     //どの地図に入れるか
                title:" ",
                animation: google.maps.Animation.BOUNCE,    //アニメーション
                icon: {
                    fillColor: "#FF0000",                //塗り潰し色
                    fillOpacity: 0.5,                    //塗り潰し透過率
                    path: google.maps.SymbolPath.CIRCLE, //円を指定
                    scale: 12,                           //円のサイズ
                    strokeColor: "#000000",              //枠の色
                    strokeWeight: 1.0                    //枠の透過率
                },
                //現在地アイコン
                //map_icon_label:'<span class=""></span>',
                label: {
                    text: " ",
                    color: '#FFFFFF',                    //文字の色
                    fontSize: '10px'                     //文字のサイズ
                }
            });

        });
 */

/*         setInterval(function(){

            navigator.geolocation.getCurrentPosition(
                function(pos){
                    //pos.coords.heading 方角
                    player_position={lat:pos.coords.latitude,lng:pos.coords.longitude};//連想配列 "lat"=>現在の緯度 "lng"=>現在の経度 latLng

                    //更新される度に、ブレードの値を変更
                    document.getElementById('latitude').value = pos.coords.latitude;
                    document.getElementById('longitude').value = pos.coords.longitude;
                    document.getElementById('nowTime').value = pos.timestamp;
                    //mapObj.panTo(g_latLng);
                    player_marker.setMap(null);
                    //新しくマーカーをつける
                    player_marker=new google.maps.Marker({
                        position:player_position,          //位置
                        map:mapObj,                     //どの地図に入れるか
                        title:" ",
                        animation: google.maps.Animation.BOUNCE,    //アニメーション
                        icon: {
                            fillColor: "#FF0000",                //塗り潰し色
                            fillOpacity: 0.5,                    //塗り潰し透過率
                            path: google.maps.SymbolPath.CIRCLE, //円を指定
                            scale: 12,                           //円のサイズ
                            strokeColor: "#000000",              //枠の色
                            strokeWeight: 1.0                    //枠の透過率
                        },
                        //現在地アイコン
                        //map_icon_label:'<span class=""></span>',
                        label: {
                            text: " ",
                            color: '#FFFFFF',                    //文字の色
                            fontSize: '10px'                     //文字のサイズ
                        }
                    });

                }
            );


        },2130);//1秒ごとに */





        /*

            ポイントのマーカーをクリックした時


        */

        //ポイントをクリックした時の処理
        //モーダルウィンドウにあるものに値をいれていく
        //ここでpoint_no をいれてform内にいれて
        //Blade側で
/*         for(let key in markers){
            markers[key].addListener('click',function(){
                document.getElementById('point_no').value = String(table[key].point_no);
                document.getElementById('text').value = String(table[key].text);
                //画像がついていれば画像を送る
                if(table[key].pict != null){
                    //画像があればimgにアドレスを送って 要素を表示
                    document.getElementById('picture').src = "https://ada-stamprally.s3.ap-northeast-3.amazonaws.com/"+String(table[key].pict);
                    document.getElementById('picture').style.display="block";
                }else{
                    //画像がなければ要素そのものを表示しない
                    //NOIMAGEをつくって貼り付けるでもいいかも
                    document.getElementById('picture').style.display='none';
                }
                    //モーダルウィンドウを開く
                document.getElementById('modalIn').click();
            });
        } */






    });//非同期処理　Promise 終了



}

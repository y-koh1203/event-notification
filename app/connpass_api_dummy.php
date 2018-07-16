<?php
    require '../vendor/autoload.php';

    /**
     * function summary
     * access to connpass api.
     * 
     * @param String $nickname search parameter for connpass API.
     * @return String $result Acquired json file from connpass API.
     **/
    function api_get_contents_d($nickname){

        $a = array (
        'results_returned' => 5,
        'events' => 
        array (
            0 => 
            array (
            'event_url' => 'https://vslt.connpass.com/event/85693/',
            'event_type' => 'participation',
            'owner_nickname' => 'konojunya',
            'series' => 
            array (
                'url' => 'https://vslt.connpass.com/',
                'id' => 4680,
                'title' => 'vsLT',
            ),
            'updated_at' => '2018-05-16T21:57:14+09:00',
            'lat' => '34.706272600000',
            'started_at' => '2018-05-28T19:00:00+09:00',
            'hash_tag' => '',
            'title' => '制作物大公開LT',
            'event_id' => 85693,
            'lon' => '135.501119800000',
            'waiting' => 0,
            'limit' => 38,
            'owner_id' => 72831,
            'owner_display_name' => 'じゅんじゅん',
            'description' => '<h1>制作物大公開LT</h1>
        <p>関西圏の大学生・専門学校のエンジニアだけのLT（5分の短いプレゼンテーション）大会です！</p>
        <p>今回は、関西大学梅田キャンパスの場所を借りて株式会社ジースタイラス社の提供のもと開催いたします。</p>
        <h1>テーマ</h1>
        <p>今回のLTのテーマは<strong>「今自分が作ってるもの、作ってきたものについての紹介」</strong>です！！
        今自分が作っているor作ってきたものについてのLTをしてもらいます。
        WebページやWebサービス、モバイルアプリやデスクトップアプリ、ゲームなどなんでも大丈夫です！！
        どんなものを作ってるかやどのような技術を使っているか、どんな工夫を凝らしているか、はたまた一緒に作る人を集めるために勧誘など様々なことを喋ってもらえればと思います。
        初心者から熟練者まで誰でも気軽にご参加ください！！！</p>
        <h1>制作物の例</h1>
        <ul>
        <li>みんなで協力して起こし合うアラーム型チャットアプリ</li>
        <li>現在地から目的地までボタン1つで遅刻するかどうかわかる電車の時刻表アプリ</li>
        <li>匿名で相談しあうことのできる掲示板アプリなどなど...</li>
        </ul>
        <h1>対象者</h1>
        <p>関西圏の大学生・専門学校生</p>
        <h2>タイムテーブル</h2>
        <p>LTは一人5分です。</p>
        <table>
        <thead>
        <tr>
        <th align="left">時間</th>
        <th align="left">内容</th>
        <th align="left">発表者（敬称略）</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td align="left">18:30</td>
        <td align="left">開場</td>
        <td align="left"></td>
        </tr>
        <tr>
        <td align="left">19:00</td>
        <td align="left">イベント開始</td>
        <td align="left"></td>
        </tr>
        <tr>
        <td align="left">20:20</td>
        <td align="left">懇親会スタート</td>
        <td align="left"></td>
        </tr>
        <tr>
        <td align="left">21:00</td>
        <td align="left">懇親会、イベント終了</td>
        <td align="left"></td>
        </tr>
        </tbody>
        </table>
        <h1>発表者LTタイトル（敬称略）</h1>
        <h1>参加費</h1>
        <p>無料（株式会社ジースタイラス様の提供で懇親会のドリンク・フードの提供をしてもらっています。）</p>
        <h1>スポンサー</h1>
        <h3>株式会社ジースタイラス様</h3>
        <p>逆求人フェスティバルを運営している会社です。</p>
        <h3>関西大学梅田キャンパス</h3>
        <h1>注意事項</h1>
        <ul>
        <li>受付票に記載の本人のみが参加できます。受付票をお持ちでない方は入場できません。受付票はスマートフォンでの提示で入場できます。</li>
        <li>不適切な行為をされた方は、運営の独断で参加をお断りいたします。</li>
        <li>投票の際に、大学名や学科、メールアドレスなどを求める場合がございます。予めご了承ください。</li>
        <li>イベントの模様は撮影される場合がございます。その場合、お客様が写り込む場合もございますので、予めご了承ください。</li>
        </ul>',
            'address' => '〒530-0014 大阪府大阪市北区鶴野町1番5号',
            'catch' => '',
            'accepted' => 21,
            'ended_at' => '2018-05-28T21:00:00+09:00',
            'place' => '関西大学梅田キャンパス KANDAI Me RISE 4階',
            ),
            1 => 
            array (
            'event_url' => 'https://nodejs.connpass.com/event/82759/',
            'event_type' => 'participation',
            'owner_nickname' => 'leichtgewicht',
            'series' => 
            array (
                'url' => 'https://nodejs.connpass.com/',
                'id' => 73,
                'title' => '東京Node学園',
            ),
            'updated_at' => '2018-03-19T22:05:27+09:00',
            'lat' => '34.709656300000',
            'started_at' => '2018-04-14T10:00:00+09:00',
            'hash_tag' => 'node JavaScript',
            'title' => 'NodeSchool Osaka #45 [2018/4/14(Sat) 10:00]',
            'event_id' => 82759,
            'lon' => '135.497464500000',
            'waiting' => 0,
            'limit' => 11,
            'owner_id' => 4393,
            'owner_display_name' => 'Martin Heidegger',
            'description' => '<h2>今回の開催について</h2>
        <p>休日のNodeSchool大阪、第21回目です。<br>
        毎月、第一土曜の午前を開催目標としています、が、都合により実施日は都度変わっています:-(<br>
        パソコンがあると便利ですが必須ではありません。</p>
        <h2>開催場所について</h2>
        <p>株式会社　ビジネストータルマネージメント （ BTM ）様のミーティングスペースを利用させて頂きます。 </p>
        <p><a href="http://www.b-tm.co.jp/" rel="nofollow">http://www.b-tm.co.jp/</a></p>
        <p>BTM様の運営サイト<br>
        ★ジョブリーフリーランス <br>
        <a href="https://jobree-freelance.jp/" rel="nofollow">https://jobree-freelance.jp/</a> </p>
        <h2>メンター</h2>
        <ul>
        <li>安部　晴文（Webフロントエンジニア)   </li>
        </ul>
        <h2>スケジュール</h2>
        <p>だいたい以下の目安で進めようと思います(いつもズレてます)  </p>
        <ul>
        <li>10:00-10:15 BTM様よりミーティングスペースの利用について説明</li>
        <li>10:15-10:25 NodeSchool大阪について</li>
        <li>10:25-11:00 NodeJSの特徴</li>
        <li>11:00-11:30 発表枠</li>
        <li>11:30-12:30 もくもく(雑談とか)</li>
        </ul>
        <div class="codehilite"><pre><span class="err">※</span><span class="n">NodeSchool</span><span class="err">中何か話したいという方がおられれば大歓迎です！</span>  
        <span class="err">是非お声掛け下さい！</span>  
        <span class="err">当日伝えて頂いても大丈夫です</span><span class="p">(</span><span class="sc">\'Д\'</span><span class="p">)</span>
        </pre></div>


        <p>ひとしきり話した後、 時間があればもくもくと、それぞれの勉強や開発をしたり、
        参加者同士で意見や知識交換をしたりしています。<br>
        といっても、実際の所、概ね発表だけで時間が無くなってしまっています^^;</p>
        <h2>発表について</h2>
        <p>発表してみようという方へ、内容は殆ど制限していません。<br>
        Nodeに関係しなくても大丈夫です。<br>
        この業界で役に立ちそうな事であればOK！<br>
        設計手法とか、マネジメントの事でも、最近のトレンドとか、<br>
        やってみたい方がおられれば是非―^^  </p>
        <h2>NodeSchoolって何？</h2>
        <p>NodeSchoolはボランティアによって世界各地で開催されているNode.jsの勉強会です。</p>',
            'address' => '〒531-0072　大阪府大阪市北区豊崎3丁目19-3 ピアスタワー大阪15F',
            'catch' => '',
            'accepted' => 6,
            'ended_at' => '2018-04-14T12:30:00+09:00',
            'place' => 'BTM様のミーティングスペース',
            ),
            2 => 
            array (
            'event_url' => 'https://vslt.connpass.com/event/70343/',
            'event_type' => 'participation',
            'owner_nickname' => 'nappannda',
            'series' => 
            array (
                'url' => 'https://vslt.connpass.com/',
                'id' => 4680,
                'title' => 'vsLT',
            ),
            'updated_at' => '2017-11-27T14:44:19+09:00',
            'lat' => '34.706272600000',
            'started_at' => '2017-11-27T18:30:00+09:00',
            'hash_tag' => 'vsLT',
            'title' => 'vsLT with Cookpad',
            'event_id' => 70343,
            'lon' => '135.501119800000',
            'waiting' => 0,
            'limit' => 28,
            'owner_id' => 76101,
            'owner_display_name' => 'なっぱんだ',
            'description' => '<h1>vsLTとは</h1>
        <p>関西圏の大学生・専門学校のエンジニアだけのLT大会です！</p>
        <p>今回は、関西大学梅田キャンパスの場所を借りてクックパッド株式会社の提供のもと開催いたします。</p>
        <h1>テーマ</h1>
        <p>今回のLTのテーマは<strong>「何でもあり（技術に少しでも触れてたらOK）」</strong>です！！
        自分の好きなことをLTしてもよし、これからやりたい技術についてLTしてもよし何でもありです！！</p>
        <p>スポンサーのクックパッド株式会社様からも会社紹介LTとエンジニアからのLTもあります！！当日参加していただくエンジニアは、技術部長の庄司さん（<a href="https://twitter.com/yoshiori" rel="nofollow">@yoshiori</a>）と新卒1年目でサービス開発をしている名渡山さん（<a href="https://twitter.com/pndcat" rel="nofollow">@pndcat</a>）です。</p>
        <h1>対象者</h1>
        <p>関西圏の大学生・専門学校生</p>
        <h2>タイムテーブル</h2>
        <p>LTは一人5分です。</p>
        <table>
        <thead>
        <tr>
        <th align="left">時間</th>
        <th align="left">内容</th>
        <th align="left">発表者（敬称略）</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td align="left">18:30</td>
        <td align="left">開場</td>
        <td align="left"></td>
        </tr>
        <tr>
        <td align="left">19:00</td>
        <td align="left">イベント開始</td>
        <td align="left"></td>
        </tr>
        <tr>
        <td align="left">19:05</td>
        <td align="left">スポンサー会社紹介LT</td>
        <td align="left">ヨシオリ</td>
        </tr>
        <tr>
        <td align="left">19:10</td>
        <td align="left">学生生活のふりかえり</td>
        <td align="left">なっちゃん</td>
        </tr>
        <tr>
        <td align="left">19:17</td>
        <td align="left">システムリプレース業務のススメ</td>
        <td align="left">ぺい</td>
        </tr>
        <tr>
        <td align="left">19:24</td>
        <td align="left">スクレイピングは避けられない!!(仮)</td>
        <td align="left">Daiki Kojima</td>
        </tr>
        <tr>
        <td align="left">19:31</td>
        <td align="left">Re:ゼロから始める端末生活</td>
        <td align="left">Tamrin</td>
        </tr>
        <tr>
        <td align="left">19:38</td>
        <td align="left">Juniperの勧め</td>
        <td align="left">katuya</td>
        </tr>
        <tr>
        <td align="left">19:45</td>
        <td align="left"></td>
        <td align="left">ヨシオリ</td>
        </tr>
        <tr>
        <td align="left">19:52</td>
        <td align="left">エンジニア × マーケティング = ???</td>
        <td align="left">がっちゃん</td>
        </tr>
        <tr>
        <td align="left">19:59</td>
        <td align="left">うちの森山みくりさん</td>
        <td align="left">hoshi</td>
        </tr>
        <tr>
        <td align="left">20:06</td>
        <td align="left">HoloLensはつらいよ</td>
        <td align="left">KeisukeHara</td>
        </tr>
        <tr>
        <td align="left">20:13</td>
        <td align="left">DDDをチーム制作でやってみた</td>
        <td align="left">44</td>
        </tr>
        <tr>
        <td align="left">20:20</td>
        <td align="left">懇親会スタート</td>
        <td align="left"></td>
        </tr>
        <tr>
        <td align="left">21:00</td>
        <td align="left">懇親会、イベント終了</td>
        <td align="left"></td>
        </tr>
        </tbody>
        </table>
        <h1>発表者LTタイトル（敬称略）</h1>
        <h2>ヨシオリ</h2>
        <h2>なっちゃん</h2>
        <p><strong> 学生生活のふりかえり </strong></p>
        <h2>がっちゃん</h2>
        <p><strong> エンジニア × マーケティング = ??? </strong></p>
        <h2>ぺい</h2>
        <p><strong> システムリプレース業務のススメ </strong></p>
        <h2>Tamrin</h2>
        <p><strong> Re:ゼロから始める端末生活 </strong></p>
        <h2>KeisukeHara</h2>
        <p><strong> HoloLensはつらいよ </strong></p>
        <h2>Daiki Kojima</h2>
        <p><strong> スクレイピングは避けられない!!(仮) </strong></p>
        <h2>katuya</h2>
        <p><strong> Juniperの勧め </strong></p>
        <h2>hoshi</h2>
        <p><strong> うちの森山みくりさん </strong></p>
        <h2>44</h2>
        <p><strong> DDDをチーム制作でやってみた </strong></p>
        <h1>参加費</h1>
        <p>無料（クックパッド株式会社様の提供で懇親会のドリンク・フードの提供をしてもらっています。）</p>
        <h1>スポンサー</h1>
        <h3>クックパッド株式会社様</h3>
        <p>日本最大の料理レシピ投稿・検索サービス<a href="https://cookpad.com/" rel="nofollow">「クックパッド」</a>を運営している会社です。1998年3月にサービス開始し、現在投稿レシピ数は270万品以上、月間約6000万人にご利用いただいています。<br>
        <a href="https://info.cookpad.com/" rel="nofollow">クックパッド株式会社 会社概要</a></p>
        <h1>注意事項</h1>
        <ul>
        <li>採用・宣伝・飲食のみを目的としての参加はお断りいたします。</li>
        <li>受付票に記載の本人のみが参加できます。受付票をお持ちでない方は入場できません。受付票はスマートフォンでの提示で入場できます。</li>
        <li>不適切な行為をされた方は、運営の独断で参加をお断りいたします。</li>
        <li>投票の際に、大学名や学科、メールアドレスなどを求める場合がございます。予めご了承ください。</li>
        <li>イベントの模様は撮影される場合がございます。その場合、お客様が写り込む場合もございますので、予めご了承ください。</li>
        </ul>',
            'address' => '〒530-0014 大阪府大阪市北区鶴野町1番5号',
            'catch' => '関西のエンジニア学生によるLT大会です！',
            'accepted' => 22,
            'ended_at' => '2017-11-27T21:00:00+09:00',
            'place' => '関西大学梅田キャンパス KANDAI Me RISE 4階',
            ),
            3 => 
            array (
            'event_url' => 'https://connpass.com/event/68153/',
            'event_type' => 'participation',
            'owner_nickname' => 'nappannda',
            'series' => NULL,
            'updated_at' => '2017-10-24T14:30:33+09:00',
            'lat' => '34.702334000000',
            'started_at' => '2017-10-28T18:30:00+09:00',
            'hash_tag' => 'vsLT',
            'title' => 'vsLT第3回',
            'event_id' => 68153,
            'lon' => '135.500148300000',
            'waiting' => 0,
            'limit' => 26,
            'owner_id' => 76101,
            'owner_display_name' => 'なっぱんだ',
            'description' => '<h1>vsLTとは</h1>
        <p>関西圏の大学生・専門学校のエンジニアだけのLT大会です！</p>
        <p>今回は、株式会社サイバーエージェント様のスペース(梅田の富国生命ビル)をお貸ししてもらい開催いたします。</p>
        <h1>テーマ</h1>
        <p>今回のLTのテーマは<strong>「サマーインターンシップ」</strong>です！！</p>
        <p>サマーインターンに参加した会社を登壇者の方は1社選んでいただき、LTしていただきます！</p>
        <p>1,2年生の方は来年、再来年を見据えてどんな企業がどんなことをしているのかを聞きに来てください！</p>
        <p>3年生の方は、友達や興味があったけど行けなかった企業のインターンの様子を見に来るのはどうでしょうか！！</p>
        <h1>対象者</h1>
        <p>関西圏の大学生・専門学校の1,2年生！
        3,4年生もインターンは終わったかと思いますが、他のインターンがどんな感じだったのか聞きたい人もいると思うので是非お越しください！</p>
        <h2>タイムテーブル</h2>
        <p>LTは一人5分です。</p>
        <table>
        <thead>
        <tr>
        <th align="left">時間</th>
        <th align="left">内容</th>
        <th align="left">発表者</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td align="left">18:30</td>
        <td align="left">開場</td>
        <td align="left"></td>
        </tr>
        <tr>
        <td align="left">19:00</td>
        <td align="left">イベント開始</td>
        <td align="left"></td>
        </tr>
        <tr>
        <td align="left">20:00</td>
        <td align="left">懇親会スタート</td>
        <td align="left"></td>
        </tr>
        <tr>
        <td align="left">21:00</td>
        <td align="left">懇親会、イベント終了</td>
        <td align="left"></td>
        </tr>
        </tbody>
        </table>
        <h1>参加費</h1>
        <p>無料</p>
        <h1>注意事項</h1>
        <ul>
        <li>採用・宣伝・飲食のみを目的としての参加はお断りいたします。</li>
        <li>受付票に記載の本人のみが参加できます。受付票をお持ちでない方は入場できません。受付票はスマートフォンでの提示で入場できます。</li>
        <li>不適切な行為をされた方は、運営の独断で参加をお断りいたします。</li>
        <li>投票の際に、大学名や学科、メールアドレスなどを求める場合がございます。予めご了承ください。</li>
        <li>イベントの模様は撮影される場合がございます。その場合、お客様が写り込む場合もございますので、予めご了承ください。</li>
        </ul>',
            'address' => '大阪府大阪市北区小松原町2番4号（ 大阪富国生命ビル　18階）',
            'catch' => '関西のエンジニア学生によるLT大会です！',
            'accepted' => 8,
            'ended_at' => '2017-10-28T21:00:00+09:00',
            'place' => '株式会社サイバーエージェント大阪支社',
            ),
            4 => 
            array (
            'event_url' => 'https://sha.connpass.com/event/53105/',
            'event_type' => 'participation',
            'owner_nickname' => 'shhhh',
            'series' => 
            array (
                'url' => 'https://sha.connpass.com/',
                'id' => 2023,
                'title' => 'super-hackathon',
            ),
            'updated_at' => '2017-04-13T16:03:29+09:00',
            'lat' => '34.704328000000',
            'started_at' => '2017-04-14T19:00:00+09:00',
            'hash_tag' => '',
            'title' => '2時間で学ぶ React ハンズオン in Osaka Vol.2',
            'event_id' => 53105,
            'lon' => '135.494804300000',
            'waiting' => 24,
            'limit' => 50,
            'owner_id' => 80074,
            'owner_display_name' => 'Masaaki Fujii',
            'description' => '<h2>概要</h2>
        <p><a href="https://sha.connpass.com/event/39791/" rel="nofollow">2016年の秋</a>にも実施した「2時間で学ぶ React ハンズオン」の第二弾を実施いたします。</p>
        <p>ReactはFacebookとInstagramで作られた、UIを作るためのJavaScriptライブラリです。複雑な構造データをシンプルにUIへ反映することや、再利用可能なコンポーネントを作るために開発されています。</p>
        <p>JSX構文と呼ばれる、JavaScriptとHTMLを組み合わせた独自の書式でコンポーネントを作成し、複数のコンポーネントを組み合わせていくことでWebアプリケーションを構築していきます。</p>
        <p>Reactは FacebookMessengerやInstagramなどで、ネイティブアプリと同等のUIを実現するために使われています。</p>
        <hr>
        <h3><font color="Red">補欠参加の方へ。参加者の方が当日お越しにならない場合があるため、必ず空席があります。補欠であっても、気にせずにご来場ください。</font></h3>
        <hr>
        <h4><font color="Red">・本ハンズオンは個々のスキル向上を目的とて、無償にて実施しております。ハンズオン内容の転売や、ビジネスを目的とされる方のご参加はお断りしております。何卒ご了承ください。</font></h4>
        <hr>
        <h2>対象者</h2>
        <h3>初級者と中級者以上両方が楽しめるハンズオンにします</h3>
        <p>このハンズオンはjQueryを使ったことがあるデザイナーから、モダンなJavaScript開発を仕事に取り入れてみたいと考えているエンジニアを対象にしています。また前回の参加者を考慮し、初級者と中級者以上の両方が楽しめる教材を開発する予定です。</p>
        <h2>準備するもの</h2>
        <ul>
        <li>Node.js（v4以降）がインストールされたPC（Windows/Mac/Linux）をご準備下さい。</li>
        <li>インストール方法がわからないという方は当日スタッフにお声かけ下さい。</li>
        <li>お気に入りのエディタ（Sublime Text、Atomなど）</li>
        </ul>
        <h2>ハンズオンの流れ</h2>
        <p>ハンズオンスタート後、課題を一緒に開発していきます。
        課題は初心者向け（Lv1）、中級者向け（Lv2）の２パターンを用意します。中級者以上はLv1を飛ばしてご参加ください。</p>
        <ol>
        <li>Reactを含めたJavaScript開発環境の背景解説</li>
        <li>Reactの解説と開発環境構築</li>
        <li>Hello React　初めてのReactコンポーネントを作成します。</li>
        <li>課題解説（Lv1）ハンズオンで作成する課題について解説します。</li>
        <li>Lv1開始</li>
        <li>課題解説（Lv2）Lv2の課題について解説します</li>
        <li>（Lv1が完了した人）Lv2開始</li>
        </ol>
        <p>物足り無い人向けの追加課題も用意します。</p>
        <h2>課題Lv1 Reactコンポーネントの作成</h2>
        <p>課題内容は前回からアップデートします。詳細は後日公開します。</p>
        <p>【この課題で学ぶ事】</p>
        <ul>
        <li>Reactコンポーネントの作り方</li>
        <li>データの受け渡し方法</li>
        <li>jQueryとの作り方の違い</li>
        </ul>
        <h2>課題Lv2 SPA開発</h2>
        <p>課題内容は前回からアップデートします。詳細は後日公開します。
        Fluxなどの実践的な知識についても解説する予定です。</p>
        <p>【この課題で学ぶ事】</p>
        <ul>
        <li>Reactらしい設計手法</li>
        <li>Reactでのデータの取り扱い</li>
        <li>実践的な内容への導入</li>
        </ul>
        <hr>
        <h2>参加費</h2>
        <p>無料 [学生大歓迎！]</p>
        <hr>
        <h2>定員</h2>
        <p><del>30名</del></p>
        <p>↓</p>
        <p><strong>50名</strong></p>
        <p>(初級者の参加者多数のため、増員しました。3/18)</p>
        <hr>
        <h2>当日の流れ</h2>
        <h3>開場18:30,19:00スタート</h3>
        <p>後日公開します。</p>
        <hr>
        <h2>講師</h2>
        <ul>
        <li>河野 純也 (Lebe Inc. フロントエンドエンジニア)</li>
        <li>宮澤 了祐 (Lebe Inc. CTO)</li>
        <li>藤井 正明 (Lebe Inc. 代表)</li>
        </ul>
        <hr>
        <h2>主催</h2>
        <ul>
        <li>SUPER-HACKATHON / Lebe Inc.</li>
        </ul>
        <hr>
        <h2>協力・共催</h2>
        <ul>
        <li><a href="http://www.innovation-osaka.jp/" rel="nofollow">大阪イノベーションハブ</a></li>
        </ul>
        <hr>
        <h2>ハンズオンについて</h2>
        <p>初学者にはReactのようなフレームワークを学習する上でハードルとなる、最初の一歩目をクリアするためのハンズオンです。中級者以上には、独学でJavaScriptフレームワークを利用している方にとって、再学習する機会として実施します。ぜひ気軽に参加いただけると嬉しく思います。</p>',
            'address' => '大阪府大阪市 北区大深町3番1号 グランフロント大阪 ナレッジキャピタルタワー C7階',
            'catch' => '',
            'accepted' => 47,
            'ended_at' => '2017-04-14T21:00:00+09:00',
            'place' => '大阪イノベーションハブ',
            ),
        ),
        'results_start' => 1,
        'results_available' => 5,
        );

        return $a;
    }
    

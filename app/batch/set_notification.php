<?php

    require '/Applications/XAMPP/xamppfiles/htdocs/event-notification/vendor/autoload.php';
    require '/Applications/XAMPP/xamppfiles/htdocs/event-notification/app/database.php';
    use Abraham\TwitterOAuth\TwitterOAuth;

    $dotenv = new Dotenv\Dotenv('/Applications/XAMPP/xamppfiles/htdocs/event-notification/');
    $dotenv->load();

    //PDOラッパーのインスタンスを生成
    $pdo = new database();

    //Twitter OAuth インスタンスを生成
    $connection = new TwitterOAuth($_ENV['TWITTER_API_KEY'],$_ENV['TWITTER_API_SECRET'],$_ENV['MY_ACCESS_TOKEN'],$_ENV['MY_ACCESS_TOKEN_SECRET']);
    var_dump($_ENV['TWITTER_API_KEY'],$_ENV['TWITTER_API_SECRET'],$_ENV['MY_ACCESS_TOKEN'],$_ENV['MY_ACCESS_TOKEN_SECRET']);
    $now = time();

    // DBからイベントを取り出す際に、指定日時の分UNIXTIMEを減算する
    // 減算した結果から現在のUNIXTIMEを減算し、指定日時の UNIXTIMEを超えていれば通知を実行する

    // day1
    $query_d1 = "select id, screen_name, event_name, (date - 86400) as date, notice_date, url from reminder where (date - {$now}) < 86400 and notice_date = 1 and end = 0 ;";
    $res[] = $pdo->select($query_d1);
    
    // day3
    $query_d3 = "select id, screen_name, event_name, (date - 259200) as date, notice_date, url from reminder where (date - {$now}) < 259200 and notice_date = 3 and end = 0 ;";
    $res[] = $pdo->select($query_d3);
    
    // day5
    $query_d5 = "select id, screen_name, event_name, (date - 432000) as date, notice_date, url from reminder where (date - {$now}) < 432000 and notice_date = 5 and end = 0 ;";
    $res[] = $pdo->select($query_d5);

    //ツイートの送信
    foreach($res as $data){
        foreach($data as $notice){
            $connection->post(
                "statuses/update",
                array(
                    "status" => "@{$notice['screen_name']}  
イベント、{$notice['event_name']}の{$notice['notice_date']}日前です! 
{$notice['url']}"
                )
            );
        }
    }

    //送信済みの通知を無効化
    foreach($res as $data){
        foreach($data as $notice){
            $pdo->update('reminder',['end'],[1],['id' => $notice['id']]);
        }
    }

    exit();
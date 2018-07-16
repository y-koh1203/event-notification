<?php
    require '../app/connpass_api_dummy.php';
    require '../vendor/autoload.php';

    $nickname = 'yamakoh';
    $contents = api_get_contents_d($nickname);
    //$contents = null;

    if($contents === null){
        session_start();
        $_SESSION['error'] = '検索されたニックネームは存在しません';
        header('Location: welcome.php');
        exit();
    }

    $arrData = [
        'start_date' => $contents['events'][0]['started_at'],
        'owner_user' => $contents['events'][0]['owner_nickname']
    ];

    include 'notice.php';

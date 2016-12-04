<?php
    /**
     * ユーザー一覧を取得する
     */
    header("Content-Type: application/json");

    try {
        $db=new SQLite3('../db/weekly_reports.sqlite3');
        
        $sql_result=$db->query("SELECT * FROM users");
        
        $result=array(); 
        while($data=$sql_result->fetchArray()) {
            $result[] = json_decode($data["json"]);
        }
        $db->close();
        print json_encode($result);
    } catch (Exception $e) {
        print '{ "error": "DBへの接続でエラーが発生しました。" }';
    }
?>

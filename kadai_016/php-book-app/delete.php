<?php
$dsn = 'mysql:dbname=php_book_app;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root';

try {
    $pdo = new PDO($dsn, $user, $password);

    // idカラムの値をプレースホルダに置き換えたSQL文をあらかじめ用意
    $sql_delete = 'DELETE FROM books WHERE id = :id';
    $stmt_delete = $pdo->prepare($sql_delete);

    // bindValue()メソッドを使って実際の値をプレースホルダにバインド
    $stmt_delete->bindValue(':id', $_GET['id'],PDO::PARAM_INT);

    // SQL文を実行
    $stmt_delete->execute();

    // 削除した件数を取得
    $count = $stmt_delete->rowCount();

    $message = "商品を{$count}件削除しました。";

    // 書籍一覧ページにリダイレクト（同時にmessageパラメータも渡す)
    header("Location: read.php?message={$message}");
} catch (PDOException $e) {
    exit($e->getMessage());
}
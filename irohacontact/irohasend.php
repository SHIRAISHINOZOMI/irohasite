<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>メール送信完了｜メール送信フォーム</title>
</head>
<body>

<?php
/*******************************
 データの受け取り 
*******************************/
$nation=$_POST['nation'];
$YESNO=(int)$_POST['YESNO'];
$times=(int)$_POST['times'];
$knows=$_POST['knows'];
$name= $_POST["name"];		//お名前
$namefuri=$_POST['namefuri'];
$mail	= $_POST["mail"];	//メールアドレス
$lineid=$_POST['lineid'];
$comment	= $_POST["inquiry"];		//お問合せ内容

//危険な文字列を入力された場合にそのまま利用しない対策
$namae		= htmlspecialchars($name, ENT_QUOTES);
$mail	= htmlspecialchars($mail, ENT_QUOTES);
$comment		= htmlspecialchars($comment, ENT_QUOTES);

/*******************************
 未入力チェック 
*******************************/
$errmsg = '';	//エラーメッセージを空にしておく
if ($nation == '') {
	$errmsg = $errmsg.'<p>日本人か留学生か入力されてません。</p>';
}
if ($YESNO == '') {
	$errmsg = $errmsg.'<p>参加経験が入力されてません。</p>';
}
if ($knows == '') {
	$errmsg = $errmsg.'<p>どこで知ったかが入力されていません。</p>';
}    
if ($name == '') {
	$errmsg = $errmsg.'<p>お名前が入力されていません。</p>';
}
if ($mail == '') {
	$errmsg = $errmsg.'<p>メールアドレスが入力されていません。</p>';
}
if ($comment == '') {
	$errmsg = $errmsg.'<p>お問合せ内容が入力されていません。</p>';
}

/*******************************
 メール送信の実行
*******************************/
if ($errmsg != '') {
	//エラーメッセージが空ではない場合には、[前のページへ戻る]ボタンを表示する
	echo $errmsg;
	
	//[前のページへ戻る]ボタンを表示する
	echo '<form method="post" action="iroha.php">';
    echo '<input type="hidden" name="nation" value="'.$nation.'">';
    echo '<input type="hidden" name="YESNO" value="'.$YESNO.'">';
    echo '<input type="hidden" name="knows" value="'.$knows.'">';
	echo '<input type="hidden" name="name" value="'.$name.'">';
	echo '<input type="hidden" name="mail" value="'.$mail.'">';
	echo '<input type="hidden" name="naiyou" value="'.$comment.'">';
	echo '<input type="submit" name="backbtn" value="前のページへ戻る">';
	echo '</form>';
} else {
	//エラーメッセージが空の場合には、メール送信処理を実行する
	//メール本文の作成
	$honbun = '';
	$honbun .= "メールフォームよりお問い合わせがありました。\n\n";
	$honbun .= "【お名前】\n";
	$honbun .= $name."\n\n";
    $honbun .= "【お名前ふりがな】\n";
	$honbun .= $namefuri."\n\n";
	$honbun .= "【メールアドレス】\n";
	$honbun .= $mail."\n\n";
    $honbun .= "【日本人or留学生】\n";
	$honbun .= $nation."\n\n";
    $honbun .= "【参加の有無】\n";
	$honbun .= $YESNO."\n\n";
    $honbun .= "【参加回数】\n";
	$honbun .= $times."\n\n";
    $honbun .= "【どこで知ったか】\n";
	$honbun .= $knows."\n\n";
    $honbun .= "【LINEID】\n";
	$honbun .= $lineid."\n\n";
	$honbun .= "【お問い合わせ内容】\n";
	$honbun .= $comment."\n\n";
	
	//エンコード処理
	mb_language("Japanese");
	mb_internal_encoding("UTF-8");

	//メールの作成
	$mail_to	= "irohahirodai@gmail.com";			//送信先メールアドレス
	$mail_subject	= "メールフォームよりお問い合わせ";	//メールの件名
	$mail_body	= $honbun;				//メールの本文
	$mail_header	= "from:".$mail;			//送信元として表示されるメールアドレス
	
	//メール送信処理
	$mailsousin	= mb_send_mail($mail_to, $mail_subject, $mail_body, $mail_header);
	
	//メール送信結果
	if($mailsousin == true) {
		echo '<p>お問い合わせメールを送信しました。</p>';
	} else {
		echo '<p>メール送信でエラーが発生しました。</p>';
	}
}
?>

</body>
</html>
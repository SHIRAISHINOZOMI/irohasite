<!DOCTYPE html>
<?php
$nation=$_POST['nation'];
$YESNO=(int)$_POST['YESNO'];
$times=(int)$_POST['times'];
$knows=$_POST['knows'];
$name=$_POST['name'];
$namefuri=$_POST['namefuri'];
$mail=$_POST['mail'];
$lineid=$_POST['lineid'];
$comment=$_POST['inquiry'];
//危険な文字列を入力された場合にそのまま利用しない対策
$namae		= htmlspecialchars($name, ENT_QUOTES);
$mail	= htmlspecialchars($mail, ENT_QUOTES);
$comment		= htmlspecialchars($comment, ENT_QUOTES);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
 
<body>
 
<h2>問合せ内容確認(Confirm Page)</h2> 
     
<form action="mailto.php" method="post">
 
<table border="1">
<tr>
<td>留学生OR日本人(International student or Japanese)</td>
<td><?php echo $nation;?></td>
</tr>
<tr>
    
<tr>
<td>いろはに参加したことはありますか？(Have you ever joined?)</td>
<td>
    <?php 
     if($YESNO===1){
         echo 'はい(yes)'; 
    }elseif($YESNO===2){
          echo 'いいえ(no)';
     }?>
</td>
</tr>
<tr>
    
<tr>
<td>何回くらい参加しましたか？(Have many times did you join?)</td>
<td>
    <?php 
     if($times===1){
         echo '一回(Once)'; 
    }elseif($times===2){
          echo '2回(Twice)';
     }elseif($times===3){
          echo '3回(Three times)';
     }elseif($times===4){
          echo '4回(Over four times)';
     }?>
</td>
</tr>
 
<tr>    
<td>どこでいろはについて知りましたか？(How did you know IROHA)</td>
<td>
    <?php echo implode($knows);?>
</td>
</tr>
    
<tr>    
<td>名前(NAME)</td>
<td><?php echo $name; ?></td>
</tr>
<tr>
<td>名前ふりがな</td>
<td><?php echo $namefuri; ?></td>
</tr>
<tr>
<td>メールアドレス(e-mail)</td>
<td><?php echo $mail; ?></td>
</tr>
<tr>
<tr>
<td>LINE ID</td>
<td><?php echo $lineid; ?></td>
</tr>
<tr>
<td>問い合わせ内容(inquiry)</td>
<td><?php echo nl2br($comment); ?></td>
</tr>
</table>

 <?php   
/*******************************
 未入力チェック 
*******************************/
$errmsg = '';	//エラーメッセージを空にしておく
if ($nation == '') {
	$errmsg = $errmsg.'<p>*日本人か留学生か入力されてません。</p>';
}
if ($YESNO == '') {
	$errmsg = $errmsg.'<p>*参加経験が入力されてません。</p>';
}
if ($knows == '') {
	$errmsg = $errmsg.'<p>*どこで知ったかが入力されていません。</p>';
}    
if ($name == '') {
	$errmsg = $errmsg.'<p>*お名前が入力されていません。</p>';
}
if ($mail == '') {
	$errmsg = $errmsg.'<p>*メールアドレスが入力されていません。</p>';
}
if ($comment == '') {
	$errmsg = $errmsg.'<p>*お問合せ内容が入力されていません。</p>';
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
    //echo '<input type="hidden" name="knows" value="'.$knows.'">';
	echo '<input type="hidden" name="name" value="'.$name.'">';
	echo '<input type="hidden" name="mail" value="'.$mail.'">';
	echo '<input type="hidden" name="naiyou" value="'.$comment.'">';
	echo '<a href="./iroha.html">前のページに戻る</a>';
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
  /*  $honbun .= "【どこで知ったか】\n";
	$honbun .= $knows."\n\n";*/
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
		echo '<p>お問い合わせメールを送信しましす。</p>';
	} else {
		echo '<p>メール送信でエラーが発生しました。</p>';
	}
}
?>
 
<input type="submit" value="SEND" />
</form>
 
</body>
    
</html>


<!---->





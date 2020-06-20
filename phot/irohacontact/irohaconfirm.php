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
 
<input type="submit" value="SEND" />
</form>
 
</body>
    
</html>


<!---->





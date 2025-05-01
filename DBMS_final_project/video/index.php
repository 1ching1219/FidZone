<html>
<head>
  <script src='https://cdn.scaledrone.com/scaledrone.min.js'></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="../whole.css">
  <style>
    video {
      height:340px;
      width: 540px;
      padding: none;
      background-size: 454px;
      background-position: center center;
      background-color:white;
      background-blend-mode: multiply!important;
      background-repeat: no-repeat;
      
    }
    video:after{
      opacity: 1;
    }
    .copy {
      position: fixed;
      top: 10px;
      left: 50%;
      transform: translateX(-50%);
      font-size: 16px;
      color: white;
    }
    .disclaimer{
      display:none!important;
    }
  
  </style>
</head>
<body >
<?php
  $db=new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
  $from_id=$_GET["from"];
  $to_id=$_GET["to"];
  $already=$_GET["already"];
  if($already==1){

    $not="SELECT `answer`, time_start FROM `video` WHERE (`to_id`=$to_id AND `from_id`=$from_id)  AND `time_start`=(SELECT MAX(time_start) FROM `video` WHERE to_id=$to_id AND from_id=$from_id) UNION SELECT `answer`, time_start FROM `video` WHERE (`to_id`=$from_id AND `from_id`=$to_id)  AND `time_start`=(SELECT MAX(time_start) FROM `video` WHERE to_id=$from_id AND from_id=$to_id)";
    $not=$db->prepare($not);
    $not->execute();
    $not=$not->fetch();

  
    if($not[0]!=1){
      header("Refresh:1");
    }
    if($not[0]==-1){
      $path="location:../send.php?to=".$to_id."&from=".$from_id."#here";
      header($path);
    }
  }
?>

<div class="main" id="body" style="max-height:722px">
    <video id="localVideo" autoplay muted style="border-bottom:1px solid gray"></video>
    <video id="remoteVideo" autoplay ></video>
    <button onclick="location.href='../update_calltime.php?to=<?=$to_id?>&from=<?=$from_id?>'" style="border:none; background-color:white;position:relative; left: 240px;top:5px;z-index:10"><img src="../source/phone-call.png" style="width:40px;height:40px;"></button>
    <script src="script.js"></script>
    <form action="video_sql.php" method="POST" id="formm">
      <input type="hidden" id="hash" name="hash">
      <input type="hidden" name="to" value="<?=$to_id?>">
      <input type="hidden" name="from" value="<?=$from_id?>">
    </form>

</div>

<script>
  var hash=document.getElementById("hash");
  var formm=document.getElementById("formm");
  hash.value=window.location.hash;
  <?php if($already==0){ ?>
  formm.submit();
  <?php }else{ 
    $db=new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $pic="SELECT profile_photo, a_Name FROM account WHERE aId=$to_id";
    $pic=$db->prepare($pic);
    $pic->execute();
    $pic=$pic->fetch();
  ?>
  var video=document.getElementById('remoteVideo');
  var create=document.createElement('div');
  var loading=document.createElement('div');
  var img=document.createElement('img');
  var load=document.createElement('img');
  img.src = "../profile_img/<?=$pic["profile_photo"]?>";
  loading.style="position:relative;bottom:360px;left:165px;z-index:1";
  img.style="height:170px;width:170px"
  load.src="../source/Balls.gif";
  load.style="width:200px;height:150px;";
  create.style="height:170px;width:170px;border-radius:50%;overflow:hidden;position:relative;bottom:320px;left:185px;z-index:2";

  video.addEventListener('loadeddata', (e) => {
   //Video should now be loaded but we can add a second check

   if(video.readyState >= 3){
       create.style.zIndex="-10"
       loading.style.zIndex="-10"
   }

});
  create.appendChild(img);
  loading.appendChild(load);
  document.getElementById("body").appendChild(create);
  document.getElementById("body").appendChild(loading);
  
  var video2=document.getElementById('localVideo');
  var create2=document.createElement('div');
  var img2=document.createElement('img')
  img2.src = "../source/Dual.gif";
  img2.style="height:100px;width:100px"
  create2.style="height:100px;width:100px;position:relative;bottom:930px;left:220px";


  video2.addEventListener('loadeddata', (e) => {
   //Video should now be loaded but we can add a second check

   if(video2.readyState >= 3){
       create2.style.zIndex="-10"
   }

});
  create2.appendChild(img2);
  document.getElementById("body").appendChild(create2);

<?php
  }
?>
</script>


</body>
</html>
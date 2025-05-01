
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="../whole.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"
    />

    <style>
        .btn:hover{
            color:#66afe9;
        }
    </style>
  <body>

    <div class="main" >
     <br><br><br>
     <button onclick="location.href='../edit_person_info.php?account=<?=$_GET['account']?>'" class="btn">cancle</button>
     <button onclick="thisone.submit()" class="btn" style="position:relative;left:380px">finish</button>
        <div style="background-color: white;overflow: hidden;height: 90%;">
     
            <form method="POST" id="thisone" action="take_picture.php">
                
                <div>
                    <div id="my_camera" ></div>
                    
                    <img src="../source/camera_format.png"  style="position:relative;bottom:480px;right:10px">
                    
                    <br>
                    <input type="button" value="Take Picture" onClick="take_snapshot()" class="sub" style="position:relative;bottom:480px;left: 100px;">
                    <input type="hidden" name="image" class="image-tag" />
                    <input type="hidden" name="account" value="<?=$_GET['account']?>">
                </div>
                
            </form>
            
    
            <script language="JavaScript">
                Webcam.set({
                    width: 490,
                    height: 390,
                    image_format: "jpeg",
                    jpeg_quality: 90,
                });
            
                Webcam.attach("#my_camera");
                
            
                function take_snapshot() {
                    Webcam.snap(function (data_uri) {
                    $(".image-tag").val(data_uri);
                    document.getElementById("my_camera").innerHTML =
                        '<img src="' + data_uri + '"/ style="width:490px;height:380px;">';
                    });
                }
            </script>
  </body>
</html>
 
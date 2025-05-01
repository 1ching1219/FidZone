<!DOCTYPE html>
<html>
    <head>
        <title>fidZone | CREAT ACCOUNT</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="whole.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    
    <body>
    <div class="body1">
        <form action="insert_account.php" method="POST" enctype="multipart/form-data" onsubmit="return check(event);" >
        <label for="file">    
            <div class="profile">
            <img src="profile_img/user.png" style="width:150px; height:150px" alt="" id="this_one">
            </div>
        </label> 
            <input type="file" accept="image/*" name="profile_photo[]" multiple class="myButton" id="file" style="display:none"><br>
            <input type="text" placeholder="Nickname" name="a_Name" required class="txt"><br>
            <input type="text" placeholder="Account" name="account" required class="txt"><br>
            <input type="password" placeholder="Password" name="a_password" required class="txt"><br>
            <div class="a_type">
            <label style="font-size:15px"><input type="radio" name="a_Type" value="public" >Public account</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <label style="font-size:15px"><input type="radio" name="a_Type" value="private" >Private account</label><br>
            </div>
            <input type="submit" value="SIGN UP" style="background-color:#66afe9;border:none; color:white;font-weight:530" class="sub">
        </form>
    </div>
    </body>
    
    <script>
        //在input file內容改變的時候觸發事件
        $('#file').change(function(){
        //獲取input file的files檔案陣列;
        //$('#filed')獲取的是jQuery物件，.get(0)轉為原生物件;
        //這邊預設只能選一個，但是存放形式仍然是陣列，所以取第一個元素使用[0];
        var file = $('#file').get(0).files[0];
        //建立用來讀取此檔案的物件
        var reader = new FileReader();
        //使用該物件讀取file檔案
        reader.readAsDataURL(file);
        //讀取檔案成功後執行的方法函式
        reader.onload=function(e){
        //讀取成功後返回的一個引數e，整個的一個進度事件
        console.log(e);
        //選擇所要顯示圖片的img，要賦值給img的src就是e中target下result裡面
        //的base64編碼格式的地址
        $('#this_one').get(0).src = e.target.result;
        }
        })
    </script>
</html>
<fieldset>
    <div>請輸入信箱以查詢密碼</div>
    <div><input type="text" name="email" id="email"></div>
    <div id="result" style="color:blue;"></div>
    <div><button onclick="findPw()">尋找</button></div>
</fieldset>

<script>
    function findPw(){
        $.post('./api/find_pw.php',{email:$('#email').val()},(res)=>{
            $('#result').html(res);
        })
    }
</script>
<fieldset>
    <legend>會員登入</legend>
    <table>
    <tr>
        <td>帳號</td>
        <td><input type="text" name="acc" id="acc"></td>
    </tr>
    <tr>
        <td>密碼</td>
        <td><input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
        <td>
            <button onclick="login()">登入</button>
            <button onclick="$('table input').val('')">清除</button>
        </td>
        <td class="r">
            <a href="?do=forgot">忘記密碼</a> |
            <a href="?do=reg">尚未註冊</a>
        </td>
    </tr>
    </table>
</fieldset>

<script>
    function login(){
        let acc=$("#acc").val()
            pw=$("#pw").val()

            $.post("./api/chk_acc.php",{acc},(res)=>{
                if(parseInt(res)==1){
                    $.post('./api/chk_pw.php',{acc,pw},(res)=>{
                        if(parseInt(res)==1){
                            if(acc==='admin'){
                                location.href='back.php'
                            }else{
                                location.href='index.php'
                            }
                        }else{
                            alert("密碼錯誤")
                        }
                    })
                }else{
                    alert("查無帳號")
                }
            })
    }
</script>
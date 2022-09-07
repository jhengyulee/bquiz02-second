<fieldset>
    <legend>會員註冊</legend>
    <div style="color: red;">*請設定您要註冊的帳號及密碼</div>
    <table>
        <tr>
            <td class="clo">帳號:</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td class="clo">密碼:</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td class="clo">確認密碼:</td>
            <td><input type="password" name="pw2" id="pw2"></td>
        </tr>
        <tr>
            <td class="clo">信箱(忘記密碼用)</td>
            <td><input type="text" name="email" id="email"></td>
        </tr>
        <tr>
            <td>
                <button onclick="reg()">註冊</button>
                <button onclick="$('table input').val('')">清除</button>
            </td>
            <td></td>
        </tr>
    </table>
</fieldset>

<script>
    function reg(){
        let user={
            acc:$('#acc').val(),
            pw:$('#pw').val(),
            pw2:$('#pw2').val(),
            email:$('#acc').val()
        }   
        
            if(user.acc == '' || user.pw == '' || user.pw2 == '' || user.email == '' ){
                alert('欄位不可空白')
            }else if(user.pw!=user.pw2){
                alert('密碼錯誤')
            }else{
                $.post('./api/chk_acc.php',{acc:user.acc},(res)=>{
                    if(parseInt(res)==1){
                        alert('帳號重複')
                    }else{
                        $.post('./api/reg.php',user,()=>{
                            alert("註冊完成，請重新登入")
                            location.href='?do=login';
                        })
                    }
                
                })
                    
            }
                   
        
    }
    </script>
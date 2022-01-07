<fieldset>
    <legend>帳號管理</legend>
    <form action="api/del_user.php" method='post'>
        <table class="ct" style="width:75%;margin:auto;">
            <tr class="clo">
                <td width="35%">帳號</td>
                <td width="35%">密碼</td>
                <td width="10%">刪除</td>
            </tr>
            <?php
            $users=$User->all();
            foreach($users as $key => $user){
            ?>
            <tr>
                <td><?=$user['acc'];?></td>
                <td><?=str_repeat("*",mb_strlen($user['pw']));?></td>
                <td><input type="checkbox" name="del[]" value="<?=$user['id'];?>"></td>
            </tr>
            <?php
            }?>
        </table>
        <div class="ct">
            <input type="submit" value="確定刪除">
            <input type="reset" value="清空選取">
        </div>
    </form>

<h1>會員註冊</h1>
    <div style="color:red;">*請設定您要註冊的帳號及密碼(最長12個字元)</div>
    <table>
        <tr>
            <td>Step1:登入帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td>Step2:登入密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td>Step3:再次確認密碼</td>
            <td><input type="password" name="pw2" id="pw2"></td>
        </tr>
        <tr>
            <td>Step4:信箱(忘記密碼時使用)</td>
            <td><input type="next" name="email" id="email"></td>
        </tr>
        <tr>
            <td>
                <button onclick="reg()">註冊</button>
                <button onclick="reset()">清除</button>
            </td>
            <td></td>
        </tr>
    </table>

</fieldset>

<script>
    function reset() {
        $("#acc,#pw,#pw2,#email").val("")
    }

    function reg() {
        let form = {
            acc: $("#acc").val(),
            pw: $("#pw").val(),
            pw2: $("#pw2").val(),
            email: $("#email").val(),
        }; //{}為物件寫法，內容用逗號隔開
        // if (form.acc == '' || form.pw == '' || form.pw2 == '' || form.email == '') {
        if (Object.values(form).indexOf('')>=0) {
            alert("不可空白");
        } else {
            if (form.pw != form.pw2) {
                alert("密碼錯誤");
            } else {
                $.post("api/chk_acc.php", {
                    acc: form.acc
                }, (chk) => {
                    if (parseInt(chk)==1){
                        alert("帳號重複");
                    } else {
                        delete form.pw2; //資料表沒有pw2 所以要先刪除才不會出錯
                        $.post("api/reg.php",form, (res) => {
                          location.reload();
                        });
                    }
                });

            }

        }
    }
</script>
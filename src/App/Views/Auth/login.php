<?php 
if (!empty($_SESSION['authMessage'])) {
    echo '<script>toastr.info("'. Flash::getMessage("authMessage") .'");</script>';
}

?>
<div class="container">
    <h4 class="center">Авторизация</h4>
    <div class="row">
        <div class="col s4"></div>
        <form id="formLogin" method="post" action="" class="col s4">
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Введите Email" type="email" class="validate" value="" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-field col s12">
                    <input placeholder="Введите пароль" type="password" class="validate" value="" name="password" required>
                    <label for="password">Пароль</label>
                </div>
                <label style="padding: 0 0.75rem">
                    <input type="checkbox" id="save" name="save"/>
                    <span>Запомнить меня</span>
                </label>
                <div class="input-field col s12">
                    <span>Нет аккаунта? <a href="/registration">Зарегистрироваться</a></span>
                </div>
                <button class="btn waves-effect waves-light" type="submit">
                    Войти
                </button>
            </div>
        </form>
        <div class="col s4"></div>
    </div>
</div>
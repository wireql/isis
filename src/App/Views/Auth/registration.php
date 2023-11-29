<?php 
if (!empty($_SESSION['authMessage'])) {
    echo '<script>toastr.info("'. Flash::getMessage("authMessage") .'");</script>';
}

?>
<div class="container">
    <h4 class="center">Регистрация</h4>
    <div class="row">
        <div class="col s4"></div>
        <form id="formRegistration" method="post" action="" class="col s4">
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Введите имя пользователя" type="text" class="validate" value="" max="12" min="1" name="username" required>
                    <label for="username">Имя пользователя</label>
                </div>
                <div class="input-field col s12">
                    <input placeholder="Введите Email" type="email" class="validate" value="" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-field col s12">
                    <input placeholder="Введите пароль" type="password" class="validate" value="" name="password" required>
                    <label for="password">Пароль</label>
                </div>
                <div class="input-field col s12">
                    <span>Есть аккаунт? <a href="/login">Войти</a></span>
                </div>
                <button class="btn waves-effect waves-light" type="submit">
                    Зарегистрироваться
                </button>
            </div>
        </form>
        <div class="col s4"></div>
    </div>
</div>
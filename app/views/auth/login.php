<?php

$title = 'Авторизация';
ob_start(); 
?>

<h1 class="mb-4"><?= $title ?></h1>
<div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <form method="POST" action="/<?= APP_BASE_PATH ?>/auth/authenticate">
                    <div class="mb-3">
                        <label for="email" class="form-label">Эл. почта</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Запомнить меня</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>
                <div class="mt-3 text-center">
       <a href="#">Забыли пароль?</a>
    </div>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); 
include 'app/views/layout/layout_user.php';
?>
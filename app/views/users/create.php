<?php

$title = 'Добавить пользователя';
ob_start(); 
?>
<h1><?= $title ?></h1>

<form method="POST" action="/<?= APP_BASE_PATH ?>/users/store">
  <div class="mb-3">
    <label for="surname" class="form-label">Фамилия</label>
    <input type="text" class="form-control" id="surname" name="surname" required>
  </div>
  <div class="mb-3">
    <label for="name" class="form-label">Имя</label>
    <input type="text" class="form-control" id="name" name="name" required>
  </div>
  <div class="mb-3">
    <label for="patronymic" class="form-label">Отчество</label>
    <input type="text" class="form-control" id="patronymic" name="patronymic" required>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Эл.почта</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Пароль</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <div class="mb-3">
    <label for="confirm_password" class="form-label">Повторите пароль</label>
    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
  </div>
  <button type="submit" class="btn btn-primary">Добавить</button>
</form>



<?php $content = ob_get_clean(); 

include 'app/views/layout/layout.php';
?>
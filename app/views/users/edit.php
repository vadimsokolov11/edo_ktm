<?php

$title = 'Редактировать пользователя';
ob_start(); 
?>
<h1><?= $title ?></h1>

<form method="POST" action="/<?= APP_BASE_PATH ?>/users/update/<?php echo $user['id']; ?>">
  <div class="mb-3">
    <label for="surname" class="form-label">Фамилия</label>
    <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $user['surname']; ?>" required>
  </div>
  <div class="mb-3">
    <label for="name" class="form-label">Имя</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
  </div>
  <div class="mb-3">
    <label for="patronymic" class="form-label">Отчество</label>
    <input type="text" class="form-control" id="patronymic" name="patronymic" value="<?php echo $user['patronymic']; ?>" required>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
  </div>
  <div class="mb-3">
    <label for="role" class="form-label">Role</label>
    <select class="form-control" id="role" name="role">
    <?php foreach ($roles as $role): ?>
      <option value="<?php echo $role['id']; ?>" <?php echo $user['role'] == $role['id'] ? 'selected' : ''; ?>><?php echo $role['role_name']; ?></option>
    <?php endforeach; ?>
  </select>

  </div>
  <button type="submit" class="btn btn-primary">Сохранить</button>
</form>




<?php $content = ob_get_clean(); 

include 'app/views/layout/layout.php';
?>
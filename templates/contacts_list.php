<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список контактов</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#phone').mask('+7 (000) 000-00-00');
        });
    </script>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Список контактов</h1>

    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Имя:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="phone">Номер телефона:</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <button type="submit" class="btn btn-primary" name="add_contact">Добавить контакт</button>
    </form>

    <?php if (!empty($errors)) { ?>
        <div class="alert alert-danger mt-3">
            <?php foreach ($errors as $error) { ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php } ?>
        </div>
    <?php } ?>

    <table class="table table-bordered table-striped mt-4">
        <thead>
        <tr>
            <?php
            $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';
            ?>
            <th>
                <a href="?sort=name&order=<?= ($currentOrder == 'asc') ? 'desc' : 'asc' ?>">
                    Имя <?= ($currentOrder == 'asc') ? '▲' : '▼' ?>
                </a>
            </th>
            <th>Номер телефона</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contacts as $index => $contact) { ?>
            <tr>
                <td><?= htmlspecialchars($contact['name']) ?></td>
                <td><?= htmlspecialchars($contact['phone']) ?></td>
                <td>
                    <a href="?delete=<?= $index ?>" class="btn btn-danger btn-sm">Удалить</a>
                </td>
            </tr>
        <?php } ?>
        <?php if (empty($contacts)) { ?>
            <tr>
                <td colspan="3" class="text-center">Контактов нет</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

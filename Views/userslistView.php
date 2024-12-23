<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users List</title>
</head>
<body>
    <h1>Users List</h1>
    <?php if (!empty($users)): ?>
        <table border="1">
            <tr><th>ID</th><th>Username</th><th>Email</th><th>Actions</th></tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <a href="?page=editUser&id=<?= $user['id'] ?>">Edit</a> |
                        <a href="?page=deleteUser&id=<?= $user['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</body>
</html>

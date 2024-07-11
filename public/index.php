<?php
require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../config/config.php';

$database = new App\Database($config['db']);
$smsRepo = new App\SMSRepository($database->getConnection());
$sms = new App\SMS($config['ovh']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient = $_POST['recipient'] ?? '';
    $message = $_POST['message'] ?? '';

    try {
        if ($sms->send($recipient, $message)) {
            $smsRepo->save($recipient, $message);
            $success = "SMS sent successfully!";
        }
    } catch (\Exception $e) {
        $error = "Failed to send SMS: " . $e->getMessage();
    }
}

$messages = $smsRepo->getAll();

// ... rest of the file remains the same

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS Sender</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>SMS Sender</h1>

        <?php if (isset($success)) : ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <?php if (isset($error)) : ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" class="mb-4">
            <div class="mb-3">
                <label for="recipient" class="form-label">Recipient</label>
                <input type="text" class="form-control" id="recipient" name="recipient" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send SMS</button>
        </form>

        <h2>Sent Messages</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Recipient</th>
                    <th>Message</th>
                    <th>Sent At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message) : ?>
                    <tr>
                        <td><?= htmlspecialchars($message['recipient']) ?></td>
                        <td><?= htmlspecialchars($message['message']) ?></td>
                        <td><?= $message['sent_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
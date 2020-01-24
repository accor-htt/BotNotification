<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'jiraServer' => getenv('JIRA_SERVER'),
    'jiraLogin'  => getenv('JIRA_LOGIN'),
    'jiraPass'  => getenv('JIRA_API_KEY'),
    'rocketServer' => getenv('ROCKET_CHAT_SERVER'),
    'rocketLogin'  => getenv('ROCKET_BOT_NAME'),
    'rocketPass'  => getenv('ROCKET_BOT_PASS'),
];

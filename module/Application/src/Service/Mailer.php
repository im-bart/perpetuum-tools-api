<?php

namespace Application\Service;

use Application\Entity\Token\EmailConfirmation as EmailConfirmationToken;
use Application\Entity\Token\PasswordReset as PasswordResetToken;

class Mailer
{
    private $sparkPost;

    public function __construct($sparkPost)
    {
        $this->sparkPost = $sparkPost;
    }

    public function sendActivationMail(EmailConfirmationToken $token)
    {
        return $this->sparkPost->transmissions->post([
            'content' => [
                'from' => [
                    'name' => 'Open Perpetuum Team',
                    'email' => 'no-reply@mail.openperpetuum.com',
                ],
                'subject' => 'Activate your Open Perpetuum account',
                'html' => '<html><body><p>Hi there!</p><p>You have recently registered an account to Open Perpetuum at this email address.</p><p>Please <a href="http://register.openperpetuum.com/verify/{{token}}">click here</a> to verify your email address, or copy and paste the following link in your browser:</p><p>http://register.openperpetuum.com/verify/{{token}}</p><p>Welcome to Perpetuum, Agent!</p></body></html>',
                'text' => 'Hi there! You have recently registered an account to Open Perpetuum at this email address. To verify your email address, copy and paste the following link in your browser: http://register.openperpetuum.com/verify/{{token}}. Welcome to Perpetuum, Agent!',
            ],
            'substitution_data' => [
                'token' => $token->getHash(),
            ],
            'recipients' => [
                [
                    'address' => [
                        'email' => $token->getAccount()->getEmail(),
                    ],
                ],
            ],
            'options' => [
                'open_tracking' => false,
            ],
        ]);
    }

    public function sendPasswordResetMail(PasswordResetToken $token)
    {
        return $this->sparkPost->transmissions->post([
            'content' => [
                'from' => [
                    'name' => 'Open Perpetuum Team',
                    'email' => 'no-reply@mail.openperpetuum.com',
                ],
                'subject' => 'Reset your password',
                'html' => '<html><body><p>Hi there!</p><p>You have recently requested to have your password reset for your Open Perpetuum account.</p><p>Please <a href="http://register.openperpetuum.com/reset-password/{{token}}">click here</a> to verify your email address, or copy and paste the following link in your browser:</p><p>http://register.openperpetuum.com/reset-password/{{token}}</p><p>This link is valid for one hour.</p></body></html>',
                'text' => 'Hi there! You have recently requested to have your password reset for your Open Perpetuum account. To verify your email address, copy and paste the following link in your browser: http://register.openperpetuum.com/reset-password/{{token}}. This link is valid for one hour.',
            ],
            'substitution_data' => [
                'token' => $token->getHash(),
            ],
            'recipients' => [
                [
                    'address' => [
                        'email' => $token->getAccount()->getEmail(),
                    ],
                ],
            ],
            'options' => [
                'open_tracking' => false,
            ],
        ]);
    }
}

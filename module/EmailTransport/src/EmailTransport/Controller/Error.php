<?php

namespace EmailTransport\Controller;

class Error
{
    const EMAIL_SENT                = 0;
    const DATABASE_CONNECT_FAIL     = 1;
    const DATABASE_READ_FAIL        = 2;
    const DATABASE_WRITE_FAIL       = 3;
    const SERVER_SMTP_NO_RESPONSE   = 4;
    const ADDRESS_SENDER_EMPTY      = 5;
    const ADDRESS_SENDER_INVALID    = 6;
    const ADDRESS_RECIPIENT_EMPTY   = 7;
    const ADDRESS_RECIPIENT_INVALID = 8;
    const ATTACHMENT_NOT_FOUND      = 9;
    const ATTACHMENT_READ_FAIL      = 10;
    const ATTACHMENT_EMPTY          = 11;
    const FILETYPE_INVALID          = 12;
    const STATIC_SEND_NO_DATA       = 13;
    const STATIC_MAIL_NO_DATA       = 14;
    const MESSAGE_SUBJECT_EMPTY     = 15;
    const MESSAGE_BODY_EMPTY        = 16;
    const MESSAGE_BODY_HTML_EMPTY   = 17;
    const MESSAGE_BODY_TEXT_EMPTY   = 18;
    const IP_BLACKLISTED            = 19;
    const SERVICE_INVALID           = 20;

    private static $description = [
        self::EMAIL_SENT                => 'Email Sent',
        self::DATABASE_CONNECT_FAIL     => 'Could not connect to MySQL database',
        self::DATABASE_READ_FAIL        => 'Database read operation failed',
        self::DATABASE_WRITE_FAIL       => 'Database write operation failed',
        self::SERVER_SMTP_NO_RESPONSE   => 'No response from SMTP server',
        self::ADDRESS_SENDER_EMPTY      => 'E-mail address for sender is not set',
        self::ADDRESS_SENDER_INVALID    => 'E-mail address for sender is invalid',
        self::ADDRESS_RECIPIENT_EMPTY   => 'E-mail address for recipient is empty',
        self::ADDRESS_RECIPIENT_INVALID => 'E-mail address for recipient is invalid',
        self::ATTACHMENT_NOT_FOUND      => 'Attachment file not found at path specified',
        self::ATTACHMENT_READ_FAIL      => 'Read access not permitted on specified file',
        self::ATTACHMENT_EMPTY          => 'Empty file specified for attachment',
        self::FILETYPE_INVALID          => 'Reference filetype not allowed',
        self::STATIC_SEND_NO_DATA       => 'Insufficient array data passed to EmailTransportStatic::send()',
        self::STATIC_MAIL_NO_DATA       => 'Insufficient or missing data passed to EmailTransportStatic::mail()',
        self::MESSAGE_SUBJECT_EMPTY     => 'Message subject is empty',
        self::MESSAGE_BODY_EMPTY        => 'Message body content is empty',
        self::MESSAGE_BODY_HTML_EMPTY   => 'Message body HTML content is empty',
        self::MESSAGE_BODY_TEXT_EMPTY   => 'Message body TEXT content is empty',
        self::IP_BLACKLISTED            => 'Blacklisted remote IP address',
        self::SERVICE_INVALID           => 'Service ',
    ];

    public static function getDescription($code)
    {
        return static::$description[$code];
    }
}

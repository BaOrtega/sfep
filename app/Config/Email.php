<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    /**
     * Correo remitente - Puede ser cualquier correo
     * Los usuarios verán esto como "De: Sistema de Facturación <sistema@facturacion.com>"
     */
    public string $fromEmail  = 'sistema@facturacion.com';
    public string $fromName   = 'Sistema de Facturación';
    public string $recipients = '';

    /**
     * The "user agent"
     */
    public string $userAgent = 'CodeIgniter';

    /**
     * Protocolo SMTP para Mailtrap
     */
    public string $protocol = 'smtp';

    /**
     * The server path to Sendmail (no se usa con SMTP)
     */
    public string $mailPath = '/usr/sbin/sendmail';

    /**
     * CONFIGURACIÓN MAILTRAP CON TUS DATOS
     */
    public string $SMTPHost = 'sandbox.smtp.mailtrap.io';
    public string $SMTPUser = '19721b6f27fec8';  // Tu usuario
    public string $SMTPPass = 'e129';            // Tu contraseña
    public int $SMTPPort = 587;                   // Puerto recomendado
    public int $SMTPTimeout = 30;                 // Aumentado para pruebas

    /**
     * Enable persistent SMTP connections
     */
    public bool $SMTPKeepAlive = false;

    /**
     * SMTP Encryption - TLS para puerto 587
     */
    public string $SMTPCrypto = 'tls';

    /**
     * Enable word-wrap
     */
    public bool $wordWrap = true;

    /**
     * Character count to wrap at
     */
    public int $wrapChars = 76;

    /**
     * Type of mail - HTML para correos con formato
     */
    public string $mailType = 'html';

    /**
     * Character set (utf-8, iso-8859-1, etc.)
     */
    public string $charset = 'UTF-8';

    /**
     * Whether to validate the email address
     * En desarrollo puedes poner false
     */
    public bool $validate = false;

    /**
     * Email Priority. 1 = highest. 5 = lowest. 3 = normal
     */
    public int $priority = 1; // Alta prioridad para recuperación de contraseña

    /**
     * Newline character. (Use "\r\n" to comply with RFC 822)
     */
    public string $CRLF = "\r\n";

    /**
     * Newline character. (Use "\r\n" to comply with RFC 822)
     */
    public string $newline = "\r\n";

    /**
     * Enable BCC Batch Mode.
     */
    public bool $BCCBatchMode = false;

    /**
     * Number of emails in each BCC batch
     */
    public int $BCCBatchSize = 200;

    /**
     * Enable notify message from server
     */
    public bool $DSN = false;

    /**
     * SMTP Debug level
     * 0 = off (producción)
     * 1 = client messages
     * 2 = client and server messages (desarrollo)
     */
    public int $SMTPDebug = 2; // Activar para ver errores detallados

    /**
     * Whether to throw exceptions on errors
     */
    public bool $throwExceptions = false; // Mejor false para controlar errores
}
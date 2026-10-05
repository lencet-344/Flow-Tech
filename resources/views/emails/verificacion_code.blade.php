<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Código de verificación</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #F4F7FF; padding: 40px 0; text-align: center;">
    <div style="max-w-md: 500px; margin: 0 auto; background: #ffffff; padding: 40px; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <h2 style="color: #040116;">Hola {{ $name }},</h2>
        <p style="color: #666; font-size: 16px;">Has solicitado restablecer tu contraseña. Usa el siguiente código de 6 dígitos para continuar. Este código expirará en 10 minutos.</p>
        <div style="margin: 30px 0; font-size: 36px; font-weight: bold; letter-spacing: 5px; color: #1F51FF; background: #EEF2FF; padding: 20px; border-radius: 12px; display: inline-block;">
            {{ $code }}
        </div>
        <p style="color: #999; font-size: 14px;">Si no solicitaste restablecer tu contraseña, ignora este correo.</p>
    </div>
</body>
</html>
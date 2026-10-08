<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código de Verificación - SINGKI</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed; background-color: #f4f4f5; padding: 40px 0;">
        <tr>
            <td align="center">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);">
                    
                    <!-- Header con Logo y Título -->
                    <tr>
                        <td style="background-color: #0f172a; padding: 30px 40px; text-align: left;">
                            <img src="{{ $message->embed(public_path('images/LogoAzul.png')) }}" alt="SINGKI" height="60" style="margin-bottom: 20px; display: block; border: none; outline: none;">
                            <h1 style="color: #ffffff; font-size: 24px; margin: 0; font-weight: 600;">Código de acceso único</h1>
                        </td>
                    </tr>

                    <!-- Cuerpo del Mensaje -->
                    <tr>
                        <td style="padding: 40px; color: #334155;">
                            <p style="font-size: 16px; margin-top: 0; margin-bottom: 20px; font-weight: 600;">
                                Hola, {{ $name ?? 'Usuario' }}:
                            </p>
                            <p style="font-size: 15px; line-height: 1.6; color: #475569; margin-bottom: 30px;">
                                Para completar tu acción o acceso en tu cuenta de SINGKI, introduce el siguiente código de verificación (OTP):
                            </p>

                            <!-- Caja del Código -->
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                               <tr>
                                   <td align="left" style="background-color: #f8fafc; border-left: 4px solid #2563eb; padding: 20px; border-radius: 4px;">
                                       <span style="font-size: 13px; color: #64748b; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 5px;">Código de verificación:</span>
                                       <span style="font-size: 32px; font-weight: 800; color: #0f172a; letter-spacing: 4px;">{{ $code }}</span>
                                   </td>
                               </tr>
                            </table>

                            <p style="font-size: 14px; color: #64748b; margin-top: 30px; margin-bottom: 0;">
                                No compartas este código con nadie ni reenvíes este correo electrónico. Este código expirará en pocos minutos.
                            </p>
                        </td>
                    </tr>

                    <!-- Pie de página -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 30px 40px; border-top: 1px solid #e2e8f0; color: #94a3b8; font-size: 12px; line-height: 1.5;">
                            <p style="margin: 0 0 10px 0;">
                                Este es un mensaje de correo electrónico operativo generado automáticamente desde la plataforma SINGKI.
                            </p>
                            <p style="margin: 0 0 10px 0;">
                                No responda a este mensaje de correo electrónico. Las respuestas a esta dirección no se supervisan ni se contestan.
                            </p>
                            <p style="margin: 0;">
                                &copy; {{ date('Y') }} SINGKI · Conectamos negocios con oportunidades. Todos los derechos reservados.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
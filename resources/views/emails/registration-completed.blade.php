<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Vivtron EVCS</title>
</head>
<body style="margin:0;background:#f4f7fb;font-family:Arial,Helvetica,sans-serif;color:#122033;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f4f7fb;padding:28px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:620px;background:#ffffff;border:1px solid #e6eaf0;border-radius:8px;overflow:hidden;">
                    <tr>
                        <td style="padding:28px 30px;background:#0b3b73;color:#ffffff;">
                            <h1 style="margin:0;font-size:24px;line-height:1.3;">Welcome to Vivtron EVCS</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;">
                            <p style="font-size:16px;line-height:1.6;margin:0 0 16px;">Hello {{ $user->name }},</p>
                            <p style="font-size:16px;line-height:1.6;margin:0 0 16px;">
                                Thanks for registering with Vivtron EVCS. Your account has been created successfully.
                            </p>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:22px 0;border-collapse:collapse;">
                                <tr>
                                    <td style="padding:10px 0;color:#667085;width:130px;">Email</td>
                                    <td style="padding:10px 0;font-weight:700;">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0;color:#667085;">Referral Code</td>
                                    <td style="padding:10px 0;font-weight:700;">{{ $user->referral_code }}</td>
                                </tr>
                            </table>
                            <p style="margin:24px 0;">
                                <a href="{{ url('/login') }}" style="display:inline-block;background:#36b34a;color:#ffffff;text-decoration:none;padding:12px 22px;border-radius:6px;font-weight:700;">
                                    Login to Dashboard
                                </a>
                            </p>
                            <p style="font-size:14px;line-height:1.6;color:#667085;margin:22px 0 0;">
                                If you did not create this account, please ignore this email.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

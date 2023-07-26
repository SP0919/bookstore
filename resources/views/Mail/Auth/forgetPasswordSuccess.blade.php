<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Updated Successfully</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body style="font-family: 'Inter', Arial; color: #33334F; background-color: #fff; margin: 0;">

    <div class="logo" style="text-align: center; padding: 40px 0px ;">
        <img src="{{ $message->embed('assets/defaultImage/emailtemplate/krios-logo.svg') }}" alt="krios"
            style="width: 120px;" />
    </div>
    <div
        style="background-color: #F7F7FF; border-radius: 8px; box-shadow: 1px 1px 6px 1px #cacaca69;
     width: 600px;
     border-top: 8px solid #7875FC;
     margin: 0px auto;
     padding: 32px;
     max-width: 100%;
     box-sizing: border-box; font-family: 'Inter', Arial;">
        <div style="padding-top: 30px; padding-bottom: 20px;"><strong
                style="font-weight: 500; font-size:16px; font-family: 'Inter', Arial; ">Hey @if (isset($user) && !empty($user))
                    {{ $user->name }} 👋
                @else
                    👋
                @endif </strong>
        </div>
        <div
            style="font-size: 15px;
         color: #111115; margin-bottom: 24px; font-family: 'Inter', Arial; line-height: 22px;">
            <p style="margin-top: 10px; margin-bottom:5px"> Password Updated Successfully. </p>
            <br><br>
            <p style="margin-top: 10px; margin-bottom:5px"> Thank you,</p>
            <p style="margin-top: 0px; margin-bottom:5px"> The Krios team.</p>
        </div>
    </div>
    <div
        style='width: 600px; margin: 0px auto; padding: 40px 20px; max-width: 100%; box-sizing: border-box; background: #fff; text-align: center; margin-top: 10px;'>
        <div style="flex: auto;">
            <a href="#"><img src="{{ $message->embed('assets/defaultImage/emailtemplate/twitter-icon.svg') }}"
                    alt="twitter" width="25px"></a>
            <a href="#" style="margin: 0 20px;"><img
                    src="{{ $message->embed('assets/defaultImage/emailtemplate/facebook-icon.svg') }}" alt="facebook"
                    width="25px"></a>
            <a href="#"><img src="{{ $message->embed('assets/defaultImage/emailtemplate/instagram-icon.svg') }}"
                    alt="instagram" width="25px"></a>
        </div>
        <div
            style="font-weight: 500; font-size: 12px; color: #666666; padding-bottom: 20px;font-family: 'Inter', Arial;">
            <p style="color:#6D6D6D; font-size: 13px;">&copy; 2023 Krios. All rights reserved</p>
        </div>
    </div>

</body>

</html>

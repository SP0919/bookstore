<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Krios</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
</head>

<body style="font-family: 'Inter', Arial; color: #33334f; background-color: #fff; margin: 0">
    <div class="logo" style="text-align: center; padding: 40px 0px">
        <img src="{{ $message->embed('assets/defaultImage/emailtemplate/krios-logo.svg') }}" alt="krios"
            style="width: 120px" />
    </div>
    <div
        style="
        background-color: #f7f7ff;
        border-radius: 8px;
        box-shadow: 1px 1px 6px 1px #cacaca69;
        width: 600px;
        border-top: 8px solid #7875fc;
        margin: 0px auto;
        padding: 32px;
        max-width: 100%;
        box-sizing: border-box;
        font-family: 'Inter', Arial;
      ">
        <div
            style="
          font-size: 15px;
          color: #111115;
          margin-bottom: 24px;
          font-family: 'Inter', Arial;
          line-height: 22px;
        ">
            <div style="padding-bottom: 15px">
                <p style="font-weight: 400; font-size: 15px; font-family: 'Inter', Arial">
                    Dear @if (isset($allOrderDetails->user))
                        {{ $allOrderDetails->user->name }}
                    @endif,
                </p>
                <p style="font-weight: 400; font-size: 15px; font-family: 'Inter', Arial">
                    Your Order number -{{ $allOrderDetails->unique_order_id }} has been Cancelled.
                </p>
                <a href="https://198.211.99.129/laundry/public/api/get-order/{{ $allOrderDetails->id }}"
                    style="
              background-color: #7875fc;
              text-decoration: none;
              padding: 10px 20px;
              border-radius: 50px;
              color: #fff;
              display: inline-block;
              margin-top: 10px;
            ">Track
                    Order</a>
            </div>
            <div style="padding: 10px 0px; border-top: 1px dashed #dfdfdf; margin-top: 5px">
                <h2 style="font-weight: 500; font-size: 16px; font-family: 'Inter', Arial">
                    Delivery Address
                </h2>
                <p style="font-weight: 400; font-size: 15px; font-family: 'Inter', Arial">
                    #{{ $allOrderDetails->address_line_1 }}. {{ $allOrderDetails->address_line_2 }},
                    {{ $allOrderDetails->zipcode }}
                </p>
            </div>

            <div style="padding: 10px 0px; border-top: 1px dashed #dfdfdf; margin-top: 5px">
                <h2 style="font-weight: 500; font-size: 16px; font-family: 'Inter', Arial">
                    Service Booked
                </h2>
                <p style="font-weight: 400; font-size: 15px; font-family: 'Inter', Arial">
                    {{ $allOrderDetails->orderQuantity[0]->shopsubcategory[0]->subcategory->shopcategory->title }}
                </p>
            </div>

            <div style="padding: 10px 0px; border-top: 1px dashed #dfdfdf; margin-top: 5px">
                <h2 style="font-weight: 500; font-size: 16px; font-family: 'Inter', Arial">
                    Order Details
                </h2>
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr style="border-bottom: 1px solid #dfdfdf; text-align: left; padding-bottom: 10px">
                        <th
                            style="
                  font-size: 14px;
                  font-weight: 500;
                  line-height: 24px;
                  width: 43%;
                  font-family: 'Inter', Arial;
                  border-bottom: 1px solid #ccc;
                  padding-bottom: 10px;
                ">
                            Product Name
                        </th>
                        <th
                            style="
                  font-size: 14px;
                  font-weight: 500;
                  line-height: 24px;
                  width: 19%;
                  font-family: 'Inter', Arial;
                  border-bottom: 1px solid #ccc;
                  padding-bottom: 10px;
                ">
                            RATE
                        </th>
                        <th
                            style="
                  font-size: 14px;
                  font-weight: 500;
                  line-height: 24px;
                  width: 19%;
                  font-family: 'Inter', Arial;
                  border-bottom: 1px solid #ccc;
                  padding-bottom: 10px;
                  padding-right: 10px;
                ">
                            QTY
                        </th>
                        <th
                            style="
                  font-size: 14px;
                  font-weight: 500;
                  line-height: 24px;
                  width: 19%;
                  font-family: 'Inter', Arial;
                  border-bottom: 1px solid #ccc;
                  padding-bottom: 10px;
                ">
                            SUBTOTAL
                        </th>
                    </tr>
                    @foreach ($allOrderDetails->orderQuantity as $quantity)
                        <tr>
                            <td>{{ $quantity->shopsubcategory[0]->subcategory->title }}</td>
                            <td>$ {{ $quantity->item_price }}</td>
                            <td>{{ $quantity->quantity }}</td>
                            <td>$ {{ $quantity->final_price }}</td>
                        </tr>
                    @endforeach
                </table>
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td width="80%" align="left"
                            style="
                  font-family: 'Inter', Arial;
                  font-size: 14px;
                  font-weight: 500;
                  line-height: 24px;
                  padding: 10px 10px 0px 0px;
                  border-top: 1px solid #ccc;
                ">
                            PICKUP CHARGES
                        </td>
                        <td width="20%" align="left"
                            style="
                  font-family: 'Inter', Arial;
                  font-size: 14px;
                  font-weight: 600;
                  line-height: 24px;
                  padding: 10px 10px 0px 0px;
                  border-top: 1px solid #ccc;
                ">
                            $ {{ $allOrderDetails->orderTransactions->pickupcharges }}
                        </td>
                    </tr>
                    <tr>
                        <td width="80%" align="left"
                            style="
                  font-family: 'Inter', Arial;
                  font-size: 14px;
                  font-weight: 500;
                  line-height: 24px;
                  padding: 10px 10px 10px 0px;
                ">
                            SERVICE TAX
                        </td>
                        <td width="20%" align="left"
                            style="
                  font-family: 'Inter', Arial;
                  font-size: 14px;
                  font-weight: 600;
                  line-height: 24px;
                  padding: 10px 10px 10px 0px;
                ">
                            $ {{ $allOrderDetails->orderTransactions->servicecharges }}
                        </td>
                    </tr>
                    <tr>
                        <td width="75%" align="left"
                            style="
                  font-family: 'Inter', Arial;
                  font-size: 14px;
                  font-weight: 500;
                  line-height: 24px;
                  padding: 10px 10px 10px 0px;
                  border-top: 1px solid #ccc;
                ">
                            GRAND TOTAL
                        </td>
                        <td width="25%" align="left"
                            style="
                  font-family: 'Inter', Arial;
                  font-size: 15px;
                  font-weight: 600;
                  line-height: 24px;
                  padding: 10px 10px 10px 0px;
                  border-top: 1px solid #ccc;
                ">
                            $ {{ $allOrderDetails->orderTransactions->finalprice }}
                        </td>
                    </tr>
                </table>
            </div>

            <div style="padding: 10px 0px; border-top: 1px dashed #dfdfdf; margin-top: 5px">
                <p style="font-weight: 400; font-size: 14px; font-family: 'Inter', Arial">
                    Anything Wrong with the order?. For questions, you can reach out to us at
                    <a href="mailto:support@krios.inv" style="text-decoration: none; color: #7875fc">
                        support@krios.inv</a>
                </p>
                <p style="font-weight: 400; font-size: 15px; font-family: 'Inter', Arial">
                    Best Regards,<br />
                    Team Krios
                </p>
            </div>
        </div>
    </div>
    <div
        style="
        width: 600px;
        margin: 0px auto;
        padding: 40px 20px;
        max-width: 100%;
        box-sizing: border-box;
        background: #fff;
        text-align: center;
        margin-top: 10px;
      ">
        <div style="flex: auto">
            <a href=""><img src="{{ $message->embed('assets/defaultImage/emailtemplate/twitter-icon.svg') }}"
                    alt="twitter" width="25px" /></a>
            <a href="" style="margin: 0 20px"><img
                    src="{{ $message->embed('assets/defaultImage/emailtemplate/facebook-icon.svg') }}" alt=""
                    width="25px" /></a>
            <a href=""><img src="{{ $message->embed('assets/defaultImage/emailtemplate/instagram-icon.svg') }}"
                    alt="" width="25px" /></a>
        </div>
        <div
            style="
          font-weight: 500;
          font-size: 12px;
          color: #666666;
          padding-bottom: 20px;
          font-family: 'Inter', Arial;
        ">
            <p style="color: #6d6d6d; font-size: 13px">&copy; 2023 Krios. All rights reserved</p>
        </div>
    </div>
</body>

</html>

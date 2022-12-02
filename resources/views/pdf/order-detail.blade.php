<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        @page {
            size: 6in 4in;
        }

        .logo-img {
            height: 130px;
            margin-left: 30%;
            margin-top: -5%;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            height: auto;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 15px;
            line-height: 23px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .products {
            font-size: 14px;
            line-height: 10px;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 4px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        /*.invoice-box table tr.top table td {*/
        /*    padding-bottom: 30px;*/
        /*}*/

        .invoice-box table tr.top table td.title {
            font-size: 30px;
            line-height: 30px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 35px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 18px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

    </style>
</head>

<body>

    <!--<img class="logo-img" src='https://khanafresh.amtkpl.com/frontend/assets/img/Khana-fresh-Logo.png'/>-->
    <div class="invoice-box"
        style="background-image: url('frontend/assets/img/Khana-fresh-Logo.png');background-repeat:no-repeat; background-size:250px 250px; background-position: 140px;">
        <table cellpadding="0" cellspacing="0">
            <tr class="heading">
                <td>User</td>

                <td>Value</td>
            </tr>

            <tr class="details">
                <td>Name</td>

                <td>{{ @$user_plan['user']['first_name'] }}</td>
            </tr>
            <tr class="details">
                <td>Address</td>

                <td>{{ @$user_plan['user']['address'] }}</td>
            </tr>
            <tr class="details">
                <td>Zip Code</td>

                <td>{{ @$user_plan['user']['zip'] }}</td>
            </tr>
            <tr class="details">
                <td>Phone No</td>

                <td>{{ @$user_plan['user']['phone'] }}</td>
            </tr>
            <tr class="details">
                <td>Order No</td>

                <td>{{ @$user_plan['id'] }}</td>
            </tr>

            {{-- <tr class="details">
                <td>Name</td>

                <td>{{ @$user_plan['user']['first_name'] }}</td>
            </tr>
            <tr class="details">
                <td>Order No</td>

                <td>{{ @$user_plan['id'] }}</td>
            </tr> --}}

            <tr class="heading">
                <td>Product</td>

                <td>Quantity</td>
            </tr>
            @foreach ($user_plan['meals'] as $item)
                <tr class="products">
                    <td>{{ $item['name'] }}</td>

                    <td>{{ $item['quantity'] }}</td>
                </tr>
            @endforeach
            <tr class="total">
                <td></td>
                <td>Total: {{ $user_plan['price'] }}</td>
            </tr>

            {{-- <tr class="heading">
                <td>Item</td>

                <td>Price</td>
            </tr>


                <td>Total: $385.00</td>
            </tr> --}}
        </table>
    </div>
</body>

</html>

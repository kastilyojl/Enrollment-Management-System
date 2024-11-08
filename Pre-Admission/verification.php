<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" href="../Style/Admission_Form.css">

    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .next {
            height: 30px;
            width: 100px;
            border-radius: 50px;
            border: none;
            background-color: var(--main-color);
            border: 1px solid #c2c2c2;
            color: #ffff;
            cursor: pointer;
        }
        .form {
            width: 60%;
            text-align: center;
            row-gap: 30px;
            text-transform: small;
        }
        .container {
            padding:0;
        }

    </style>

</head>
<body>

    <div class="container">
            <form class="form" action="../Database/transaction_status.php" method="post">
                <div class="input">
                    <label>Enter Student ID</label>
                    <input type="text" name="enterID">
                    <label id="a" style="display:none;">ID Didn't Exist!</label>
                </div>
                <div class="input">
                    <button class="next" type="submit" name="transaction">Enter</button>
                </div>
            </form>
        </div>

</body>
</html>
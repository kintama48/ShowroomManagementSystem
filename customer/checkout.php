<!-- checkout.php -->
<html lang="en">
<head>
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
<div class="invoice-box">
    <h2>Invoice</h2>
    <table class="styled-table">
        <tr class="heading">
            <thead>
                <td>Item</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Total</td>
            </thead>
        </tr>
        <tr><tbody>
            <?php
            session_start();
            $total = 0;

            foreach ($_SESSION['cart'] as $item) {
                if (empty($item['name']) && empty($item['price'])) {
                    continue;
                }

                if (!array_key_exists('name', $item)) {
                    $item['name'] = $item['make'] . " " . $item['model'];
                }
                echo "<tr>";
                echo "<td>" . $item['name'] . "</td>";
                echo "<td>" . $item['quantity'] . "</td>";
                echo "<td>" . $item['price'] . "$</td>";
                echo "<td>" . $item['quantity'] * $item['price'] . "$</td>";
                echo "</tr>";
                $total += $item['quantity'] * $item['price'];
            }
            ?>
            </tbody></tr>
        <tr class="total">
            <td></td>
            <td></td>
            <td>Total:</td>
            <td><?php echo $total; ?>$</td>
        </tr>
    </table>
    <a href='checkout_success.php'>
        <button style="font-weight: bold;border-radius: 50px; background-color: dodgerblue; color: black;"
                id="login-button">Proceed
        </button>
    </a>
</div>
</body>

<style>
    .styled-table {
        border-collapse: collapse;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        margin: 25px auto;
        background-color: white;
    }

    .styled-table thead tr {
        background-color: aquamarine;
        color: black;
        text-align: left;
    }

    .styled-table th,.styled-table td {
        padding: 12px 15px;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid rgb(78, 156, 131);
    }
</style>
</html>

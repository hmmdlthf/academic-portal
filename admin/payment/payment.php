<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/jwt/JwtProtected.php';
require_once $ROOT . '/app/jwt/JwtService.php';
require_once $ROOT . '/app/payment/PaymentService.php';

$jwtService = jwt_start(['admin_role']);

$payments = (new PaymentService())->getPayments();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Online Acedemy | Payment</title>

    <?php require $ROOT . '/admin/head/head.php' ?>

</head>

<body>
    <div class="main">
        <?php require $ROOT . '/admin/menu.php'; ?>

        <div class="body">
            <?php require $ROOT . '/admin/header.php'; ?>
            <div class="body__content">
                <?php if (count($payments) > 0) { ?>
                    <div class="filters">
                        <div class="form__group">
                            <div class="form__control">
                                <select name="student" id="student">
                                    <option value="">student1</option>
                                    <option value="">student2</option>
                                    <option value="">student3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="items">
                        <table>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>OrderId</th>
                                    <th>PaymentId</th>
                                    <th>Student</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($payments as $payment) { ?>
                                    <tr>
                                        <td><?php echo $payment->getId(); ?></td>
                                        <td><?php echo $payment->getCreatedDate(); ?></td>
                                        <td><?php echo $payment->getPaymentFee(); ?></td>
                                        <td><?php echo $payment->getStatusCode(); ?></td>
                                        <td><?php echo $payment->getOrderId(); ?></td>
                                        <td><?php echo $payment->getPaymentId(); ?></td>
                                        <td><?php echo $payment->getStudent()->getEmail(); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                <?php } else { ?>
                    no payments found in payments
                <?php } ?>
            </div>
        </div>
    </div>

    <?php require $ROOT . '/admin/js/scripts.php' ?>
</body>

</html>
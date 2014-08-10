<?php

require './Sqs.php';

$sqs = new Sqs();
$result = $sqs->sendMessageBatch($_POST['message'], $_POST['url']);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>SQS DEMO</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style>
html,body {
    font-family: "Hiragino Kaku Gothic ProN", Meiryo, sans-serif;
    width: 100%;
    padding: 0;
    margin: 0;
}
#wrapper{
    width: 900px;
    margin: auto;
}

</style>
</head>
<body>
    <div id="wrapper">
        <header>
            <h1>SQS Send Message Result</h1>
        </header>
        <div id="container">
            <article>
                <p>Result success</p>
                <table class="table">
                    <tr>
                        <td>Id</td><td>MessageId</td><td>MD5OfMessageBody</td>
                    </tr>
                    <?php
                    foreach ($result['Successful'] as $val) {
                        echo '<tr>';
                        echo '<td>'. $val['Id'] .'</td><td>'. $val['MessageId'] .'</td><td>'. $val['MD5OfMessageBody'] .'</td>';
                        echo '</tr>';
                    }
                    ?>
                </table>

                <br />

                <p>Result Error</p>
                <table class="table">
                    <tr>
                        <td>Id</td><td>SenderFault</td><td>Message</td>
                    </tr>
                    <?php
                    if(array_key_exists('Failed', $result)) {
                        foreach ($result['Failed'] as $val) {
                            echo '<tr>';
                            echo '<td>'. $val['Id'] .'</td><td>'. $val['SenderFault'] .'</td><td>'. $val['Message'] .'</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </table>
            </article>
        </div>
    </div>
</body>
</html>

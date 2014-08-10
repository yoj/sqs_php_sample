<?php

require './Sqs.php';

$sqs = new Sqs();
$result = $sqs->popMessage($_POST['message'], $_POST['url']);
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
            <h1>SQS Pop Message Result</h1>
        </header>
        <div id="container">
            <article>
                <p>Result success</p>
                <table class="table">
                    <tr>
                        <td>Id</td><td>MessageBody</td>
                    </tr>
                    <?php
                    foreach ($result as $key => $val) {
                        if($key === 'deleteResult') continue;
                        echo '<tr>';
                        echo '<td>'. $key .'</td><td>'. $val .'</td>';
                        echo '</tr>';
                    }
                    ?>
                </table>

                <br />

                <p>Delete Result</p>
                <table class="table">
                    <tr>
                        <td>Delete Message Count</td><td><?php echo count($result['deleteResult']['Successful']); ?></td>
                    </tr>
                </table>
            </article>
        </div>
    </div>
</body>
</html>

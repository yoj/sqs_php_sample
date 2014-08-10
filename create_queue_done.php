<?php

require './Sqs.php';

$sqs = new Sqs();
$result = $sqs->createQueue($_POST['name']);

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
            <h1>SQS Create Queue</h1>
        </header>
        <div id="container">
            <article>
                <p>Result</p>
                <table class="table">
                    <tr>
                        <td>key</td><td>result</td>
                    </tr>
                    <tr>
                        <td>QueueUrl</td><td><?php echo $result['QueueUrl']; ?></td>
                    </tr>
                </table>
            </article>
        </div>
    </div>
</body>
</html>

<?php
/*
SQS sample code
refarence : http://docs.aws.amazon.com/aws-sdk-php/latest/class-Aws.Sqs.SqsClient.html
*/
require '/Users/yoji/vendor/autoload.php';

use Aws\Sqs\SqsClient;

/*$client = SqsClient::factory(array(
    'profile' => 'default',
    'region'  => 'ap-northeast-1'
));*/

$client = SqsClient::factory([
    'key'    => 'AKIAJDYAMNZ23O3F523Q',
    'secret' => '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',
    'region' => 'ap-northeast-1'
]);


// Queueの確認
$checkExisit = $client->getQueueUrl([
    'QueueName' => 'sqs_test',
]);
var_dump($checkExisit);

// メッセージの送信
$result = $client->sendMessage(
    [
      'QueueUrl' => 'https://sqs.ap-northeast-1.amazonaws.com/245982467007/sqs_test',
      'MessageBody' => 'second send message',
      //'DelaySeconds' => integer,
      // 'MessageAttributes' => array(
      //     // Associative array of custom 'String' key names
      //     'String' => array(
      //         'StringValue' => 'string',
      //         'BinaryValue' => 'string',
      //         'StringListValues' => array('string', ... ),
      //         'BinaryListValues' => array('string', ... ),
      //         // DataType is required
      //         'DataType' => 'string',
      //     ),
      // ),
    ]
);


// 新しいQueueの作成
// object(Guzzle\Service\Resource\Model)#71 (2) { ["structure":protected]=> NULL ["data":protected]=> array(2) { ["QueueUrl"]=> string(59) "https://sqs.ap-northeast-1.amazonaws.com/245982467007/test2" ["ResponseMetadata"]=> array(1) { ["RequestId"]=> string(36) "ffa6df3d-917c-5abd-992b-9362764e3a4a" } } }
//$newqueue = $client->createQueue(['QueueName' => 'test2']);

var_dump($result);

<?php

require '/Users/yoji/vendor/autoload.php';
use Aws\Sqs\SqsClient;

class Sqs
{

    private $client;
    private $sqsURL = '';

    function __construct()
    {
        $this->client = SqsClient::factory(
            [
                'key'    => '',
                'secret' => '',
                'region' => 'ap-northeast-1'
            ]
        );
    }

    public function createQueue($name)
    {
        $result = $this->client->createQueue(['QueueName' => $name]);
        return $result;
    }

    public function sendMessage($mes)
    {
        $result = $this->client->sendMessage(
            [
                'QueueUrl'     => $this->sqsURL,
                'MessageBody'  => $mes,
                'DelaySeconds' => 0,   // seconds
            ]
        );

        return $result;
    }

    public function sendMessageBatch($messages, $url = null)
    {
        if(!empty($url)){
            $this->sqsURL = $url;
        }

        $entrieArray = [];
        foreach ($messages as $key => $mes) {
            $entrieArray[] = [
                'Id'           => (string) $key,
                'MessageBody'  => $mes,
                'DelaySeconds' => 0,
            ];
        }

        $result = $this->client->sendMessageBatch(
            [
                'QueueUrl' => $this->sqsURL,
                'Entries'  => $entrieArray
            ]
        );

        return $result;
    }

    public function getMessage()
    {
        // TODO なぜか同じメッセージが返却される謎
        $result = $this->client->receiveMessage(
            [
                'QueueUrl'              => $this->sqsURL, // 取得対象URL
                'MaxNumberOfMessages'   => 10,            // 取得件数 デフォルト1件 最大10件
                'VisibilityTimeout'     => 30,             // 排他制御 デフォルト30秒 0秒だと挙動がおかしい
            ]
        );

        return $result;
    }

    public function popMessage($url = null)
    {
        if(!empty($url)){
            $this->sqsURL = $url;
        }

        // ReceiptHandleはメッセージ取得のたびに変わるため、取得したタイミングで消す必要がある
        $res = $this->getMessage();

        $body    = [];
        $entrieArray = [];
        foreach ($res['Messages'] as $key => $message) {
            $body[]        = $message['Body'];
            $entrieArray[] = [
                'Id'            => (string) $key,
                'ReceiptHandle' => $message['ReceiptHandle'],
            ];
        }


        // メッセージを削除
        $deleteResult = $this->client->deleteMessageBatch(
            [
                'QueueUrl' => $this->sqsURL,
                'Entries'  => $entrieArray
            ]
        );

        $body['deleteResult'] = $deleteResult;

        return $body;
    }

}

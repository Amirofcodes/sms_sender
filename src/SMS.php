<?php

namespace App;

use \Ovh\Api;

class SMS
{
    private Api $ovh;

    public function __construct(array $config)
    {
        $this->ovh = new Api(
            $config['application_key'],
            $config['application_secret'],
            $config['endpoint'],
            $config['consumer_key']
        );
    }

    public function send(string $recipient, string $message): bool
    {
        try {
            $services = $this->ovh->get('/sms/');
            if (empty($services)) {
                throw new \Exception("No SMS services found");
            }
            $smsService = $services[0];

            $result = $this->ovh->post("/sms/{$smsService}/jobs", [
                'message' => $message,
                'receivers' => [$recipient],
                'senderForResponse' => true,
                'priority' => 'high',
                'noStopClause' => false,
            ]);

            error_log("SMS sent successfully: " . json_encode($result));
            return true;
        } catch (\Exception $e) {
            error_log("SMS sending failed: " . $e->getMessage());
            throw $e;
        }
    }
}

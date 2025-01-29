<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SoapClient;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mobile;
    protected $textMessage;


    public function __construct($mobile, $textMessage)
    {
        $this->mobile = $mobile;
        $this->textMessage = $textMessage;
    }


    public function handle(): void
    {
        $webServiceURL = "http://sms.parsgreen.ir/Api/SendSMS.asmx?WSDL";
        $webServiceSignature = "65764460-0D6E-4CE0-BCF5-D77EE5D3C79C";
        $webServiceNumber = "10004004040";

        mb_internal_encoding("utf-8");
        $textMessage = mb_convert_encoding($this->textMessage, "UTF-8");

        $parameters = [
          'signature' => $webServiceSignature,
          'from' => $webServiceNumber,
          'to' => [$this->mobile],
          'text' => $textMessage,
          'isFlash' => false,
          'udh' => "",
        ];
        try {
            $client = new SoapClient($webServiceURL);
            $response = (array)$client->SendGroupSmsSimple($parameters);
            \Log::info('SMS send successfully: ' . $response['SendGroupSmsSimpleResult']);
        }catch (\SoapFault $ex){
            \Log::error('SMS Send Error: ' . $ex->faultstring);
        }

    }
}

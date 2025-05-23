<?php

namespace Modules\Transaction\Services\SMS;

use Illuminate\Support\Facades\Http;


class SmsRmlConnect
{
    public function __construct()
    {
        $this->username              = 'alqalaaTr';
        $this->password              = "G3b_{6oO";
    }

    public function send($phone, $message)
    {   
        try {
            $data = [
                "username"      => $this->username,
                "password"      => $this->password,
                "type"          => 0,
                "dlr"           => 1,  //0: No delivery report required 1: delivery report required
                "destination"   => "965{$phone}", //"96594971095"
                "source"        => "Alqalaa",
                "message"       => $message,
            ];
            info($data);
            return $this->request($data);
        } catch (\Exception $e) {
            return ["Result" => "false"];
        }
    }
    public function request($data)
    {
        $response = Http::get('http://api.rmlconnect.net/bulksms/bulksms', $data);
        return $this->parse($response);
    }
    public function parse($result)
    {
        $result = str_replace(["\n", "\r", "\t"], '', $result);
        $result = trim(str_replace('"', "'", $result));
        $result = explode('|', $result);
        $r['status_code'] = $result[0];
        $r['mobile']      = $result[1];
        $r['message_id']  = $result[2];
        $r['Result']      = $r['status_code'] == '1701'; //1701 =>Success

        info('SmsRmlConnect $r: ');
        info($r);
        return $r;
    }
}

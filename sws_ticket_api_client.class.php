<?php
/**
 * Created by PhpStorm.
 * User: vanzhiganov
 * Date: 4/24/15
 * Time: 12:00 AM
 */

class sws_ticket_api_client {
    protected $email;
    protected $secret;
    protected $organisation_id;
    
    public function __construct($email, $secret, $organisation_id) {
        $this->email = $email;
        $this->secret = $secret;
        $this->organisation_id = $organisation_id;
    }
    
    private function request($fields) {
        $query = http_build_query($fields);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://ticket.stackwebservices.com/api.php');
        curl_setopt($curl, CURLOPT_USERAGENT, 'SWS Ticket Client 1.1');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
        $out = curl_exec($curl);
        error_log("RESPONSE: {$out}");
        curl_close($curl);
        return $out;
    }

    public function ticket_add($email, $title, $content) {
        $request = array();
        $request['method'] = "ticket_add";
        $request['email'] = $this->email;
        $request['secret'] = $this->secret;
        $request['organisation_id'] = $this->organisation_id;

        $request['client_email'] = $email;
        $request['title'] = $title;
        $request['content'] = $content;
        $json_result = $this->request($request);

        return json_decode($json_result);
    }

    public function ticket_details_check($email, $ticket_id) {
        $request = array();
        $request['method'] = "ticket_details_check";
        $request['email'] = $this->email;
        $request['secret'] = $this->secret;
        $request['organisation_id'] = $this->organisation_id;

        $request['ticket_id'] = $ticket_id;
        $request['client_email'] = $email;
        $json_result = $this->request($request);
        return json_decode($json_result);
    }

    public function comment_add($email, $ticket_id, $content) {
        $request = array();
        $request['method'] = "comment_add";
        $request['email'] = $this->email;
        $request['secret'] = $this->secret;
        $request['organisation_id'] = $this->organisation_id;

        $request['ticket_id'] = $ticket_id;
        $request['client_email'] = $email;
        $request['content'] = $content;
        $json_result = $this->request($request);
        return json_decode($json_result);
    }
}

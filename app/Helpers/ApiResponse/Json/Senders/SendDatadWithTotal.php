<?php


namespace App\Helpers\ApiResponse\Json\Senders;


class SendDatadWithTotal extends Sender
{
    protected $data;

    public function __construct($data,$total,$current) {
        $this->response["total"] = $total;
        $this->response["currentPage"] = $current;
        $this->response["data"] = $data;
        $this->statusNumber = 'S200';
        $this->code = 200;
    }


}

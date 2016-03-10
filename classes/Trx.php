<?php

namespace CuboPolis;

/**
 * Description of Trx
 * 
 * @author ctala
 */
class Trx {

    private $_CUBOPOLISAPIURL = "https://www.cubopolis.com/v1/api/";
    private $_access_token;
    private $_resource_token;
    public $nPedido;
    public $subTotal;
    public $descuentos;
    public $total;
    public $tipoTRX;
    public $fecha;

    function __construct($nPedido, $subTotal, $descuentos, $total, $tipoTRX, $fecha) {
        $this->nPedido = $nPedido;
        $this->subTotal = $subTotal;
        $this->descuentos = $descuentos;
        $this->total = $total;
        $this->tipoTRX = $tipoTRX;
        $this->fecha = $fecha;
    }

    function set_CUBOPOLISAPIURL($_CUBOPOLISAPIURL) {
        $this->_CUBOPOLISAPIURL = $_CUBOPOLISAPIURL;
    }

    function set_access_token($_access_token) {
        $this->_access_token = $_access_token;
    }

    function set_resource_token($_resource_token) {
        $this->_resource_token = $_resource_token;
    }

    function sendToServer($returnTransfer = true) {
        $fields = array(
            "nPedido" => intval($this->nPedido),
            "subTotal" => intval($this->subTotal),
            "descuentos" => intval($this->descuentos),
            "total" => intval($this->total),
            "tipoTRX" => $this->tipoTRX,
            "fecha" => $this->fecha,
            
        );

        $postUrl = $this->_CUBOPOLISAPIURL . "create" . "?access-token=" . $this->_access_token."&resource-token=".$this->_resource_token;

        $fieldsString = "";
        foreach ($fields as $key => $value) {
            $fieldsString.=$key . "=" . $value . "&";
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $postUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, $returnTransfer);
        $server_output = curl_exec($ch);
        print_r($server_output);
        curl_close($ch);
        echo '\n ';
        echo '\n ';
        
    }

}

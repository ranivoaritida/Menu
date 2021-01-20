<?php
    function BuildResponse($status,$type,$message,$data){
        return [
            "META"=>[
                "type"=>$type,
                "status"=>$status,
                "message"=>$message
            ],
            "DATA"=>$data
        ];
    }

?>
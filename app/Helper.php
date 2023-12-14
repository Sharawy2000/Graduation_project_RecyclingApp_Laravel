<?php
    if(!function_exists('response_data')){
        function response_data($data,$message="",$status=200){
            return response()->json([
               "message"=>$message,
               "data"=>$data,
               "status"=>$status
            ],$status);
        }
    }

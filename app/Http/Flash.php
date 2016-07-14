<?php

namespace app\Http;

class Flash{

public function message($message,$type)
{
    session()->flash('flash_message',[
        'message' => $message,
        'type' => $type
        ]);
}

}

?>

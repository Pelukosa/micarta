<?php

class Session {
    
    public function destroySession() {
        session_destroy();
        header("Refresh:0");
    }

}
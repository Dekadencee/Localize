<?php

require_once('UI.php');

class UI_Alert extends UI {

    const TYPE_SUCCESS = 1;
    const TYPE_INFO = 2;
    const TYPE_WARNING = 3;

    protected $type;
    protected $message;

    public function __construct($message, $type = self::TYPE_INFO) {
        $this->message = $message;
        $this->type = $type;
    }

    public function getHTML() {
        $out = '<div class="alert alert-dismissable ';
        switch ($this->type) {
            case self::TYPE_SUCCESS:
                $out .= 'alert-success';
                break;
            case self::TYPE_INFO:
                $out .= 'alert-info';
                break;
            case self::TYPE_WARNING:
                $out .= 'alert-danger';
                break;
        }
        $out .= ' text-center">';
        $out .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        $out .= $this->message;
        $out .= '</div>';
        return $out;
    }

    public static function forActionThrottled() {
        return new UI_Alert('<p>Calm down! We\'ve seen too many requests from you. Please try again later!</p>', UI_Alert::TYPE_WARNING);
    }

}

?>
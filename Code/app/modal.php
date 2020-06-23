<?php

class Modal {


    public function __construct() {
        $this->id = code(6);
    }

    public function title($par) {
        $this->title = $par;
        return $this;
    }

    public function body($par) {
        $this->body = $par;
        return $this;
    }

    public function footer($par) {
        $this->footer = $par;
        return $this;
    }

    public function error($par) {
        $this->centered = true;
        $this->title = 'Error';
        $this->title_bg = 'danger';
        $this->title_color = 'white';
        $this->body = '<span class="subtitle">' . $par . '</span>';
        return $this;
    }

    public function success($par) {
        $this->centered = true;
        $this->title = 'Success';
        $this->title_bg = 'success';
        $this->title_color = 'white';
        $this->body = '<span class="subtitle">' . $par . '</span>';
        return $this;
    }

    public function show() {
        echo component('modal', jdecode(jencode($this)));
        echo js()->tag(' $("#modal_' . $this->id . '").addClass("is-active"); ');
    }


    public function confirm($text = null, $_buttons = array()) {

        $this->title_bg = 'warning';
        // $this->title_color = 'white';
        $this->title = 'Confirmation';
        $this->body = '<span class="subtitle">' . $text . '</span>';

        $buttons = '';
        foreach ($_buttons as $i => $s) {
            $buttons .= '<a href="' . @$s['href'] . '" ' . @$s['attr'];
            if (@$s['close']) $buttons .= ' close-modal ';
            $buttons .= ' class="button ' . @$s['class'] . '">' . @$s['label'] . '</a>';
        }

        $this->footer = $buttons;
        return $this;
    }
}



function modal() {
    return new Modal;
}

<?php


class Js {

    public function tag($par) {
        return '<script>' . $par . '</script>';
    }

    public function timeout($script = null, $in = 0) {
        return 'setTimeout(function() { ' . $script . ' }, ' . ($in * 1000) . ')';
    }

    public function alert($msg = null) {
        echo $this->tag('alert("' . $msg . '")');
    }

    public function close($in = 0) {
        echo '<script> ' . $this->timeout('window.close();', $in) . ' </script>';
    }

    public function test() {
        echo $this->tag('alert("test"); console.log("test")');
    }

    public function append($el = null, $html = null) {
        echo $this->tag(' $("' . $el . '").append("' . $html . '") ');
    }

    public function html($el = null, $html = null) {
        echo $this->tag(' $("' . $el . '").html(' . $html . ') ');
    }

    public function log($par = null) {
        echo is_array($par) ? $this->tag('console.log(' . json_encode($par) . ')') : $this->tag('console.log(\'' . $par . '\')');
    }

    public function table($par = null) {
        echo $this->tag('console.table(' . json_encode($par) . ')');
    }

    public function submit($par = null) {
        echo $this->tag(' $(\'' . $par . '\').submit(); ');
    }

    public function src($el, $par = null) {
        echo $this->tag(' $(\'' . $el . '\').attr("src", "' . $par . '"); ');
    }

    public function reset($par = null) {
        echo $this->tag(' $(\'' . $par . '\').trigger("reset"); ');
        echo $this->tag(' $(\'' . $par . '\')[0].reset(); ');
        echo $this->tag(' $(\'' . $par . '\').find("input[type=file]").val(""); ');
        echo $this->tag(' $(\'' . $par . '\').find("input[type=file]").closest(".file").removeClass("has-name"); ');
        echo $this->tag(' $(\'' . $par . '\').find("input[type=file]").closest(".file").find(".file-name").remove(); ');
    }

    public function trigger($par = null) {
        echo $this->tag(' $(\'' . $par . '\').trigger(); ');
    }

    public function removeClass($par = null, $class = null) {
        echo $this->tag(' $(\'' . $par . '\').removeClass(\'' . $class . '\'); ');
    }

    public function addClass($par = null, $class = null) {
        echo $this->tag(' $(\'' . $par . '\').addClass(\'' . $class . '\'); ');
    }

    public function remove($par = null) {
        echo $this->tag(' $(\'' . $par . '\').remove(); ');
    }

    public function hide($par = null) {
        echo $this->tag(' $(\'' . $par . '\').hide(); ');
    }

    public function show($par = null) {
        echo $this->tag(' $(\'' . $par . '\').show(); ');
    }

    public function val($par = null, $data = null) {
        echo $this->tag(' $(\'' . $par . '\').val("' . $data . '"); ');
    }

    public function component($par = null, $data = null) {
        // echo $this->tag(' console.log(JSON.parse(' . json_encode(['response' => $data]) . ')); ');

        echo $this->tag(' $(\'[c-' . $par . ']\').html(`' . $data . '`); ');
    }
}


function js() {
    $js = new Js();
    return $js;
}

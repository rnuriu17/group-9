<?php



class Language {


    var $lang;

    public function current() {
        return $this->lang;
    }

    public function trim($par) {
        $a = trim($par);
        $a = replace(' ', '', $a);
        return $a;
    }

    public function filter($str = null) {
        return md5(upper($str));
    }

    public function add($lang = 'default', $str = null) {
        if ($this->trim($str)) {
            $file = d('_languages/' . $lang . '.json');
            $lang_data = jdecode(contents($file));
            $lang_data = !is_array($lang_data) ? [] : $lang_data;
            $lang_data[$this->filter($str)] = $str;
            put($file, jencode($lang_data));
            return $str;
        }
    }

    public function update($id = null, $str = null, $lang = 'en') {
        if ($this->trim($id)) {
            $file = d('_languages/' . $lang . '.json');
            $lang_data = jdecode(contents($file));
            $lang_data = !is_array($lang_data) ? [] : $lang_data;
            $lang_data[$id] = $str;
            put($file, jencode($lang_data));
        }
    }

    public function remove($id = null, $lang = 'default') {
        if ($this->trim($id)) {
            $file = d('_languages/' . $lang . '.json');
            $lang_data = jdecode(contents($file));
            $lang_data = !is_array($lang_data) ? [] : $lang_data;
            unset($lang_data[$id]);
            put($file, jencode($lang_data));
        }
    }

    public function export($lang = 'default') {
        $file = d('_languages/' . $lang . '.json');
        return jdecode(contents($file));
    }

    public function get($str = null) {
        global $default_language, $current_language;

        $source = $default_language;
        $strings = $current_language;

        $filterStr = $this->filter($str);

        if (!@$source[$filterStr]) {
            $this->add('default', $str);
        }

        if ($this->lang != 'default' && !@$strings[$filterStr]) {
            $this->add($this->lang, $str);
        }

        return @$strings[$filterStr] ? $strings[$filterStr] : $str;
    }
}

f()->create('_languages/default.json');
f()->create('_languages/en.json');


function language() {
    global $language;
    $language = new Language;
    return $language;
}

function default_lang() {
    return language()->export('default');
}

function lang() {
    return language()->export(language()->current());
}

global $default_lang, $language_data;

$default_language = default_lang();
$current_language = lang();


function l($str) {
    echo language()->get($str);
}

function __($str) {
    return language()->get($str);
}

function t($str) {
    return language()->get($str);
}

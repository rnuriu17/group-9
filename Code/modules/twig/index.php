<?php

use Cocur\Slugify\Bridge\Twig\SlugifyExtension;
use Cocur\Slugify\Slugify;

global $TwigLoader;
global $twig;

f()->dir('views/');

$TwigLoader = new \Twig\Loader\FilesystemLoader(d('views/'));


$twig = new \Twig\Environment($TwigLoader, [
    'debug' => true,
    'autoescape' => false,
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());
$twig->addExtension(new SlugifyExtension(Slugify::create()));

$filter = new \Twig\TwigFilter('html_entity_decode', function ($string) {
    return html_entity_decode($string);
});
$twig->addFilter($filter);

$filter = new \Twig\TwigFilter('htmlentities', function ($string) {
    return htmlentities($string);
});

$twig->addFilter($filter);

$twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone(config('timezone'));


function twig() {
    global $twig;
    return $twig;
}

$url = [
    'home' => url(),
    'modules' => url('modules/'),
    'img' => url('dist/img/'),
    'css' => url('dist/css/'),
    'js' => url('dist/js/'),
    'back' => @$_SERVER['HTTP_REFERER'],
];
$filter1 = new Twig\TwigFunction("_", function ($string) {
    return __($string);
});
$filter2 = new Twig\TwigFunction("t", function ($string) {
    return __($string);
});
$slugify = new Twig\TwigFunction("slugify", function ($string) {
    return Slugify($string);
});


$components = new Twig\TwigFunction("components", function ($par, $data = array()) {
    echo twig()->render('components/' . $par . '.twig', $data);
});

$component = new Twig\TwigFunction("component", function ($par, $data = array()) {
    echo twig()->render('components/' . $par . '.twig', $data);
});
$element = new Twig\TwigFunction("element", function ($par, $data = array()) {
    echo twig()->render('elements/' . $par . '.twig', $data);
});

$elements = new Twig\TwigFunction("elements", function ($par, $data = array()) {
    echo twig()->render('elements/' . $par . '.twig', $data);
});

$icon = new Twig\TwigFunction("icon", function ($par, $data = null) {
    echo icon($par, $data);
});

$selected = new Twig\TwigFunction("selected", function ($par, $data = null) {
    if ($par == $data) echo ' selected ';
});

$tr = new Twig\TwigFunction("tr", function ($par, $data = null) {
    echo '<tr>
        <td>' . $par . '</td>
        <td>' . $data . '</td>
    </tr>';
});

twig()->addFunction(new Twig\TwigFunction("hidden", function ($name, $value = null) {
    echo '<input type="hidden" name="' . $name . '" class="_' . $name . '" value="' . $value . '">';
}));

twig()->addFunction(new Twig\TwigFunction("languagesJS", function () {
    echo '<script>var language = [] ';
    foreach (lang() as $i => $s) {
        echo "\n";
        echo 'language[\'' . $i . '\'] =  ' . json_encode($s) . '; ';
    }
    echo '</script>';
}));
twig()->addFunction(new Twig\TwigFunction("pages", function ($par, $data = array()) {
    echo twig()->render('pages/' . $par . '.twig', $data);
}));

$highlight = new Twig\TwigFunction("highlight", function ($string, $text) {
    if (trim($text)) {
        $term = preg_replace('/\s+/', ' ', trim($text));
        $r = $string;
        foreach (explode(' ', $term) as $i => $s) {
            $r = preg_replace("/\p{L}*?" . preg_quote($s) . "\p{L}*/ui", "<span class='h'>$0</span>", $r);
        }

        return $r;
    } else return $string;
});

twig()->addFunction($filter1);
twig()->addFunction($filter2);

twig()->addFunction($tr);
twig()->addFunction($selected);

twig()->addFunction($slugify);
twig()->addFunction($highlight);
twig()->addFunction($component);
twig()->addFunction($components);
twig()->addFunction($elements);
twig()->addFunction($element);
twig()->addFunction($icon);

twig()->addGlobal('url', $url);
twig()->addGlobal('u', $url['home']);


$page[] = get('a');
$page[] = get('b');
$page[] = get('c');
$page[] = get('d');
$page[] = get('e');
$page[] = get('f');

twig()->addGlobal('page', $page);
twig()->addGlobal('config', c()->all());
twig()->addGlobal('uri', requestUri());

global $current_language;
twig()->addGlobal('lang', $current_language);

function render($file = null, $title = null, $data = array()) {
    if (is_array($title)) {
        $data = $title;
        $title = '';
    }
    echo twig()->render($file . '.twig', array_merge(['title' => $title], $data));
}
function component($file = null, $data = array()) {
    echo twig()->render('components/' . $file . '.twig', $data);
}
function _component($file = null, $data = array()) {
    return twig()->render('components/' . $file . '.twig', $data);
}
function pages($file = null, $data = array()) {
    echo twig()->render('pages/' . $file . '.twig', $data);
}

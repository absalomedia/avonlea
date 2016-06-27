<?php


class ContentFilter
{
    public $content = '';

    public function __construct($content)
    {
        //set the content appropriately
        $this->content = $content;

        $loader = new \Twig_Loader_String();
        $twig = new \Twig_Environment($loader);

        //baseURL & siteURL filter
        $filter = new \Twig_SimpleFilter('*URL', function ($name, $string) {
            $fin = $name.'_url';

            return $fin($string);
        });
        $twig->addFilter($filter);

        //themeImg filter
        $filter = new \Twig_SimpleFilter('themeImg', function ($string) {
            return theme_img($string);
        });
        $twig->addFilter($filter);

        foreach ($GLOBALS['themeShortcodes'] as $shortcode) {
            $function = new \Twig_SimpleFunction($shortcode['shortcode'], function () use ($shortcode) {
                if (is_array($shortcode['method'])) {
                    $class = new $shortcode['method'][0]();

                    return call_user_func_array([$class, $shortcode['method'][1]], func_get_args());
                } else {
                    return call_user_func_array($shortcode['method'], func_get_args());
                }
            });
            $twig->addFunction($function);
        }

        //render the subject and content to a variable
        $this->content = $twig->render($this->content);
    }

    public function display()
    {
        return $this->content;
    }
}

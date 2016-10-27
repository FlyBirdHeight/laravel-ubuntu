<?php
/**
 * Created by PhpStorm.
 * User: jj
 * Date: 2016/10/23
 * Time: 10:20
 */

namespace App\Markdown;


class Markdown
{
    protected $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function Markdown($text){
        $html = $this->parser->makeHtml($text);
        return $html;
    }
}
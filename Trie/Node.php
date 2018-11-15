<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/10
 * Time: 20:14
 */
namespace Trie;
require_once "../Map/BSTMap.php";

use BSTMap as Map;
class Node
{
    public $isWord;
    public $next;
    public function __construct($isWord=false)
    {
        $this->isWord = $isWord;
        $this->next = new Map();
    }

}
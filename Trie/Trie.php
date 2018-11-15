<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/10
 * Time: 20:07
 */
require_once "Node.php";

use Trie\Node;

class Trie
{
    private $root;
    private $size;

    public function __construct()
    {
        $this->root = new Node();
        $this->size = 0;
    }

    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param $word
     * 向Trie添加一个单词
     */
    public function add($word)
    {
        $cur = $this->root;
        for ($i = 0; $i < strlen($word); $i++) {
            $c = $word[$i];
            if ($cur->next->get($c) == null) {
                $cur->next->add($c, new Node());
            }
            $cur = $cur->next->get($c);
        }
        if (!$cur->isWord) {
            $cur->isWord = true;
            $this->size++;
        }
    }


    public function contains($word)
    {
        $cur = $this->root;
        for ($i = 0; $i < strlen($word); $i++) {
            $c = $word[$i];
            if ($cur->next->get($c) == null) {
                return false;
            }
            $cur = $cur->next->get($c);
        }
        return $cur->isWord;
    }


    public function isPrefix($prefix)
    {
        $cur = $this->root;
        for ($i = 0; $i < strlen($prefix); $i++) {
            $c = $prefix[$i];
            if ($cur->next->get($c) == null) {
                return false;
            }
            $cur = $cur->next->get($c);
        }
        return true;
    }

    public function search($word)
    {

        return $this->_match($this->root, $word, 0);
    }

    private function _match($node, $word, $index)
    {

        if ($index == strlen($word)) {
            return $node->isWord;
        }
        $c = $word[$index];
        if ($c !='.') {
            if ($node->next->get($c) == null) {
                return false;
            }
            return $this->_match($node->next->get($c), $word, $index + 1);
        }else{

            for ($i = ord('a');$i<=ord('z');$i++){
                if ($node->next->get(chr($i)) == null) {
                    continue;
                }else{
                    if ( $this->_match($node->next->get(chr($i)), $word, $index + 1)){
                        return true;
                    }
                }


            }
        }
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/10
 * Time: 20:23
 */

require_once "Trie.php";

$trie = new Trie();

$trie->add("add");
$trie->add("false");

//echo  $trie->contains("false");
echo  $trie->search(".....");

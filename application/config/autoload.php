<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages']  = array();
$autoload['libraries'] = array('Template','session','database','Help');
$autoload['drivers'] = array('session');
$autoload['helper'] = array('url', 'file','form');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model']     = array('MHome');

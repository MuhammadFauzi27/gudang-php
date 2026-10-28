<?php
const SUPPORTED_LANGS = ['id', 'en'];

if (empty($_SESSION['lang']) || !in_array($_SESSION['lang'], SUPPORTED_LANGS, true)) {
    $_SESSION['lang'] = 'id'; // bahasa default
}

$GLOBALS['LANG_DATA'] = require __DIR__ . '/../lang/' . $_SESSION['lang'] . '.php';

function t(string $key): string
{
    return $GLOBALS['LANG_DATA'][$key] ?? $key;
}
<?php
namespace Microblog;
abstract class Utilitarios {
    public static function formataData(string $data):string {
        return date("d/m/Y H:i", strtotime($data));
    }

    public static function dump($dados) {
    // public static function dump(array | bool $dados) {
        echo "<pre>";
        var_dump($dados);
        echo "</pre>";
    }
}


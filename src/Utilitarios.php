<?php
namespace Microblog;
abstract class Utilitarios {

    // @autor: Marcelo
    public static function limitaCaractere($dados) {
        return mb_strimwidth($dados, 0, 20, " ...");
    }

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


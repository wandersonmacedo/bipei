<?php


namespace App\Helpers;


class Utils
{

    /*formata datas*/
    public static function formata_data($data)
    {
        if ($data <> "0000-00-00" AND $data <> "") {
            list($ano, $mes, $dia) = explode("-", $data);
            $return = "$dia/$mes/$ano";
        } else {
            $return = "";
        }
        return $return;
    }

    /* regex rastreio */
    public static function regex_rastreio($re)
    {
        "<script>alert('ok');</script>";
        $re = '/^[A-Z]{2}[1-9]{9}[A-Z]{2}$/m';
        $str = 'AZ123456789BR';
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
        // Print the entire match result
        // var_dump($matches);
    }

    /* SELECT RELATÓRIO */
    public static function formata_data_mes_ano($data)
    {
        if ($data <> "0000-00" AND $data <> "") {
            list($ano, $mes) = explode("-", $data);
            $return = "$mes/$ano";
        } else {
            $return = "";
        }
        return $return;
    }

    /* Nome do mÊs na exportação de relatório */
    public static function mes_atual($mes)
    {
        $data = date("Y");
        switch ($mes) {
            case $data . "-01":
                $mes = "Janeiro";
                break;
            case $data . "-02":
                $mes = "Fevereiro";
                break;
            case $data . "-03":
                $mes = "Março";
                break;
            case $data . "-04":
                $mes = "Abril";
                break;
            case $data . "-05":
                $mes = "Maio";
                break;
            case $data . "-06":
                $mes = "Junho";
                break;
            case $data . "-07":
                $mes = "Julho";
                break;
            case $data . "-08":
                $mes = "Agosto";
                break;
            case $data . "-09":
                $mes = "Setembro";
                break;
            case $data . "-10":
                $mes = "Outubro";
                break;
            case $data . "-11":
                $mes = "Novembro";
                break;
            case $data . "-12":
                $mes = "Dezembro";
                break;
        }
        $data_escrita = $mes;
        echo $data_escrita;
    }

}

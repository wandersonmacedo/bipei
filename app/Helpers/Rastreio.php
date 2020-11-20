<?php


namespace App\Helpers;


class Rastreio
{
    /*
* Classe de Rastreamento de Pedidos dos Correios. PHP + SOAP
* ----------------------------------------------------------
*
* Esta é uma classe estatica simples criada com intuito de rastrear objetos dos correios
* Utilizando para isso PHP e a API SOAP fornecida pelo sistema dos Correios.
* Fique a vontade para usar como desejar, em vosso sistema, seja
* ele pessoal ou comercial.
*
* O único intuito aqui é apresentar de forma simples o
* funcionamento da API fornecida pelos correios.
*
* Para mais detalhes verifique a documentação fornecida pelos Correios:
* @link - http://sooho.com.br/resources/Manual_RastreamentoObjetosWS.pdf
*
* @since - 2016.08.21 22:45
* @author Wanderlei Santana <sans.pds@gmail.com>
* @version 201705092234 - revisão
*/

    /**
     * URL de acesso a API dos Correios.
     * @var string
     */
    private $wsdl = null ;

    /**
     * Seu nome único de usuário para acesso a API
     * Normalmente obtido na agência de sua cidade
     * @var string
     */
    private $user = null ;

    /**
     * Sua senha unica de acesso a API dos correios.
     * Deve ser obtida junto ao nome de usuario
     * @var string
     */
    private $pass = null ;

    /**
     * L ou F - Sendo:
     * L - usado para uma Lista de Objetos; e
     * F - usado para um intervalo de Objetos.
     * @var Char
     */
    private $tipo = null ;

    /**
     * Delimita o escopo de resposta de cada objeto.
     * T - Retorna todos os eventos do Objeto
     * U - Será retornado apenas o último evento do Objeto
     * @var Char
     */
    private $resultado = null ;

    /**
     * Deve ser um valor do tipo integer, sendo
     * 101 - para o retorno em idioma Portugues do Brasil
     * 102 - para o retorno em idioma Inglês
     * @var integer
     */
    private $idioma = null ;

    /**
     * flag que indica se este objeto foi ou nao inicializado.
     * Apenas para uso interno desta classe
     * @var boolean
     */
    private $inicializado = false ;

    /**
     * Inicializa este objeto.
     *
     * É  obrigatorio a chamada deste metodo antes de iniciar
     * o rastreamento de Objetos.
     *
     * Passe os parametros para login no sistema dos correios.
     * Caso não possua dados de login, entre em contato com a
     * agencia mais proxima e solicite as credências para utilizar
     * o sistema.
     *
     * Mesmo que não tenha os dados de login, esta classe irpa funcionar
     * com Credenciais que são utilizadas como teste.
     *
     * @param array $_param - Matriz contendo os dados de login e
     * demais dados de acesso a API dos Correios.
     * Caso nada seja informado, a Classe usará os dados Default.
     *
     * Dados Experados:
     *    array['wsdl'] - URL de acesso a API
     *    array['user'] - Nome do Seu usuario de acesso a API dos Correios
     *    array['pass'] - Sua senha de acesso a API
     *    array['tipo'] - L ou F (normalmente L)
     *    array['resultado'] - T ou U (normalmente T)
     *    array['idioma'] - Padrão é o 101, que indica o idioma Português do Brasil
     *
     * @return Void
     */
    public function __construct()
    {
        $this->wsdl ="http://webservice.correios.com.br/service/rastro/Rastro.wsdl" ;
        $this->user ="bipeipostei.22" ;
        $this->pass ="BipeiPostei#@22" ;
        $this->tipo = "L" ;
        $this->resultado = "T" ;
        $this->idioma = "101" ;
        $this->inicializado= true;
    }

    /**
     * Método que realiza o rastreamento de Objetos dos Correios
     * espera receber como parametro um CODIGO de rastreamento
     * devidamente Valido e existente na database dos Correios.
     * EX: PJ012345678BR
     *
     * Para mais do que um Objeto, passaro todos os codigos um após
     * o outro, sem simbolos especiais ou espaços.
     * EX: PJ012345678BRPJ912345678BRPJ812345678BR
     *
     * @param  string $codigo - Codigo ou lista de codigos de objetos a ser(em) rastreado(s)
     * @return Object
     */
    public function get( $codigo = null )
    {
        # verificacoes simples para validar o codigo. Adicione
        # outros metodos a seu gosto

        if( is_null( $codigo ) )
            return self::erro( "Nenhum código de rastreamento recebido." );

        if( ! self::soapExists() )
            return self::erro( "Parece que o Modulo SOAP não esta ativo em seu servidor." );

        $_evento = array(
            'usuario'   => $this->user,
            'senha'     => $this->pass,
            'tipo'      => $this->tipo,
            'resultado' => $this->resultado,
            'lingua'    => $this->idioma,
            'objetos'   => trim($codigo)
        );
        try{
            $arrContextOptions=array("ssl"=>array( "verify_peer"=>false, "verify_peer_name"=>false,'crypto_method' => STREAM_CRYPTO_METHOD_TLS_CLIENT));

            $options = array(
                'soap_version'=>SOAP_1_2,
                'exceptions'=>true,
                'trace'=>1,
                'cache_wsdl'=>WSDL_CACHE_NONE,
                'stream_context' => stream_context_create($arrContextOptions)
            );
            $client = new \SoapClient($this->wsdl , $options);
            dd($client);
            $eventos = $client->buscaEventos( $_evento );
        }catch (\Exception $e)
        {
            dd($e->getMessage());
        }


        // sempre retorna objeto por padrao, mesmo em caso de erros.
        return ($eventos->return->qtd == 1) ?
            $eventos->return->objeto:
            $eventos->return;
    }

    /**
     * Verifica se o Modulo SOAP esta ativo
     * no servidor do usuario e funcionando.
     *
     * @return bool - true se tudo ok
     */
    private function soapExists() {
        return extension_loaded('soap') && class_exists("SOAPClient") ;
    }

    /**
     * Metodo para retorno de erros no formato de objetos
     * para manter o padrao de retorno.
     *
     * @param  string $__mensagem - Mensagem de erro a ser retornado
     * @return stdClass Object
     */
    private function erro( $__mensagem = null ){
        $obj = new \stdClass;
        $obj -> erro = $__mensagem ;
        return $obj ;
    }


}

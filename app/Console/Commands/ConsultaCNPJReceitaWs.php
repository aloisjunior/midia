<?php

namespace ARsig\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ConsultaCNPJReceitaWs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consulta:cnpj {cnpj}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executa comando de consulta de cnpj no site receitaws';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function getArguments()
    {
        return [
            ['cnpj', InputArgument::REQUIRED, 'Url para execução', 'String'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['cnpj', null, InputOption::VALUE_REQUIRED,
                'cnpj para execução', null],
        ];
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $curlSession = curl_init();

        //Pede o que retorne o resultado como string
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curlSession, CURLOPT_URL, 'https://receitaws.com.br/v1/cnpj/'.somenteNumeros($this->argument('cnpj')));
        //Pede o que retorne o resultado como string
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        //Ignora certificado SSL
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, false);

        $jsonData = curl_exec($curlSession);

        curl_close($curlSession);

//        preg_match("/\{(.*)\}/s", $jsonData, $jsonResult);
//        $jsonResult = json_decode($jsonData);

//        dd(json_decode($jsonResult));

//        dd(collect(json_decode($jsonData))->toArray());
//        return json_decode($jsonData)   ;

//        $this->output = json_decode($jsonData);



        return json_decode($jsonData);
    }
}

<?php

namespace ARsig\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ConsultaCEP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consulta:cep {cep}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executa comando de consulta de cep no site receitaws';

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
            ['cep', InputArgument::REQUIRED, 'Url para execução', 'String'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['cep', null, InputOption::VALUE_REQUIRED,
                'cep para execução', null],
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

        curl_setopt($curlSession, CURLOPT_URL, 'https://viacep.com.br/ws/'.somenteNumeros($this->argument('cep')).+ '/json');
        //Pede o que retorne o resultado como string
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        //Ignora certificado SSL
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, false);

        $jsonData = curl_exec($curlSession);
//    dd(json_decode($jsonData));
        curl_close($curlSession);
        return response()->json(json_decode($jsonData));
    }
}

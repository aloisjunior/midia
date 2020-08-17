<?php

namespace ARsig\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ExecutarUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'executa:url {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executa comandos em background';

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
            ['url', InputArgument::REQUIRED, 'Url para execução', 'String'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['url', null, InputOption::VALUE_REQUIRED,
                'Url para execução', null],
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
        curl_setopt($curlSession, CURLOPT_URL, $this->argument('url'));
        $jsonData = curl_exec($curlSession);
        curl_close($curlSession);
        return $jsonData;



    }
}

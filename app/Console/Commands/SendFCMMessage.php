<?php

namespace ARsig\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class SendFCMMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:fcm {message},{id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
            ['message', InputArgument::REQUIRED, 'Url para execução', 'String'],
            ['id', InputArgument::REQUIRED, 'Url para execução', 'String'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['message', null, InputOption::VALUE_REQUIRED,
                'Url para execução', null],
            ['id', null, InputOption::VALUE_REQUIRED,
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
        $url = 'https://fcm.googleapis.com/fcm/send';

        $message = $this->argument('message');
        $id = $this->argument('id');

        $fields = array (
            'registration_ids' => array (
                $id
            ),
            'data' => array (
                "message" => $message
            )
        );
        $fields = json_encode ( $fields );

        echo json_encode ($message);
        echo $id;

        $headers = array (
            'Authorization: key=' . "AIzaSyD1MZbvDJ0mkZy69fGMlIO-Ev5LNjBeaMs",
            'Content-Type: application/json'
        );

        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

        $result = curl_exec ( $ch );
        echo $result;
        curl_close ( $ch );
    }
}

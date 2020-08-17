<?php

namespace ARsig\Http\Controllers\Backend;

use ARsig\Models\PlayersLogs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ARsig\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PlayerReportController extends Controller
{
    protected $dataModel;

    public function __construct(PlayersLogs $playersLogs)
    {
        $this->middleware('auth');
        $this->dataModel = $playersLogs;
    }

    public function index(Request $request)
    {
        $temAlgumCriterio = false;

        $dataInicial = $request['_dataInicialFormatted'] ? $request['_dataInicialFormatted'] : '';
        $dataFinal = $request['_dataFinalFormatted'] ? $request['_dataFinalFormatted'] : '';
        $playerId = $request['player'] ? $request['player']['id'] : '';
        $conteudoId = $request['conteudo'] ? $request['conteudo']['id'] : '';
        $tipoRelatorio = $request['tipo_relatorio'] ? strtolower($request['tipo_relatorio']) : 'detalhado';

        $consulta = '';

        if ((isset($dataInicial)) && (!(trim($dataInicial) === ''))) {
            $dataInicial = Carbon::createFromFormat('d/m/Y', $dataInicial)->format('Y-m-d') . ' 00:00:00';
            if ($temAlgumCriterio) {
                $consulta .= 'and (horario > "' . $dataInicial . '")';
            } else {
                $temAlgumCriterio = true;
                $consulta = '(horario > "' . $dataInicial . '")';
            }
        }

        if ((isset($dataFinal)) && (!(trim($dataFinal) === ''))) {
            $dataFinal = Carbon::createFromFormat('d/m/Y', $dataFinal)->format('Y-m-d') . ' 23:59:59';
            if ($temAlgumCriterio) {
                $consulta .= 'and (horario < "' . $dataFinal . '")';
            } else {
                $temAlgumCriterio = true;
                $consulta = '(horario < "' . $dataFinal . '")';
            }
        }

        if ((isset($playerId)) && (!(trim($playerId) === ''))) {
            if ($temAlgumCriterio) {
                $consulta .= 'and (player_id = ' . $playerId . ')';
            } else {
                $temAlgumCriterio = true;
                $consulta = '(player_id = ' . $playerId . ')';
            }
        }

        if ((isset($conteudoId)) && (!(trim($conteudoId) === ''))) {
            if ($temAlgumCriterio) {
                $consulta .= 'and (conteudo_id = ' . $conteudoId . ')';
            } else {
                $temAlgumCriterio = true;
                $consulta = '(conteudo_id = ' . $conteudoId . ')';
            }
        }

        switch ($tipoRelatorio){
            case 'detalhado':
                if ($consulta == ''){
                    $logs = $this->dataModel
                        ->whereRaw('id = 0')
                        ->get();
                }else {
                    $logs = $this->dataModel
                        ->whereRaw($consulta.' and (conteudo_id <> 0)')
                        ->get(['horario', 'descricao', 'conteudo_nome', 'tipo_conteudo', 'tipo_log']);
                }

                $headers = [
                    ['text'=>'Horario', 'value'=>'horario'],
                    ['text'=> 'Descrição', 'value'=>'descricao'],
                    ['text'=> 'Conteúdo', 'value'=>'conteudo_nome'],
                    ['text'=> 'Tipo', 'value'=>'tipo_conteudo'],
                    ['text'=> 'Categoria', 'value'=>'tipo_log', 'class'=>'no-print'],
                ];
                break;

            case 'group_player':
                if ($consulta == ''){
                    $logs = $this->dataModel
                        ->whereRaw('id = 0')
                        ->get();
                }else {
                    $PDO = DB::connection('mysql')->getPdo();

//                    $billingStmt = $PDO->prepare('
//                        select p.nome as playerNome, date(horario) as horario, pl.conteudo_nome as conteudo_nome, count(1) as total
//                          from players_logs as pl LEFT JOIN players p on (pl.player_id = p.id)
//                        where ('.$consulta.')
//                        GROUP BY p.nome, date(horario), pl.conteudo_nome, pl.conteudo_id
//                        HAVING conteudo_id <> 0'
//                    );
                    $billingStmt = $PDO->prepare('
                        select p.nome as playerNome, pl.conteudo_nome as conteudo_nome, count(1) as total
                          from players_logs as pl LEFT JOIN players p on (pl.player_id = p.id)
                        where ('.$consulta.')                         
                        GROUP BY p.nome, pl.conteudo_nome, pl.conteudo_id
                        HAVING conteudo_id <> 0'
                    );

                    //dd($billingStmt);
                    $billingStmt->execute();
                    $logs = $billingStmt->fetchAll((\PDO::FETCH_ASSOC));
                }

                $headers = [
                    ['text'=>'Player', 'value'=>'playerNome'],
//                    ['text'=>'Dia', 'value'=>'horario'],
                    ['text'=> 'Conteúdo', 'value'=>'conteudo_nome'],
                    ['text'=> 'Total', 'value'=>'total'],
                ];
                break;
            case 'group_conteudo':
                if ($consulta == ''){
                    $logs = $this->dataModel
                        ->whereRaw('id = 0')
                        ->get();
                }else {
                    $PDO = DB::connection('mysql')->getPdo();

                    $billingStmt = $PDO->prepare('
                        select conteudo_nome , count(1) as "total"
                        from players_logs
                        where ('.$consulta.')
                        GROUP BY conteudo_nome, conteudo_id
                        HAVING conteudo_id <> 0'
                    );

                    //dd($billingStmt);
                    $billingStmt->execute();
                    $logs = $billingStmt->fetchAll((\PDO::FETCH_ASSOC));
                }

                $headers = [
                    ['text'=> 'Conteúdo', 'value'=>'conteudo_nome'],
                    ['text'=> 'Total', 'value'=>'total'],
                ];
                break;
            case 'group_data':
                if ($consulta == ''){
                    $logs = $this->dataModel
                        ->whereRaw('id = 0')
                        ->get();
                }else {
                    $PDO = DB::connection('mysql')->getPdo();

                    $billingStmt = $PDO->prepare('
                        select date(horario) as horario, conteudo_nome , count(1) as "total"
                        from players_logs
                        where ('.$consulta.')
                        GROUP BY date(horario), conteudo_nome, conteudo_id
                        HAVING conteudo_id <> 0'
                    );

                    //dd($billingStmt);
                    $billingStmt->execute();
                    $logs = $billingStmt->fetchAll((\PDO::FETCH_ASSOC));
                }

                $headers = [
                    ['text'=>'Dia', 'value'=>'horario'],
                    ['text'=> 'Conteúdo', 'value'=>'conteudo_nome'],
                    ['text'=> 'Total', 'value'=>'total'],
                ];
                break;
        }

        return response()->json(['logs'=>$logs, 'headers'=>$headers], 200, [], JSON_UNESCAPED_UNICODE );
//        return response()->json($logs);
    }

}

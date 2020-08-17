<?php

namespace ARsig\Http\Controllers\Api;

use ARsig\Http\Controllers\Controller;
use ARsig\Policies\ApiPolicy;
use Illuminate\Support\Facades\Gate;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class RedesSociaisController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function facebookMetrics(LaravelFacebookSdk $fb, $metrica = 'page_fans', $periodo = 'day')
    {
        $fb->setDefaultAccessToken('EAAB2vZBKyw3EBAFxZCatINgkyUrPbCNhS7BRBQEJvR2ughlhciYjLlKqF9ZBZAp7Y8ZCBfCRRSfbZB0gK4qZBqeClj1JIiLcK8B3rSybBClqKf94utCfpyxHNFAWLl3R22gSUZBZAMyzDH0jH8QOOSwhr0Sk4ViaEeXVoZBmI36U3SdwZDZD');
//    rotinas que funcionam: page_impressions, page_impressions_unique, page_impressions_organic, page_fans, page_fan_adds_unique, page_fan_adds, page_fan_removes
//    page_fan_removes_unique, page_views_total, page_posts_impressions
//    pesquisar mais page_views_external_referrals
        /*date_preset
            enum{today, yesterday, this_month, last_month, this_quarter, lifetime, last_3d, last_7d, last_14d, last_28d,
        last_30d, last_90d, last_week_mon_sun, last_week_sun_sat, last_quarter, last_year, this_week_mon_today, this_week_sun_today, this_year}

        period
        enum{day, week, days_28, month, lifetime, total_over_range}
         *
         * */

//        $dadospage = $fb->get('/ARsig/insights/'.$metrica.'?size='.\Carbon\Carbon::now()->timestamp.'&until='.\Carbon\Carbon::now()->subDay(30)->timestamp);

        $parametros = array(
                'pretty' => '0',
//                'since' => Carbon::now()->toIso8601String() ,
//                'until' => Carbon::now()->subDay(30)->toIso8601String(),
                'metric' => $metrica,
                'date_preset'=>'last_28d',
                'period' => $periodo
            );

        $dadospage = $fb->sendRequest('GET', '/ARsig/insights', $parametros);

        $responses = $dadospage->getGraphEdge();

        $valores = [];

        // pega os dados atuais
        foreach ($responses as $page) {
            $arrtmp = $page->asArray()['values'];

            foreach ($arrtmp as $linha){
                $valores[$linha['end_time']->format('d/m')] = (!empty($linha['value'])) ? $linha['value'] : '0';
            }
        }
        $responsesOriginal = $responses;

        $i = 1;
        // pega os dados anteriores
        while (true) {
            $anteriorPage = $fb->previous($responses);
            $responses = $anteriorPage;


            if (empty($anteriorPage) || ($i = 30)) { // sai com 30 loops = até 30 dias a consulta
                break;
            }

            $i++;

            foreach ($anteriorPage as $page) {
                $arrtmp = $page->asArray()['values'];
//                echo $arrtmp;
                foreach ($arrtmp as $linha){
                    $valores[$linha['end_time']->format('d/m')] = (!empty($linha['value'])) ? $linha['value'] : '0';
                }
            }
        }

        return response()->json($valores);

//        try {
//            $responses = $fb->sendBatchRequest($batch);
//        } catch (Facebook\Exceptions\FacebookResponseException $e) {
//            // When Graph returns an error
//            echo 'Graph returned an error: ' . $e->getMessage();
//            exit;
//        } catch (Facebook\Exceptions\FacebookSDKException $e) {
//            // When validation fails or other local issues
//            echo 'Facebook SDK returned an error: ' . $e->getMessage();
//            exit;
//        }
//
//        foreach ($responses as $key => $response) {
//            if ($response->isError()) {
//                $e = $response->getThrownException();
//                echo '<p>Error! Facebook SDK Said: ' . $e->getMessage() . "\n\n";
//                echo '<p>Graph Said: ' . "\n\n";
//                var_dump($e->getResponse());
//            } else {
//                echo "<p>(" . $key . ") HTTP status code: " . $response->getHttpStatusCode() . "<br />\n";
//                echo "Response: " . $response->getBody() . "</p>\n\n";
//                echo "<hr />\n\n";
//
//                dd($response);
//            }
//        }


    }
}

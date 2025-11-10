<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapaController extends Controller
{
    public function index()
    {
        return view('mapa');
    }

    /**
     * Retorna informações sobre um estado específico.
     *
     * @param string $estado Sigla do estado (ex: SP, RJ, MG)
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEstadoInfo($estado)
    {
        // Array com informações dos estados - temporário até mover para o banco de dados
        $info = [
            'AC' => ['nome' => 'Acre', 'iniciativas' => 'Projeto de reflorestamento na nascente do Rio Acre.'],
            'AL' => ['nome' => 'Alagoas', 'iniciativas' => 'Programa de saneamento básico na região metropolitana de Maceió.'],
            'AP' => ['nome' => 'Amapá', 'iniciativas' => 'Monitoramento da qualidade da água em áreas de extração de açaí.'],
            'AM' => ['nome' => 'Amazonas', 'iniciativas' => 'Projeto de proteção de mananciais na região de Manaus.'],
            'BA' => ['nome' => 'Bahia', 'iniciativas' => 'Construção de cisternas no semiárido baiano.'],
            'CE' => ['nome' => 'Ceará', 'iniciativas' => 'Projetos de reuso de água na agricultura.'],
            'DF' => ['nome' => 'Distrito Federal', 'iniciativas' => 'Programa de educação ambiental sobre o uso consciente da água.'],
            'ES' => ['nome' => 'Espírito Santo', 'iniciativas' => 'Recuperação de matas ciliares do Rio Doce.'],
            'GO' => ['nome' => 'Goiás', 'iniciativas' => 'Sistema de monitoramento de recursos hídricos para o agronegócio.'],
            'MA' => ['nome' => 'Maranhão', 'iniciativas' => 'Projetos de saneamento rural em comunidades quilombolas.'],
            'MT' => ['nome' => 'Mato Grosso', 'iniciativas' => 'Proteção de nascentes no Pantanal.'],
            'MS' => ['nome' => 'Mato Grosso do Sul', 'iniciativas' => 'Programa de pagamento por serviços ambientais para conservação da água.'],
            'MG' => ['nome' => 'Minas Gerais', 'iniciativas' => 'Recuperação de áreas degradadas na bacia do Rio São Francisco.'],
            'PA' => ['nome' => 'Pará', 'iniciativas' => 'Projetos de saneamento em comunidades ribeirinhas.'],
            'PB' => ['nome' => 'Paraíba', 'iniciativas' => 'Programa de convivência com o semiárido.'],
            'PR' => ['nome' => 'Paraná', 'iniciativas' => 'Programa de conservação de solo e água na agricultura familiar.'],
            'PE' => ['nome' => 'Pernambuco', 'iniciativas' => 'Projetos de dessalinização de água no sertão.'],
            'PI' => ['nome' => 'Piauí', 'iniciativas' => 'Construção de barragens subterrâneas.'],
            'RJ' => ['nome' => 'Rio de Janeiro', 'iniciativas' => 'Despoluição da Baía de Guanabara.'],
            'RN' => ['nome' => 'Rio Grande do Norte', 'iniciativas' => 'Projetos de energia eólica e dessalinização.'],
            'RS' => ['nome' => 'Rio Grande do Sul', 'iniciativas' => 'Programa de proteção de banhados.'],
            'RO' => ['nome' => 'Rondônia', 'iniciativas' => 'Projetos de piscicultura sustentável.'],
            'RR' => ['nome' => 'Roraima', 'iniciativas' => 'Monitoramento de rios em terras indígenas.'],
            'SC' => ['nome' => 'Santa Catarina', 'iniciativas' => 'Programa de conservação de recursos hídricos em áreas de produção de suínos.'],
            'SP' => ['nome' => 'São Paulo', 'iniciativas' => 'Programa de recuperação de mananciais da Cantareira.'],
            'SE' => ['nome' => 'Sergipe', 'iniciativas' => 'Projetos de saneamento em cidades do interior.'],
            'TO' => ['nome' => 'Tocantins', 'iniciativas' => 'Programa de manejo integrado de bacias hidrográficas.']
        ];

        return response()->json($info[$estado] ?? ['nome' => 'Estado não encontrado', 'iniciativas' => 'Nenhuma iniciativa registrada.']);
    }
}

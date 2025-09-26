<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AguaController extends Controller
{
    public function index(){

        $topics = [
            // 🌍 CLIMA
            "Clima" => [
                [
                    "title" => "Chuvas",
                    "text"  => "As chuvas são fundamentais para manter o ciclo da água e a fertilidade do solo. Elas ajudam a recarregar aquíferos subterrâneos e rios que abastecem cidades. No entanto, quando caem de forma intensa em pouco tempo, podem provocar enchentes. A má gestão urbana aumenta os riscos, com ruas asfaltadas e pouca área verde. Em áreas rurais, a chuva garante a produção agrícola. Mas a irregularidade das precipitações gera perdas de colheitas. Com as mudanças climáticas, os padrões de chuva se tornaram imprevisíveis. Isso obriga a sociedade a investir em técnicas de aproveitamento sustentável. A captação de água da chuva em cisternas é uma alternativa prática. Dessa forma, as chuvas podem ser vistas mais como recurso do que como ameaça.",
                    "image" => "chuvas.jpg"
                ],
            ],

        ];



        return view('agua', compact('topics'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Reports\AutoresReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
	public function autores()
	{
		// Obtém os dados da tabela
		$dataTable = DB::table('vw_report_autores')->select('*')->get();
		$dataChart = DB::table('vw_report_autores')
						->select('nome AS autor', DB::raw('COUNT(titulo) AS livros'))
						->havingRaw('COUNT(titulo) > 0')
						->groupBy('autor')
						->orderBy('livros', 'desc')
						->orderBy('autor')
						->limit(6)
						->get();

		return view('report.autores', [
			'data' => $dataTable,
			'chart' => $dataChart
		]);
	}

}


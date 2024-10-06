<?php 

namespace App\Reports;

use koolreport\KoolReport;

class AutoresReport extends KoolReport
{
	
	    public function settings()
    {
        return array(
            "dataSources"=>array(
                "automaker"=>array(
					"host" => env("DB_HOST"),
					"username" => env("DB_USERNAME"),
					"password" => env("DB_PASSWORD"),
					"dbname" => env("DB_DATABASE"),
					"charset" => "utf8",
                    'class' => "\koolreport\datasources\MySQLDataSource"  
                ),
            )
        );
    }
	
    public function setup()
    {
        $this->src("automaker")
        ->query("SELECT * FROM vw_report_autores")
        ->pipe($this->store("Autores"));
		//->pipe($this->toJson());
    }
}

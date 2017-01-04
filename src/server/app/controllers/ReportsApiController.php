<?php

class ReportsApiController extends Controller {
    private $repository;
    
    function __construct($repository = NULL) {
        if ($repository) {
            $this->repository = $repository;
        } else {
            $this->repository = new ReportsRepository(Db::getInstance());
        }
    }

    /**
     * 特定のレポートを取得する
     * /api/reports/:year/:weeknum/:user_id
     */
    function get($year, $weeknum, $user_id) {
        $report = $this->repository->findById($year, $weeknum, $user_id);
        
        if (!$report) {
            return $this->notFound();
        }

        return $this->ok($report);
    }

    /**
     * 特定のレポートを更新する
     * /api/reports/:year/:weeknum/:user_id
     */
    function put($year, $weeknum, $user_id, $data) {
        $report = $this->repository->findById($year, $weeknum, $user_id);
        
        if (!$report) {
            return $this->notFound();
        }

        $report = Report::parse($data);
        $report->year = $year;
        $report->weeknum = $weeknum;
        $report->user_id = $user_id;
        $this->repository->save($report);

        return $this->ok($report);
    }
}
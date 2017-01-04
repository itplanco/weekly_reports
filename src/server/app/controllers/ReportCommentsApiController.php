<?php

class ReportCommentsApiController extends Controller {
    private $repository;
    
    function __construct($repository = NULL) {
        if ($repository) {
            $this->repository = $repository;
        } else {
            $this->repository = new ReportsRepository(Db::getInstance());
        }
    }

    /**
     * 特定のレポートのコメント一覧を取得する
     * /api/reports/:year/:weeknum/:user_id/comments
     */
    function index($year, $weeknum, $user_id) {
        $report = $this->repository->findById($year, $weeknum, $user_id);
        
        if (!$report) {
            return $this->notFound();
        }

        return $this->ok($report);
    }

    /**
     * 特定のレポートのコメントを登録する
     * /api/reports/:year/:weeknum/:user_id/comments
     * @param $data user_id, message
     */
    function post($year, $weeknum, $user_id, $data) {
        $report = $this->repository->findById($year, $weeknum, $user_id);
        
        if (!$report) {
            return $this->notFound();
        }

        $comment = Comment::parse($data);
        $report->addComment($comment->user_id, $comment->message);
        $this->repository->save($report);

        return $this->ok($report);
    }
}
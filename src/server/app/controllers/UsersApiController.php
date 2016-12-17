<?php

class UsersApiController extends Controller {
    private $repository;
    
    function __construct($repository) {
        if (isset($repository)) {
            $this->repository = $repository;
        } else {
            $this->repository = new UsersRepository(Db::getInstance());
        }
    }
    
    /**
    * ユーザー一覧を取得する
    */
    function index() {
        $result = $this->repository->findAll();
        return $this->ok($result);
    }
    
    /**
    * 指定IDのユーザーを取得する
    */
    function get($id) {
        $result = $this->repository->findById($id);
        
        if (!$result) {
            return $this->notFound();
        }

        return $this->ok($result);
    }
    
    /**
     * ユーザーを登録する
     */
    function post($data) {
        if (isset($data['user_id']) && $data['user_id']) {
            return $this->badRequest("新規登録時にはIDを指定しないでください。");
        }

        if (!isset($data['name'])) {
            return $this->badRequest("名前は必ず指定してください。");
        }

        //IDを新規に採番
        $data['user_id'] = $this->repository->nextId();
        $this->repository->insert($data);
        
        return $this->noContent();
    }
    
    /**
     * ユーザーを更新する
     */
    function put($id, $data) {
        $result = $this->repository->findById($id);
        if (!$result) {
            // ユーザーが存在しない場合
            return $this->notFound();
        }

        $data['user_id'] = $id;
        $this->repository->update($data);
        return $this->noContent();
    }
    
    /**
     * ユーザーを削除する
     */
    function delete($id) {
        $result = $this->repository->findById($id);
        if (!$result) {
            // ユーザーが存在しない場合
            return $this->notFound();
        }

        $this->repository->delete($id);
        return $this->noContent();
    }
}
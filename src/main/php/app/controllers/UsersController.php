
<?php
class UsersController extends Controller {
    private $service;
    
    function __construct() {
        $this->service = new UsersService();
    }
    
    /**
    * ユーザー一覧を取得する
    */
    function index() {
        $result = $this->service->findAll();
        return $this->ok($result);
    }
    
    /**
    * 指定IDのユーザーを取得する
    */
    function get($id) {
        $result = $this->service->findById($id);
        
        if (!$result) {
            return $this->notFound();
        }

        return $this->ok($result);
    }
    
    /**
    * ユーザーを登録する
    */
    function post($data) {
        if (isset($data['user_id'])) {
            return $this->badRequest("新規登録時にはIDを指定しないでください。");
        }

        if (!isset($data['password'])) {
            return $this->badRequest("新規登録時にはパスワードを必ず指定してください。");
        }

        //IDを新規に採番
        $data['user_id'] = $this->service->nextId();
        $this->service->insert($data);
        
        return $this->ok();
    }
}
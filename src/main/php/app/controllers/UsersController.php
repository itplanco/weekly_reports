
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

        return ok($result);
    }
    
    /**
    * ユーザーを登録する
    */
    function post($data) {
        $id = $data['user_id'];
        if ($id) {
            return $this->badRequest("新規登録時にはIDを指定しないでください。");
        }

        $password = $data['password'];
        if (!$password) {
            return $this->badRequest("新規登録時にはパスワードを必ず指定してください。");
        }

        $this->service->insert($data);
        
        return ok();
    }
}
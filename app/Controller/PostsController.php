<?php

class PostsController extends AppController {
    public $helpers = array('Html', 'Form');
    
    public function index() {
        
        $params = array(
          'order' => 'modified desc',
            'limit' => 2
        );
        
       $this->set('posts', $this->Post->find('all', $params));
    }

    
    //詳細ページへのリンク
       public function view($id = null) {
           //Postのidにそれを代入
        $this->Post->id = $id;
        
        //idを読み込んでセットする
        $this->set('post', $this->Post->read());
    }
    
    
    //追加ページ
    public function add() {
        
        //postでデータが入ってきたら
        if ($this->request->is('post')) {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Success!');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }
    

   //編集ページ
    public function edit($id = null) {
               //Postのidにそれを代入
        $this->Post->id = $id;
        
        //編集フォームを開いたら
        if ($this->request->is('get')) {
            
            //指定されたidの編集ページをひらく
            $this->request->data = $this->Post->read();
        } else {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('success!');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }
    
    
    //削除ページ
        
//    public function delete($id) {
//        if ($this->request->is('get')) {
//            throw new MethodNotAllowedException();
//        }
//        if ($this->Post->delete($id)) {
//            $this->Session->setFlash('Deleted!');
//            $this->redirect(array('action'=>'index'));
//        }
//    
//    }
    
    
    public function delete($id) {
        
        //getメソッドできたら
        if ($this->request->is('get')) {
            
            //エラーを返す
            throw new MethodNotAllowedException();
        }
        if ($this->request->is('ajax')) {
            if ($this->Post->delete($id)) {
                
                //決まり文句
                $this->autoRender = false;
                $this->autoLayout = false;
                
                //idをjson形式で返す
                $response = array('id' => $id);
                $this->header('Content-Type: application/json');
                echo json_encode($response);
                exit();
            }
        }
        $this->redirect(array('action'=>'index'));
    }

    
}

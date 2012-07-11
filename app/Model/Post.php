<?php

class Post extends AppModel {
     public $hasMany = "Comment";
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
            'message' => '空じゃだめだし'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
}


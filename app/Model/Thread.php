<?php
/**
 * @author Utvecklarkollektivet
 * Class for Threads
 */
class Thread extends AppModel {

    public $name = 'Thread';
    public $hasMany = 'post';
    public $belongsTo = array('user', 'ForumCategory');

    /*
    Blir något fel här som jag inte har tid att kika på nu
    public $validate = array(
            'topic' => array(
                'required' => true,
                'allowEmpty' => false
            ),
            'content' => array(
                'required' => true,
                'allowEmpty' => false
            )
    );*/


}
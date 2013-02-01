<h1>Starta en tråd, BEHÖVS DEN HÄR VIEWN?</h1>
<?php
    echo $this->Form->create('Thread');
    echo $this->Form->input('topic');
    echo $this->Form->input('content', array('rows' => '3'));
    echo $this->Form->end('Starta tråd');
?>
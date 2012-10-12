<?php
class Tweet extends AppModel
{

    public function addTweets($json_data)
    {

        $json = json_decode($json_data);
        $tweets = $json->results;

        foreach ($tweets as $tweet) {
            $expanded_url = $tweet->entities->urls[0]->expanded_url;
            $text = $tweet->text;
            $id_str = $tweet->id_str;
            $data = array('Tweet' => array('expanded_url' => $expanded_url, 'text' => $text, 'id_str' => $id_str));
            $this->save($data);
        }


    }

    public function getMaxIdStr()
    {
        $users = $this->find('first', array('order' => array('id_str DESC')));
        return $users['Tweet']['id_str'];
    }

    
}

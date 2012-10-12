<?php
/**
 * AppShell file
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         CakePHP(tm) v 2.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Shell', 'Console');

/**
 * Application Shell
 *
 * Add your application-wide methods in the class below, your shells
 * will inherit them.
 *
 * @package       app.Console.Command
 */
class InstaShell extends AppShell {

	public $uses = array('Tweet');

    public function test()
    {
        //$test = $this->Tweet->find('all', array('order' => 'id_str DESC'));
        $test = $this->Tweet->getMaxIdStr();
        print_r($test);
    }

    public function get()
    {
        $q = $this->args[0] . '+AND+instagr.am';
        echo $api_url =
            "http://search.twitter.com/search.json?include_entities=t&since_id="
          . $this->Tweet->getMaxIdStr()
          . "&rpp=50&result_type=mixed&q="
            . rawurlencode($q);

        $json_data = file_get_contents($api_url);

        $this->Tweet->addTweets($json_data);

    }
    
}

<?php


/**
 * Description of DB
 *
 */
class DB {
    
    public $db; 
    
    public function __construct() {
        
        $config = require_once 'config.php';
        
        $this->db = new PDO('mysql:host='.$config['db']['host'].';dbname='.$config['db']['dbname'], 
                            $config['db']['user'], $config['db']['password']);
        
    }
    
    public function insertAllGitUsers( $Array, $table = 'user', $fields = ['github_id', 'github_login'] ) {
        
        $inserting = '';
        
        if (is_array(array_shift($Array))) {

            foreach ($Array as $array) {
            
                $inserting .= '(' . $array[0] . ',"' . $array[1] . '"),';
        
            }
        
            $inserting = substr($inserting, 0, -1);
            
        } else {

            $inserting = '(' . $Array[0] . ',"' . $Array[1] . '")';

        }
        
        $query = 'INSERT INTO ' . $table . ' ( ' . implode(',', $fields) . ') VALUES ' . $inserting;

        $req = $this->db->prepare($query);
        
        return $req->execute();
    
    } 
}

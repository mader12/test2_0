<?php


/**
 * Description of Git
 *
 * @author mad
 */
class Git {
    
    const git_api_count_users = 30;
    
    public function getUsers ($begin_user = 0) {
     
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/users?since=' . $begin_user); 
        curl_setopt($ch, CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP Bot test mader12/test2_0'); 
        $data = curl_exec($ch); 
        $data = json_decode($data);
       
        curl_close($ch); 
        return $data;
        
    }
    
    public function usersToDb($start = 0, $end = 100) {
        
        $users = [];
        $to_db_users = [];
        for ($i = $start; $i < $end; $i = $i + self::git_api_count_users) {
            
            $users = array_merge($users, $this->getUsers($i));
            
        }
        
        foreach ($users as $u => $v) {
            
            if ($v->id <= $end) {
                
                $to_db_users [$v->id] = [$v->id, $v->login];
                        
            }
        }
        
        return $this->toDB ($to_db_users );
        
    }
    
    public function toDB ($users) {
        
        $db = new DB();
        
        return $db->insertAllGitUsers($users);
        
    }
}

<?php


    if (file_exists($this->getLogoutPath())) 
        {$auth=explode("/",file_get_contents($this->getLogoutPath()));$user=$auth[0];$pass=$auth[1];}
    else return false;
    $res=$this->get("http://{$user}:{$pass}@twitter.com/statuses/followers.xml",true);

    $cursorNext = array();
    $cursorNext[0] = -1;
    do {
    if($cursorNext[0] == -1 || $cursorNext[0] !=0)
    {
        $res = $this->get("http://{$user}:{$pass}@twitter.com/statuses/followers.xml?cursor={$cursorNext[0]}",true);

    } else {
        break;
    }

    if ($this->checkResponse('responce_ok_followers',$res))
        $this->updateDebugBuffer('responce_ok_followers',"http://user:pass@twitter.com/statuses/followers.xml?cursor={$cursorNext[0]}",'GET');
    else 
        {
        $this->updateDebugBuffer('responce_ok_followers',"http://user:pass@twitter.com/statuses/followers.xml?cursor={$cursorNext[0]}",'GET',false);
        $this->debugRequest();
        $this->stopPlugin();
        return false;   
        }

        $tempres .= $res;
        $cursorNext = $this->getElementDOM($res,'//users_list/next_cursor');

    }while(1);

    $contacts = $this->getElementDOM($tempres,'facebooklive');
    return $contacts;   
    
    
    ?>
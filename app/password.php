<?php
namespace App;

class password{
    
    public function check($password, $isAdmin = false){

        if($isAdmin){
            if(strlen($password)>=10){
              return $this->checkletter($password);
            }
        }else{
              return $this->checkletter($password);
        }
         return false;
        
    }
    public function checkletter($password){

        if(preg_match_all('/[A-Z]/',$password)>0 && preg_match_all('/[a-z]/',$password)>0 ){
            return true;
        }
        return false;
    }
    
  
}





?>
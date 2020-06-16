<?php
class Main_model extends CI_Model
{
   function insert_users($name,$email,$task,$status){
       $query=$this->db->query("
       INSERT INTO users(name,email,task,status)
       VALUES ('{$name}','{$email}','{$task}','{$status}')
       ");
   }

   function get_users($options , $limit , $offset){

       $sql = "
       SELECT *
       FROM users
       ";
       $condition = "";
       if (!empty($options['where'])){
           $condition .= "WHERE task='{$options['where']}'";
       }

  if (!empty($options['sort_by'])){
      $condition .= " ORDER BY {$options['sort_by']} {$options['order']}";
  }
       $condition .= " LIMIT {$offset}, {$limit}";


        $all=$sql.$condition;
       $query=$this->db->query($all);
    return $query;

   }

   function get_by_id($id){
       $query=$this->db->query("
       SELECT * 
       FROM users
       WHERE id='{$id}'
       ");
       return $query->result_array();
   }
   function update_task_id($task,$id)
   {
       $query = $this->db->query("
       UPDATE users
       SET task='{$task}'
       WHERE id='{$id}'
       ");
   }
       function set_completed($completed,$id){
           $query=$this->db->query("
           UPDATE users
           SET completed='{$completed}'
           WHERE id='{$id}'
           ");
       }

       function select_login_password($username,$password){
       $query = $this->db->query("
       SELECT *
       FROM users_password
       WHERE username='{$username}' AND password='{$password}'
       ");
       return $query->result_array();
       }

       function edit_task($task,$id){
       $query = $this->db->query("
       UPDATE users
       SET task='{$task}'
       WHERE id='{$id}' 
       ");
       }

       function edit($edit,$id)
       {
           $query = $this->db->query("
       UPDATE users
       SET edit='{$edit}'
       WHERE id='{$id}'
       ");
       }

       function password($password){
        $query = $this->db->query("
        INSERT INTO users_password(username,password)
        VALUES ('admin','{$password}')
        ");
       }




}




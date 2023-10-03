<?php
require_once 'app/models/model.php';

class UsersController{
  private $model;
  public function __CONSTRUCT(){
    $this->model = new Model();
  }

  public function Index(){
    require_once "lib/check.php";
    if (in_array(1, $permissions)) {
      $fields = array("id","date","name","email","status","action");
      $url = '?c=Users&a=Data';
      require_once 'app/components/layout.php';
      require_once 'app/components/index.php';
    } else {
      $this->model->redirect();
    }
  }

  public function New(){
    require_once "lib/check.php";
    if (in_array(1, $permissions)) {
      $a = 'Edit';
      require_once 'app/views/users/new.php';
    } else {
      $this->model->redirect();
    }
  }

  public function Data(){
    header('Content-Type: application/json');
    require_once "lib/check.php";
    if (in_array(1, $permissions)) {
      $result = array();
      foreach ($this->model->list("id,createdAt as date,username as name,email,if(status=1,'Enabled','Disabled') as status", "users") as $k => $v) {
          $b1 = ($k == 'status' and $v != 1) ? "<a href='' class='text-blue-500 hover:text-blue-700 float-right status mx-1' data-id='$v->id' data-status='1'><i class='ri-toggle-line'></i> Enable</a>" : "<a href='' class='text-red-500 hover:text-red-700 float-right status mx-1' data-id='$v->id' data-status='0'><i class='ri-toggle-fill'></i> Disable</a>";
          $b2 = "<a href='?c=Users&a=Profile&id=$v->id' class='text-blue-500 hover:text-blue-700 float-right mx-1'> <i class='ri-pencil-line'></i> Edit</a>";
          $result[] = (array)$v + ['action' => "$b1 $b2"];
      }
      echo json_encode($result);
    } else {
      $this->model->redirect();
    }
  }

  public function Profile(){
    require_once "lib/check.php";
    if (in_array(1, $permissions) and isset($_REQUEST["id"])){
      $filters = "and id = " . $_REQUEST['id'];
      $id = $this->model->get('*','users',$filters);
      $a = 'Profile';
      require_once 'app/components/layout.php';
      require_once 'app/views/users/profile.php';
    } else {
      $this->model->redirect();
    }
  }

  public function Status(){
    require_once "lib/check.php";
    if (in_array(1, $permissions)) {
      $item = new stdClass();
      $item->status = $_REQUEST['status'];
      $this->model->update('users',$item,$_REQUEST['id']);
    } else {
      $this->model->redirect();
    }
  }

  public function Save(){
    require_once "lib/check.php";
    if (in_array(1, $permissions)) {
      $item = new stdClass();
      $item->username=$_REQUEST['name'];
      $item->email=$_REQUEST['email'];
      $item->lang='en';
      $item->password=$_REQUEST['newpass'];
      $item->type=$_REQUEST['type'];
      $item->company=$_REQUEST['company'];
      $item->phone=$_REQUEST['phone'];
      $item->city=$_REQUEST['city'];
      $item->products= (isset($_REQUEST['products'])) ? json_encode($_REQUEST['products']) : '[]';
      $cpass=$_REQUEST['cpass'];
      if ($cpass != '' and $cpass != $item->password) {
        echo "Las contraseñas no coinciden";
      } else {
        $item->password = password_hash($item->password, PASSWORD_DEFAULT);
        if (!empty($_REQUEST['userId'])) {
          $item->id = $_REQUEST['userId'];
          $this->model->update('users',$item,$_REQUEST['userId']);
          echo $item->id;
        } else {
          $id = $this->model->save('users',$item);
          echo $id;
        }
      }
    } else {
      $this->model->redirect();
    }
  }

  public function SavePermissions(){
    require_once "lib/check.php";
    if (in_array(1, $permissions)) {
      $item = new stdClass();
      $item->permissions = $_REQUEST['permissions'];
      $this->model->update('users',$item,$_REQUEST['userId']);
    }
  }

}
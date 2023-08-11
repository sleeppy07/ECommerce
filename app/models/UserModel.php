<?php
/*
 * Kế thừa từ class Model
 *
 * */
class UserModel extends Model {
    
    function tableFill(){
        return 'users';
    }
 
     function fieldFill(){
         return '*';
     }
 
     function primaryKey(){
         return 'Id';
     }
 
     public function UserCreate($Username, $Email, $PhoneNumber, $Password, $Gender, $DOB)
     {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->orWhere('Username', '=', $Username)->orWhere('Email', '=', $Email)->orWhere('PhoneNumber', '=', $PhoneNumber)->first();
        if($check != NULL){
            echo "User đã tồn tại";
            return; 
        } 
        $Fullname = $Username;
        $Avatar = 'https://static.vecteezy.com/system/resources/previews/009/734/564/original/default-avatar-profile-icon-of-social-media-user-vector.jpg';
        $Cover = 'https://atiinc.org/wp-content/uploads/2017/01/cover-default.jpg';
        $data = [
            'Username' => $Username,
            'Password' => $Password,
            'Fullname' => $Fullname,
            'Avatar' => $Avatar,
            'Cover' => $Cover,
            'Email' => $Email,
            'PhoneNumber' => $PhoneNumber,
            'Bio' => NULL,
            'Address' => NULL,
            'Gender' => $Gender,
            'DOB' => $DOB
        ];
        $this->db->table($tableName)->insert($data);
        return $this->db->lastId();

     }

     public function UserUpdate($Id, $Username, $Email, $PhoneNumber, $Password, $Gender, $DOB, $Avatar, $Cover, $Fullname, $Bio, $Address)
     {
        $tableName = $this->tableFill();
        $check = $this->db->table($tableName)->where('Id' , '=' , $Id)->first();
        if($check == NULL){
            echo "User không tồn tại";
            return; 
        } 
        $data = [
            'Username' => $Username ? $Username : $check->Username,
            'Password' => $Password ? $Password : $check->Password,
            'Fullname' => $Fullname ? $Fullname : $check->Fullname,
            'Avatar' => $Avatar ? $Avatar : $check->Avatar,
            'Cover' => $Cover ? $Cover : $check->Cover,
            'Email' => $Email ? $Email : $check->Email,
            'PhoneNumber' => $PhoneNumber ? $PhoneNumber : $check->PhoneNumber,
            'Bio' => $Bio ? $Bio : $check->Bio,
            'Address' => $Address ? $Address : $check->Address,
            'Gender' => $Gender ? $Gender : $check->Gender,
            'DOB' => $DOB ? $DOB : $check->DOB
        ];
        $this->db->table($tableName)->where('Id' , '=' , $Id)->update($data);
        return $check;
     }

     public function UserDetail($id){
        $tableName = $this->tableFill();
        $data = $this->db->table($tableName)->where('Id', '=', $id)->first();
         return $data;
     }

     public function UserList($Username, $Email, $PhoneNumber, $StartDate, $EndDate, $Page, $PageSize)
     {
        $tableName = $this->tableFill();
        $data = $this->db->table($tableName);
        if (!empty($Username)){
            $data = $data->whereLike('Username', $Username);
        }
        if (!empty($Email)){
            $data = $data->whereLike('Email', $Email);
        }
        if (!empty($PhoneNumber)){
            $data = $data->whereLike('PhoneNumber', $PhoneNumber);
        }
        if (!empty($StartDate) && !empty($EndDate)){
            $data = $data->where('CreatedDate','>', $StartDate)->where('CreatedDate','<',$EndDate);
        }
        $data = $data->limit($Page, $PageSize)->orderBy('CreatedDate', 'DESC');
        return $data->get();
     }
}

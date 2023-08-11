<?php
class RoleModel extends Model {
    
    function tableFill(){
        return 'roles';
    }
 
     function fieldFill(){
        return '*';
     }
 
     function primaryKey(){
         return 'Id';
     }

     //Roles
     public function ListRole()
     {
        $tableName = $this->tableFill();
        $data = $this->db->table($tableName);
        return $data->get();
     }

     //UserRoles
     public function CheckUserRole($UserId, $RoleId)
     {
        $data = $this->db->table('userroles')->where('UserId' , ' = ', $UserId)->where('RoleId' , ' = ', $RoleId)->first();
        if($data) return true;
        else return false;
     }

     public function AddUserRole($UserId, $RoleId)
     {
        $check = $this->db->table('userroles')->where('UserId', '=', $UserId)->where('RoleId', '=', $RoleId)->first();
        if($check != null)
        {
            echo "User have this Role";
            return;
        }
        $data = [
            'UserId' => $UserId,
            'RoleId' => $RoleId,
        ];
        $this->db->table('userroles')->insert($data);
        return $this->db->lastId();
     }

     public function DeleteUserRole($UserId, $RoleId)
     {
        $check = $this->db->table('userroles')->where('UserId', '=', $UserId)->where('RoleId', '=', $RoleId)->first();
        if($check == null)
        {
            echo "User not have this Role";
            return;
        }
        $result = $this->db->table('userroles')->where('UserId', '=', $UserId)->where('RoleId', '=', $RoleId)->delete();
        
        if($result) echo 'Detele Successful.';
        else echo 'Delete Fail.';
     }

     public function ListUserRole($Username, $Fullname, $Email, $PhoneNumber, $Role, $Page, $PageSize)
     {
        $tableUser = 'users';
        $tableRole = 'roles';
        $tableUserRole = 'userroles';
        $relationshipUserAndUserRole = $tableUser . '.Id' . ' = ' . $tableUserRole . '.UserId';
        $relationshipRoleAndUserRole = $tableRole . '.Id' . ' = ' . $tableUserRole . '.RoleId';
        $data = $this->db->select($tableUser.'.Id, '.$tableUser.'.Username, '.$tableUser.'.Fullname, '.$tableUser.'.Email, '.$tableUser.'.PhoneNumber, '.'MAX('.$tableRole.'.Id) AS RoleId')
                            ->table($tableUser)
                            ->join($tableUserRole, $relationshipUserAndUserRole)
                            ->join($tableRole, $relationshipRoleAndUserRole)
                            ->groupBy($tableUser.'.Id, '.$tableUser.'.Username, '.$tableUser.'.Fullname, '.$tableUser.'.Email, '.$tableUser.'.PhoneNumber');
        if (!empty($Username)){
            $data = $data->whereLike('Username', $Username);
        }
        if (!empty($Fullname)){
            $data = $data->whereLike('Fullname', $Fullname);
        }
        if (!empty($Email)){
            $data = $data->whereLike('Email', $Email);
        }
        if (!empty($PhoneNumber)){
            $data = $data->whereLike('PhoneNumber', $PhoneNumber);
        }        
        if (!empty($Role)){
            $data = $data->where('RoleId', ' = ', $Role);
        }
        $data = $data->limit($Page, $PageSize);
        return $data->get();
     }

}
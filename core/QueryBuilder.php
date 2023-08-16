<?php
trait QueryBuilder{

    public $tableName = '';
    public $where = '';
    public $operator = '';
    public $selectField = '*';
    public $limit = '';
    public $orderBy = '';
    public $groupBy = '';
    public $innerJoin = '';

    public $paramBindingStr = '';

    public function table($tableName){
        $this->tableName = $tableName;
        return $this;
    }

    public function where($field, $compare, $value){
        if (empty($this->where)){
            $this->operator = ' WHERE ';
        }else{
            $this->operator = ' AND ';
        }
        
        $this->where.="$this->operator $field $compare '$value'";

        return $this;
    }

    public function orWhere($field, $compare, $value){
        if (empty($this->where)){
            $this->operator = ' WHERE ';
        }else{
            $this->operator = ' OR ';
        }
        $this->where.="$this->operator $field $compare '$value'";

        return $this;
    }

    public function whereLike($field, $value){

        if (empty($this->where)){
            $this->operator = ' WHERE ';
        }else{
            $this->operator = ' AND ';
        }
        $this->where.="$this->operator $field LIKE '$value'";

        return $this;
    }

    public function select($field){
        $this->selectField = $field;
        return $this;
    }
  

    public function limit($offset, $number = ''){
        if (!empty($number))
        {
            $this->limit = " LIMIT $offset , $number ";

        }
        else { $this->limit = " LIMIT $offset ";
        }
        return $this;
    }

    /*ORDER BY id DESC
    $this->db->orderBy('id', 'DESC')
    $this->db->orderBy('id ASC, name DESC');
    */

    public function groupBy($field){
        $fieldArr = array_filter(explode(',', $field));
        if (!empty($fieldArr) && count($fieldArr) >= 2) {
            // SQL GROUP BY multi
            $this->groupBy = " GROUP BY " . implode(', ', $fieldArr);
        } else {
            $this->groupBy = " GROUP BY " . $field . " ";
        }

        return $this;
    }

    public function orderBy($field, $type){
        $fieldArr = array_filter(explode(',', $field));
        if (!empty($fieldArr) && count($fieldArr)>=2){
            //SQL order by multi
            $this->orderBy = " ORDER BY ".implode(', ', $fieldArr);
        }else{
            $this->orderBy = " ORDER BY ".$field." ".$type." ";
        }

        return $this;
    }

    public function get(){
        $sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->innerJoin $this->where $this->groupBy $this->orderBy $this->limit";
        $sqlQuery = trim($sqlQuery);

        $query = $this->query($sqlQuery);

        //Reset field
        $this->resetQuery();

        if (!empty($query)){

            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    //Inner join
    public function join($tableName, $relationship){
        $this->innerJoin.=' JOIN '.$tableName.' ON '.$relationship.' ';
        return $this;
    }

    //Insert
    public function insert($data){
        $tableName = $this->tableName;
        $insertStatus = $this->insertData($tableName, $data);
        return $insertStatus;
    }

    //LastId
    public function lastId(){
        return $this->lastInsertId();
    }

    //Update
    public function update($data){
        $whereUpdate = str_replace('WHERE', '', $this->where);
        $whereUpdate = trim($whereUpdate);
        $tableName = $this->tableName;
        $statusUpdate = $this->updateData($tableName, $data, $whereUpdate);
        return $statusUpdate;
    }

    //Delete
    public function delete(){
        $whereDelete = str_replace('WHERE', '', $this->where);
        $whereDelete = trim($whereDelete);
        $tableName = $this->tableName;

        $statusDelete = $this->deleteData($tableName, $whereDelete);
        return $statusDelete;
    }

    public function first(){
        $sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->where $this->limit";

        $query = $this->query($sqlQuery);

        //Reset field
        $this->resetQuery();

        if (!empty($query)){

            return $query->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function BindParams($params)
    {
        $paramArr = array_filter(explode(',', $params));

        $paramBindings = array();
        for ($i = 1; $i <= count($paramArr); $i++) {
            $paramBindings[] = ":param$i";
        }
        if(!empty($fielparamArrdArr) && count($paramArr)>=2)
            $this->paramBindingStr = implode(', ', $paramBindings);
        else $this->paramBindingStr = reset($paramBindings);
        return $this;
    }

    public function executeProcedure($procedureName, $params) {

        $paramArr = array_filter(explode(',', $params));
        $sqlQuery = "CALL $procedureName($this->paramBindingStr)";

        $query = $this->execute($sqlQuery, $paramArr);

        $this->resetQuery();

        if (!empty($query)){

            return true;
        }
        return false;

    }


    public function resetQuery(){
        $this->tableName = '';
        $this->where = '';
        $this->operator = '';
        $this->selectField = '*';
        $this->limit = '';
        $this->orderBy = '';
        $this->innerJoin = '';
        $this->groupBy = '';
        $this->paramBindingStr = '';
    }

}
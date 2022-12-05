<?php
trait QueryBuilder {
    public $dataVar = [];
    public $tableName = '';
    public $where = '';
    public $selectField = '*';
    public $limit = '';
    public $orderBy = '';
    public $innerJoin = '';

    // TODO Reset các biến trong class
    private function resetQuery(){
        $this->dataVar = [];
        $this->tableName = '';
        $this->where = '';
        $this->selectField = '*';
        $this->limit = '';
        $this->orderBy = '';
        $this->innerJoin = '';
    }

    /**
    * TODO lấy bảng
    * ? $this->db->table($table)
    * @param table: tên bảng
    */
    public function table($tableName, $alias = ''){
        if(!empty($alias)){
            $this->tableName = $tableName . ' as ' . $alias;
        } else {
            $this->tableName = $tableName;
        }
        return $this;
    }

    /**
    * TODO điều kiện và
    * TODO điều kiện hoặc
    * TODO điều kiện like
    * ? $this->db->table($table)->where($field, $compare, $value)
    * @param compare: >, <, >=, <=, =, !=
    * @param value: giá trị so sánh
    * @param field: tên trường
    */
    public function where($field, $compare, $value){
        if(empty($compare) && empty($value)){
            $this->where = " WHERE $field";
            return $this;
        }
        $bind = explode('.', $field);
        if(count($bind) > 1){
            $bind = $bind[1];
        } else {
            $bind = $field;
        }
        if(empty($this->where)){
            $this->where = " WHERE $field $compare :$bind";
        }else{
            $this->where .= " AND $field $compare :$bind";
        }
        $this->dataVar[$bind] = $value;
        return $this;
    }
    public function orWhere($field, $compare, $value){
        if(empty($this->where)){
            $this->where = " WHERE $field $compare :$field";
        }else{
            $this->where .= " OR $field $compare :$field";
        }
        $this->dataVar[$field] = $value;
        return $this;
    }
    public function whereLike($field, $value){
        if(empty($this->where)){
            $this->where = " WHERE $field LIKE :$field";
        }else{
            $this->where .= " AND $field LIKE :$field";
        }
        $this->dataVar[$field] = '%'.$value.'%';
        return $this;
    }

    /**
    * TODO lấy dữ liệu
    * ? $this->db->select($field)
    * @param field: tên trường cần lấy
    */
    public function select($field = '*'){
        $this->selectField = $field;
        return $this;
    }

    /**
    * TODO giới hạn
    * ? $this->db->table($table)->limit($number, $offset)
    * @param number: số lượng
    * @param offset: bắt đầu từ vị trí
    */
    public function limit($number, $offset = 0){
        $this->limit .= " LIMIT $offset, $number";
        return $this;
    }

    /**
    * TODO sắp xếp
    * ? $this->db->table($table)->orderBy($field, $type)
    * @param field: tên trường
    * @param type: ASC, DESC
    */
    public function orderBy($field, $type = 'ASC'){
        $fieldArr = explode(',', $field);
        if(!empty($fieldArr) && count($fieldArr) > 1){
            $this->orderBy = "ORDER BY ".implode(', ', $fieldArr);
        } else{
            $this->orderBy = "ORDER BY $field $type";
        }
        return $this;
    }

    /**
     * TODO group by
     * ? $this->db->table($table)->groupBy($field)
     * @param field: tên trường
     */
    public function groupBy($field){
        $this->groupBy = "GROUP BY $field";
        return $this;
    }
    
    /**
    * TODO nối bảng
    * TODO nối bảng bên trái
    * TODO nối bảng bên phải
    * ? $this->db->table($table)->join (tableName, condition)
    * @param table: tên bảng
    * @param relationship: quan hệ bảng
    */
    public function join($tableName, $alias = '',  $relationship){
        if(!empty($alias)){
            $this->innerJoin .= " INNER JOIN $tableName as $alias ON $relationship";
        } else {
            $this->innerJoin .= " INNER JOIN $tableName ON $relationship";
        }
        return $this;
    }
    public function leftJoin($tableName, $alias = '', $relationship){
        if(!empty($alias)){
            $this->innerJoin .= " LEFT JOIN $tableName as $alias ON $relationship";
        } else {
            $this->innerJoin .= " LEFT JOIN $tableName ON $relationship";
        }
        return $this;
    }
    public function rightJoin($tableName, $alias = '', $relationship){
        if(!empty($alias)){
            $this->innerJoin .= " RIGHT JOIN $tableName as $alias ON $relationship";
        } else {
            $this->innerJoin .= " RIGHT JOIN $tableName ON $relationship";
        }
        return $this;
    }
    
    /**
    * TODO thêm dữ liệu
    * ? $this->db->table($table)->insert($data)
    * @param data: mảng dữ liệu
    */
    public function insert($data){
        $tableName = $this->tableName;
        $insertStatus = $this->insertData($tableName, $data);
        return $insertStatus;
    }

    /**
     *  TODO đếm số bản ghi
     *  ? $this->db->table($table)->count()
     *  @param table: tên bảng
     */ 
    public function count(){
        $tableName = $this->tableName;
        $count = $this->countData($tableName);
        return $count;
    }

    /**
     * TODO lấy id vừa thêm
     * ? $this->db->lastId()
     * @return int
     */
    public function lastID(){
        $lastID = $this->lastInsertId();
        return $lastID;
    }

    /**
    * TODO cập nhật dữ liệu
    * ? $this->db->table($table)->update($data)
    * @param data: mảng dữ liệu
    */
    public function update($data){
        $whereUpdate = str_replace('WHERE', '', $this->where);
        $whereUpdate = trim($whereUpdate);
        $tableName = $this->tableName;
        $updateStatus = $this->updateData($tableName, $data, $whereUpdate);
        return $updateStatus;
    }

    /**
    * TODO  xóa dữ liệu
    * ? $this->db->table(name)->where(field, compare, value)->delete()
    * @return true/false
    */
    public function delete(){
        $whereUpdate = str_replace('WHERE', '', $this->where);
        $whereUpdate = trim($whereUpdate);
        $tableName = $this->tableName;
        $deleteStatus = $this->deleteData($tableName, $whereUpdate);
        return $deleteStatus;
    }

    /**
    * TODO lấy tất cả dữ liệu
    * ? $this->db->table($table)->get()
    * @return array/false
    */
    public function get(){
        $sql = "SELECT $this->selectField FROM $this->tableName $this->innerJoin $this->where $this->groupBy $this->orderBy $this->limit";
        $sql = trim($sql);
        $data = $this->query($sql, $this->dataVar)->fetchAll(PDO::FETCH_ASSOC);

        $this->resetQuery();

        if($data) return $data;
        return false;
    }

    /**
    * TODO lấy tất cả dữ liệu
    * ? $this->db->table($table)->frist()
    * @return array/false
    */
    public function first(){
        $sql = "SELECT $this->selectField FROM $this->tableName $this->innerJoin $this->where $this->groupBy $this->orderBy $this->limit";
        $sql = trim($sql);
        $data = $this->query($sql, $this->dataVar)->fetch(PDO::FETCH_ASSOC);

        $this->resetQuery();

        if($data) return $data;
        return false;
    }

    /**
     * TODO Sum dữ liệu
     * ? $this->db->table($table)->sum($field)  
     * @param field: tên trường 
     */
    public function sum($field){
        $sql = "SELECT SUM($field) as sum FROM $this->tableName $this->innerJoin $this->where $this->groupBy $this->orderBy $this->limit";
        $sql = trim($sql);
        $data = $this->query($sql, $this->dataVar)->fetch(PDO::FETCH_ASSOC);

        $this->resetQuery();

        if($data) return $data['sum'];
        return false;
    }

    /**
     * TODO Tìm kiểm dữ liệu
     * ? $this->db->table($table)->search($field, $keyword)
     * @param field: tên trường
    */

    public function search($keyword){
        $sql = "SELECT $this->selectField FROM $this->tableName $this->innerJoin $this->where COLLATE UTF8_GENERAL_CI LIKE CONCAT('%', LOWER(CONVERT('$keyword', BINARY)), '%') $this->groupBy $this->orderBy $this->limit";
        $sql = trim($sql);
        $data = $this->query($sql, $this->dataVar)->fetchAll(PDO::FETCH_ASSOC);

        $this->resetQuery();

        if($data) return $data;
        return false;
    }
}
?>
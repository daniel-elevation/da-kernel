<?php
class query{

    public $db;
    public $query;
    public $result;
    public $fields;
    public function __construct($db, $fields){
        $this->set_db($db);
        $this->set_fields($fields);

        if($fields['query_type'] == 'pdo'){
            // need: query
            $this->make_query();
        }
        else if($fields['query_type'] == 'select'){
            // need: table, select_fields, where_conditions + optional (extra_clause)
            //dump_data($this->get_fields());
            $this->make_select_query();
        }

    }

    public function make_select_query(){
        $db = $this->get_db();
        $fields = $this->get_fields();

        if( isset($fields['extra_clause']) ){
            $result = $db->select(
                $fields['table'],
                $fields['select_fields'],
                $fields['where_conditions'],
                $fields['extra_clause'],
            )->results();
        }
        else{
            $result = $db->select(
                $fields['table'],
                $fields['select_fields'],
                $fields['where_conditions'])->results();
        }


        $this->set_result($result);
    }

    public function make_query(){
        $fields = $this->get_fields();
        $q = $fields['query'];
        $db = $this->get_db();
        $result = $db->pdoQuery($q)->results();
        $this->set_result($result);
    }

    /**
     * @param mixed $db
     */
    public function set_db($db)
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    public function get_db()
    {
        return $this->db;
    }

    /**
     * @param mixed $query
     */
    public function set_query($query)
    {
        $this->query = $query;
    }

    /**
     * @return mixed
     */
    public function get_query()
    {
        return $this->query;
    }

    /**
     * @param mixed $result
     */
    public function set_result($result)
    {
        $this->result = $result;
    }

    /**
     * @return mixed
     */
    public function get_result()
    {
        return $this->result;
    }

    /**
     * @param mixed $fields
     */
    public function set_fields($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return mixed
     */
    public function get_fields()
    {
        return $this->fields;
    }






}
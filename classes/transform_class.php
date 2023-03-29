<?php

class transform
{

    public $data;
    public $headers;
    public $mode;
    public $return_data;
    public $request;

    public function __construct($data, $headers, $request, $mode = 'data_tables')
    {
        $this->set_data($data);
        $this->set_headers($headers);
        $this->set_request($request);
        $this->set_mode($mode);

        $mode = $this->get_mode();

        switch ($mode) {
            case 'data_tables':
                $this->set_data_tables();
                break;
            case 'assignm':
                echo "no";
                break;
            default:
                echo "default";
        };
    }

    public function set_data_tables(){

        $request = $this->get_request();

        $activity_section_types = array("SpotCheckActivity","CodeActivity", "QuizActivity", "ExerciseActivity", "LabActivity");

        $ret = '<table id="kernel_data_table">';
        $ret.= '<thead>';

        foreach($this->get_headers() as $k => $v){
            $ret.= "<th>" . $v . "</th>";
        }
        $ret.= '</thead>';
        $ret.= '<tbody>';

        foreach($this->get_data() as $data){
            $ret.= "<tr>";
            foreach($this->get_headers() as $k => $v) {

                if($request == 'modules' && $k == 'name'){
                    $this_link = WEB_PATH . "index.php?q=lessons_module&id=" . $data['id'];
                    $ret.= "<td><a href='".$this_link."'>".$data[$k]."</a></td>";
                }
                else if($request == 'lessons_module' && $k == 'name'){
                    $this_link = WEB_PATH . "index.php?q=activities_lesson&id=" . $data['id'];
                    $ret.= "<td><a href='".$this_link."'>".$data[$k]."</a></td>";
                }
                else if($request == 'activities_lesson' && $k == 'id'){
                    if( in_array($data['type'], $activity_section_types) ){
                        $this_link = WEB_PATH . "show_exercise.php?q=". $data['id'];
                    }
                    else $this_link = WEB_PATH . "show_activity.php?q=". $data['id'];
                    $ret.= "<td><a target='blank' href='".$this_link."'>".$data[$k]."</a></td>";
                }
                else if($request == 'activities_lesson' && $k == 'text'){
                    $ret.= "<td>".substr($data[$k], 0, 100)."...</td>";
                }
                else if($request == 'all_activities' && $k == 'id'){
                    if( in_array($data['type'], $activity_section_types) ){
                        $this_link = WEB_PATH . "show_exercise.php?q=". $data['id'];
                    }
                    else $this_link = WEB_PATH . "show_activity.php?q=". $data['id'];
                    $ret.= "<td><a target='blank' href='".$this_link."'>".$data[$k]."</a></td>";
                }
                else if($request == 'all_exercises' && $k == 'id'){
                    $this_link = WEB_PATH . "show_exercise.php?single=". $data['id'];
                    $ret.= "<td><a target='blank' href='".$this_link."'>".$data[$k]."</a></td>";
                }
                else if($request == 'all_activities' && $k == 'text'){
                    $ret.= "<td>".substr($data[$k], 0, 100)."...</td>";
                }
                else if($request == 'syllabi' && $k == 'id'){
                    //$name = urlencode($data['name']);
                    //$this_link = WEB_PATH . "index.php?q=syllabus_lessons&name='.$name .'&id=" . $data['id'];
                    $this_link = WEB_PATH . "index.php?q=syllabus_lessons&id=" . $data['id'];

                    $ret.= "<td><a href='".$this_link."'>".$data[$k]."</a></td>";
                }
                else if($request == 'syllabus_lessons' && $k == 'id'){
                    $this_link = WEB_PATH . "index.php?q=activities_lesson&id=" . $data['id'];
                    $ret.= "<td><a target='blank' href='".$this_link."'>".$data[$k]."</a></td>";
                }
                else{
                    if(isset($data[$k]) && $data[$k]!= '' ){
                        $ret.= "<td>" . $data[$k] . "</td>";
                    }
                    else $ret.= "<td>&nbsp;</td>";

                }

            }
            $ret.= "</tr>";

        }
        $ret.= '</tbody>';

        $this->set_return_data($ret);
    }

    /**
     * @param mixed $data
     */
    public function set_data($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function get_data()
    {
//        if($key = '')
//        else{
//            return $this->data[$key];
//        }
        return $this->data;
    }

    /**
     * @param mixed $headers
     */
    public function set_headers($headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return mixed
     */
    public function get_headers()
    {
        return $this->headers;
    }

    /**
     * @param mixed $mode
     */
    public function set_mode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * @return mixed
     */
    public function get_mode()
    {
        return $this->mode;
    }

    /**
     * @param mixed $return_data
     */
    public function set_return_data($return_data)
    {
        $this->return_data = $return_data;
    }

    /**
     * @return mixed
     */
    public function get_return_data()
    {
        return $this->return_data;
    }

    /**
     * @param mixed $request
     */
    public function set_request($request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function get_request()
    {
        return $this->request;
    }

    /**
     * @param mixed $module
     */





}
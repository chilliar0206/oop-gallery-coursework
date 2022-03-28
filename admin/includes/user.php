<?php 

class User {

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    
    public static function find_all_users() {
        return self::find_this_query("SELECT * FROM users");
    }
    
    public static function find_user_by_id($user_id) {
        $the_result_array = self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1");

        // if(!empty($the_result_array)) {
            
        //     $first_item = array_shift($the_result_array);
            
        //     return $first_item;

        // } else {
        //     return false;
        // }

        // ternary operator syntax of the above commented code. (Return first if true, second if false)
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function find_this_query($sql) {
        global $database;

        $result_set = $database->query($sql);
        $user_object_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $user_object_array[] = self::instantiation($row);
        }
        //returns an array of user objects
        return $user_object_array;
    }

    public static function instantiation($the_record) {
        $user_object = new self;

        foreach ($the_record as $the_attribute => $value) {
            if($user_object -> has_the_attribute($the_attribute)) {
                $user_object -> $the_attribute = $value;
            }
        }

        return $user_object;
    }

    private function has_the_attribute($the_attribute) {
        
        $object_properties = get_object_vars($this);

        return array_key_exists($the_attribute, $object_properties);

    }
}


?>
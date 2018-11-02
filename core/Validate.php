<?php 

class Validate {
    private $_passed=false, $_errors=[];

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    public function check($source, $items=[]) {
        $this->_errors = [];
        foreach($items as $item =>$rules) {
            $item = Input::sanitize($item);
            $display = $rules['display'];
            foreach($rules as $rule => $rule_value) {
                $value = Input::sanitize(trim($source[$item]));

                if($rule === 'required' && empty($value)) {
                    $this->addError(["{$display} is required", $item]);
                } elseif(!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if(strlen($value) < $rule_value) {
                                $this->addError(["{$display} must be a minimum of {$rule_value} characters.", $item]);
                            }
                            break;
                        case 'matches':
                            if($value != $source[$rule_value]) {
                                $matchDisplay = $items[$rule_value['display']];
                                $this->addError(["{$matchDisplay} and {$display} must match.", $item]); 
                            }
                            
                            break;

                        case 'unique':
                            $check = $this->_db->query("SELECT {$item} FROM {$rule_value} WHERE {$item} =?", [$value]);
                            // dnd($check);
                            // dnd($check->count());
                            if($check->count()) {
                                $this->addError(["{$display} already exists. Please choose another {$display}", $item]);
                            }
                            break;
                        case 'valid_email':
                            if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $this->addError(["{$display} must be a valid email address.", $item]);
                            }
                        break;
                            

                    }
                    // dnd($rule);
                }
            }
        }
        if(empty($this->_errors)) {
            $this->_passed = true;
        }
        return $this;
    }


    public function addError($error) {
        $this->_errors[] = $error;
        if(empty($this->_errors)) {
            $this->_passed = true;
        } else {
            $this->_passed = false;
        }

    }

    public function errors() {
        return $this->_errors;
    }

    public function passed() {
        return $this->_passed;
    }

    public function displayErrors() {
        // dnd($this->_error);
        $html = '<ul class="bg-danger">';
        foreach($this->_errors as $error) {
            if(is_array($error)) {
                $html .= '<li class="text-white">'.$error[0].'</li>';
                $html .= '<script>jQuery("document").ready(function(){jQuery("#'.$error[1].'").parent().closest("div").addClass("has-error");});</script>';
       
            } else {
                $html .= '<li class="text-white">'.$error.'</li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }

}
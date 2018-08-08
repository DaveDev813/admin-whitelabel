<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormComponents{

	private $id;
	private $options;
	private $label;
	private $class;

	public function set(
		string $type, 
		string $id, 
		string $label,  
		array  $values  = array(), 
		array  $options = array()){

		if(!method_exists($this, $type)){
			$this->exitError("'".$type."' does not exists!");
		}

		$this->type = $type;

		if(!is_array($options)){
			$this->exitError("Coptions is not in valid value!");
		}

		$this->options = $options;

		if(!is_string($label)){
			$this->exitError("Label is not a string!");
		}

		$this->label = $label;		
		$this->id 	 = $id;
		$this->value = $values;
		$this->name  = strtolower(str_replace(" ", "_", $id));

		return $this->{$type}();
	}

	private function exitError($msg){
		die("<b style='color:red'>Component Error: ". $msg."!</b>");
	}

	private function setProperties(){

		$properties = "";

		foreach($this->options as $prop => $value){
			
	    	if(empty($prop) || is_null($prop)){
	    		$properties .= $value . " ";
	    	}else{
				$properties .= $prop . "='" . $value . "'";
	    	}
		}

		return $properties;
	}

	private function setLabel(){
	
		$required = "";

		if(in_array("required", $this->options)){
			$required = "<span style='color:red'>*</span>";
		}

		return "<label>". $this->label . " " . $required . "</label>";
    }

	private function input(){

		if(isset($this->options["class"]) && !empty($this->options["class"])){
			$this->options["class"] .= "form-control";
		}else{
			$this->options["class"] = "form-control";
		}

		$value = !empty($this->value) ? $this->value[0] : "";
		$html  = "<div class=\"form-group\">";
		$html .= $this->setLabel();
	    $html .= "<input id='".$this->id."' name='".$this->name."' value='".$value."'" ; 
	    $html .= $this->setProperties();
		$html .= " />";
		$html .= "</div>";

		return $html;
	}

	private function select(){

		if(!is_array($this->value)){
			$this->exitError("Invalid values of select tag");
		}

		if(isset($this->options["class"]) && !empty($this->options["class"])){
			$this->options["class"] .= "form-control";
		}else{
			$this->options["class"] = "form-control";			
		}		

		$html  = "<div class=\"form-group\">";
		$html .= $this->setLabel();

		$html .= "<select id='".$this->id."' name='".$this->name."'";
		$html .= $this->setProperties();
		$html .= ">";

		foreach($this->value as $label => $value){

			$_select = "";

			if(isset($this->options["selected"])){
				if($value == $this->options["selected"]){
					$_select = "selected='true'";	
				}
			}

			$html .= "<option value='".$value."' ".$_select.">".$label."</option>";
		}

		$html .= "</select>";
		$html .= "</div>";

		return $html;
	}

	private function textarea(){

		if(isset($this->options["class"]) && !empty($this->options["class"])){
			$this->options["class"] .= "form-control";
		}else{
			$this->options["class"] = "form-control";
		}

		$html  = "<div class=\"form-group\">";
		$html .= $this->setLabel();
	    $html .= "<textarea id='".$this->id."' name='".$this->name."'";
	    $html .= $this->setProperties();
	    $html .= "></textarea>";
		$html .= "</div>";

		return $html;
	}

	private function radio(){

		if(isset($this->options["class"]) && !empty($this->options["class"])){
			$this->options["class"] .= "form-control";
		}else{
			$this->options["class"] = "form-control";
		}

		$html  = '<div class="form-group">';
		$html .= $this->setLabel();

		$index = 1;

		foreach($this->value as $label => $value){
			$html .= "<div class='radio'>";
			$html .= "<label>";
			$html .= "<input type='radio' id='" . $this->id . "_" . $index. "' name='".$this->name . "' value='".$value."' ";
			$html .= $this->setProperties() . '>' . $label;
			$html .= "</label>";
			$html .= "</div>";

			$index++;
		}

		$html .= '</div>';

	    return $html;
	}

	private function checkbox(){

		if(isset($this->options["class"]) && !empty($this->options["class"])){
			$this->options["class"] .= "form-control";
		}else{
			$this->options["class"] = "form-control";
		}

		$html  = '<div class="form-group">';
		$html .= $this->setLabel();

		$index = 1;

		foreach($this->value as $label => $value){
			$html .= "<div class='checkbox'>";
			$html .= "<label>";
			$html .= "<input type='checkbox' id='" . $this->id . "_" . $index. "' name='".$this->name . "' value='".$value."' ";
			$html .= $this->setProperties() . '>' . $label;
			$html .= "</label>";
			$html .= "</div>";

			$index++;
		}

		$html .= '</div>';

	    return $html;
	}

	private function datepicker(){

		if(isset($this->options["class"]) && !empty($this->options["class"])){
			$this->options["class"] .= "form-control datepicker pull-right";
		}else{
			$this->options["class"] = "form-control datepicker pull-right";			
		}

		$value = !empty($this->value) ? $this->value[0] : "";
		$html  = "<div class='form-group'>";
		$html .= $this->setLabel();
		$html .= "<div class=\"input-group date\">";
		$html .= "<div class=\"input-group-addon\">";
		$html .= "<i class=\"fa fa-calendar\"></i>";
		$html .= "</div>";
		$html .= "<input type=\"text\" value='".$value."' id='".$this->id."' name='".$this->name."' " . $this->setProperties() . " >";
		$html .= "</div>";
		$html .= "</div>";

		return $html;
	}

	private function daterangepicker(){

		if(isset($this->options["class"]) && !empty($this->options["class"])){
			$this->options["class"] .= "form-control daterange_picker pull-right";
		}else{
			$this->options["class"] = "form-control daterange_picker pull-right";			
		}

		$value = !empty($this->value) ? $this->value[0] : "";
		$html  = "<div class='form-group'>";
		$html .= $this->setLabel();
		$html .= "<div class=\"input-group date\">";
		$html .= "<div class=\"input-group-addon\">";
		$html .= "<i class=\"fa fa-calendar\"></i>";
		$html .= "</div>";
		$html .= "<input type=\"text\" id='".$this->id."' name='".$this->name."' " . $this->setProperties() . " >";
		$html .= "</div>";
		$html .= "</div>";

		return $html;		
	}

	private function timepicker(){

		if(isset($this->options["class"]) && !empty($this->options["class"])){
			$this->options["class"] .= "form-control timepicker pull-right";
		}else{
			$this->options["class"] = "form-control timepicker pull-right";			
		}

		$value = !empty($this->value) ? $this->value[0] : "";

		$html  = "<div class=\"bootstrap-timepicker\">";
		$html .= "<div class=\"form-group\">";
		$html .= $this->setLabel();
		$html .= "<div class=\"input-group\">";
		$html .= "<div class=\"input-group-addon\">";
		$html .= "<i class=\"fa fa-clock-o\"></i>";
		$html .= "</div>";
		$html .= "<input type=\"text\" id='".$this->id."' value='".$value."' name='".$this->name."' " . $this->setProperties() . ">";
		$html .= "</div>";
		$html .= "</div>";
		$html .= "</div>";

		return $html;
	}

	private function inputphonemasked(){

		$value = !empty($this->value) ? $this->value[0] : "";

		if(isset($this->options["class"]) && !empty($this->options["class"])){
			$this->options["class"] .= "form-control";
		}else{
			$this->options["class"] = "form-control";
		}

		$html  = "<div class=\"form-group\">";
		$html .= $this->setLabel();
		$html .= "<div class='input-group'>";
		$html .= "<div class='input-group-addon'>";
		$html .= "<i class=\"fa fa-phone\"></i>";
		$html .= "</div>";
		$html .= "<input type='text' id='".$this->id."' name='".$this->name."' value='".$value."' data-inputmask=\"'mask':'(99) 999-9999'\" data-mask='' ".$this->setProperties().">";
		$html .= "</div>";
		$html .= "</div>";

		return $html;
	}

	private function inputdatemasked(){

		if(isset($this->options["class"]) && !empty($this->options["class"])){
			$this->options["class"] .= "form-control";
		}else{
			$this->options["class"] = "form-control";
		}

		$value = "";
		
		if(isset($this->value[0])){
			$value = date("m/d/Y",strtotime(!empty($this->value) ? $this->value[0] : ""));
		}

		$html  = "<div class=\"form-group\">";
		$html .= $this->setLabel();
		$html .= "<div class='input-group'>";
		$html .= "<div class='input-group-addon'>";
		$html .= "<i class=\"fa fa-calendar\"></i>";
		$html .= "</div>";
		$html .= "<input type='text' id='".$this->id."' name='".$this->name."' value='".$value."' data-inputmask=\"'alias':'mm/dd/yyyy'\" data-mask='' ".$this->setProperties().">";
		$html .= "</div>";
		$html .= "</div>";

		return $html;
	}

	private function multiple(){

		if(isset($this->options["class"]) && !empty($this->options["class"])){
			$this->options["class"] .= "form-control select2 select2-hidden-accessible";
		}else{
			$this->options["class"] = "form-control select2 select2-hidden-accessible";			
		}

		$selected = array();

		if(isset($this->options["selected"])){
			$selected = $this->options["selected"];
		}

		unset($this->options["selected"]);

		$html  = "<div class=\"form-group\">";
		$html .= $this->setLabel();
		$html .="<select id='".$this->id."' name='".$this->name."' ".$this->setProperties()." multiple='' style=\"width: 100%;\" tabindex=\"-1\" aria-hidden=\"true\" >";


		foreach($this->value as $label => $value){

			$_select = "";
				
			if(in_array($value, $selected)){
				$_select = "selected='true'";	
			}

			$html .= "<option value='".$value."' ".$_select.">".$label."</option>";
		}

		$html .= "</select>";
		$html .= "</div>";

		return $html;
	}
}




























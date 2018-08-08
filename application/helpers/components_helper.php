<?php

function input($id, $name, $value = "", $opts = array()){

	if(!is_array($opts)){
		return "<span style='color:red'><b>Input component error : options is not valid</b></span>";
	}

	$label = isset($opts["label"]) && !empty($opts["label"]) ? $opts["label"] : "";

	$html  = "<div class=\"form-group\">";
	$html .= "<label>".$label."</label>";
    $html .= "<input id='".$id."' name='".$name."' value='".$value."'" ; 

    if(!isset($opts["class"])){
    	$html .= "class='form-control' ";
    }

    unset($opts["label"]);

    foreach($opts as $prop => $val){

    	if($prop == "class"){
    		$html .= "class='form-control " . $val ." '";
    	}

    	if(empty($prop) || is_null($prop)){
    		$html .= $val . " ";
    	}else{
	    	$html .= $prop . "='" . $val . "' ";
    	}
    }

    $html .= " />";
	$html .= "</div>";

	return $html;
}

function inputPhoneMasked(){
	
    // <div class="form-group">
    //   <label>US phone mask:</label>
    //   <div class="input-group">
    //     <div class="input-group-addon">
    //       <i class="fa fa-phone"></i>
    //     </div>neMAsk
    //     <input id="input-mask" type="text" class="form-control" data-inputmask="mask:(999) 999-9999" data-mask="">
    //   </div>
    // </div>	
}

function inputDateMasked(){

	     //  <div class="form-group">
	  //   <div class="input-group">
	  //     <div class="input-group-addon">
	  //       <i class="fa fa-calendar"></i>
	  //     </div>
	  //     <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="">
	  //   </div>
	  //   <!-- /.input group -->
	  // </div>
}

function textarea($id, $name, $value, $opts){

	$label = isset($opts["label"]) && !empty($opts["label"]) ? $opts["label"] : "";

	$html  = "<div class=\"form-group\">";
	$html .= "<label>".$label."</label>";
    $html .= "<textarea ";

    unset($opts["label"]);
    
    if(!isset($opts["class"])){
    	$html .= "class='form-control' ";
    }

    foreach($opts as $prop => $val){

    	if($prop == "class"){
    		$html .= "class='form-control " . $val ." '";
    	}

    	if(empty($prop) || is_null($prop)){
    		$html .= $val . " ";
    	}else{
	    	$html .= $prop . "='" . $val . "' ";
    	}
    }

    $html .= "></textarea>";
	$html .= "</div>";

	return $html;
}

function select($id, $name, $value, $opts){



	$html  = "<div class=\"form-group\">";
	$html .= "<label>".$label."</label>";


}

function datepicker(){

}

function datetimepicker(){

}

function timepicker(){

}

function checkbox($id, $name, $values, $opts){

	if(empty($id) || is_null($id)){
		return "<span style='color:red'><b>Checkbox component error : id is not valid</b></span>";
	}

	if(!is_array($values) || empty($values)){
		return "<span style='color:red'><b>Checkbox component error : values are not valid</b></span>";
	}

	if(!is_array($opts)){
		return "<span style='color:red'><b>Checkbox component error : options is not valid</b></span>";
	}

	$label = isset($opts["label"]) && !empty($opts["label"]) ? $opts["label"] : "";
	$class = isset($opts["class"]) && !empty($opts["class"]) ? "class='".$opts["class"]."'" : "";

	$html  = '<div class="form-group">';
	$html .= '<label>'.$label.'</label>';


	foreach($values as $label => $value){
		$html .= "<div class='checkbox'>";
		$html .= "<label>";
		$html .= "<input type='checkbox' ".$class." value='".$value."' name='".$name."'>" . $label;
		$html .= "</label>";
		$html .= "</div>";
	}

	$html .= '</div>';

    return $html;
}




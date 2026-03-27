<?php

function can_access_menu($menu){
    if($_SESSION['apriori_level']==2 & ($menu=='hasil_split' || $menu=='view_rule' || $menu=='hasiluser' || $menu=='akun_split' || $menu=='akun_user')){
        return true;
    }
    if($_SESSION['apriori_level']==1){
        return true;
    }
    return false;
}

function phpAlert($msg){
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
function display_error($msg){
    echo "<div class='alert alert-danger alert-dismissable'>

            <h4><i class='icon fa fa-ban'></i> Error! </h4>
            ".$msg."
        </div>";
}

function display_warning($msg){
    echo "<div class='alert alert-warning alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4><i class='icon fa fa-warning'></i> Warning! </h4>
            ".$msg."
          </div>";
}

function display_information($msg){
    echo "<div class='alert alert-info alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4><i class='icon fa fa-info'></i> Information </h4>
            ".$msg."
          </div>";
}

function display_success($msg){
    echo "<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-check'></i> Success. </h4>
                    ".$msg."
                  </div>";
}

function br($a=1){
	if($a>=1){
		$aa=0;
		while($aa<=$a){
			echo "<br>";
			$aa++;
		}
	}
}

function space($a=1){
	if($a>=1){
		$aa=0;
		while($aa<=$a){
			echo "&nbsp;";
			$aa++;
		}
	}
}


function start_div($params=''){
	echo "<div $params>";
}

function end_div(){
	echo "</div>";
}


function start_form($params=''){
	echo "<form action='' method='post' $params>";
}


function end_form(){
	echo "</form>";
}


function start_table($params=''){
	echo "<table $params>";
}


function end_table(){
	echo "</table>";
}

function start_row($params=''){
	echo "<tr $params>";
}


function end_row(){
	echo "</tr>";
}


function start_column($params=''){
	echo "<td $params>";
}


function end_column(){
	echo "</td>";
}



function label($label='', $params=''){
	echo "<label for='name' $params >".$label;
	echo "</label>";
}


function input_text_area($name,$value, $required=false, $params='', $texteditor=false){
    $tinymce = "mceNoEditor";
    if($texteditor){
        $tinymce = "mceEditor";
    }
    if(!$required){
        echo "<textarea name='$name' rows='10' cols='80' $params>".$value."</textarea>";
    }
    else{
        echo "<textarea name='$name' required='required' class='form-control $tinymce' $params>".$value."</textarea>";
    }
}


function text_area($label='', $name='', $value=null, $required=false, $params='', $texteditor=false)
{
			label($label);
			input_text_area($name, $value, $required, $params, $texteditor);
}

function password_field($label='', $name='', $value='', $required=false, $params='')
{
			label($label);
			input_password_text($name, $value, $required, $params);
}

function text_field($label='', $name='', $value='', $required=false, $params='')
{
			label($label);
			input_free_text($name, $value, $required, $params);
}


function text_input_file($label='', $name='', $required=false, $params=''){
    label($label);
    input_file($name, $required, $params );
}

function amount_field($label='', $name='', $value='', $required=false, $params='')
{
			label($label);
			input_amount_text($name, $value, $required, $params);
}

function text_label_with_hidden($label='', $name='', $id_value='', $value=null, $params='')
{
			label($label);
                    space(2);
                    echo $value;
                    input_hidden($name, $id_value, $params);
}


function text_cell($text='', $params='')
{
	start_column($params);
	echo $text;
	end_column();
}


function space_cell($params='')
{
	start_column($params);
	echo "&nbsp;";
	end_column();
}


function head_table($head, $thead=false){
    if($thead){
        echo "<thead>";
    }
	start_row();
	foreach ($head as $val => $value) {
		echo "<th>".$value."</th>";
	}
	end_row();
    if($thead){
        echo "</thead>";
    }
}


function foot_table($head, $thead=false){
    if($thead){
        echo "<tfoot>";
    }
	start_row();
	foreach ($head as $val => $value) {
		echo "<th>".$value."</th>";
	}
	end_row();
    if($thead){
        echo "</tfoot>";
    }
}

function edit_delete_link($table, $id, $parameter_key, $path_to_root, $parent_menu){
	start_column("align='center' ");
        edit_link($table, $id, $parameter_key, $path_to_root, $parent_menu);
//	echo " | ";
        delete_link($table, $id, $parameter_key, $path_to_root, $parent_menu);
	end_column();
}

function input_file($name, $required=false, $params=''){
    if(!$required){
        echo "<input type='file' name='$name' $params>";
    }
    else{
        echo "<input type='file' name='$name' required='required' $params>";
    }
}

function input_date($name, $value, $tittle='', $id='date-picker'){
	echo "<input type='text' id='$id'  name='$name' size='10' maxlength='10'
			value='$value' tittle ='$tittle' />";
}

function submit_form_button($name, $value){
	echo "<input type='submit' name='$name' value='$value' >";
	echo "<input type='reset' value='Reset'>";
}

function submit_button($name, $value, $params=''){
	echo "<button name='$name' value='$value' $params >$value</button>";
}

function price_format($value){
	return number_format($value,2, ',', '.');
}

function print_cetak(){
    echo "<a href=\"javascript:window.print()\">Cetak</a>";
}

function format_date($date){
    $date_ex = explode("/", $date);
    return $date_ex[2]."-".$date_ex[1]."-".$date_ex[0];
}

function format_date2($date){
    $date_ex = explode("-", $date);
    return $date_ex[2]."/".$date_ex[1]."/".$date_ex[0];
}

function format_date_db($date){
    $date_ex = explode("-", $date);
    return $date_ex[2]."-".$date_ex[1]."-".$date_ex[0];
}

?>
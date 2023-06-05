<?php

	include(get_template_directory() . '/classes/RWDGoogleCaptchaV3.php');

	class FormItem {

		/*

			$arr = array(
				'type' => '',
				'placeholder' => '',
				'name' => ''
			);

		*/

		var $id;
		var $name;
		var $label = NULL;
		var $type = 'text';
		var $placeholder;
		var $value = '';
		var $valid = 1;
		var $validation_type = '';
		var $message = NULL;
		var $options = [];

		private function renderLabel()
		{
			if($this->label != NULL){
				echo '<label>';
				echo $this->label;
				if($this->validation_type != 'none'){
					echo '<span class="astrix">*</span>';
				}
				echo '</label>';
			}
		}

		function render(){

			if($this->type == 'robot'){

				echo '<input id="q_robot_check" type="checkbox" name="' . $this->name . '" value="robot" />';
				echo '<label for="q_robot_check">I’m not a robot</label>';

			}else if($this->type == 'robot_v3'){



			}else if($this->type == 'dropdown'){

				$this->renderLabel();

				echo '<select class="select-custom select-custom--full ' . $this->invalidCssName() . '" name="' . $this->name . '">';
					echo '<option value="">- select -</option>';
					foreach ($this->options as $option) {
						echo '<option value="' . $option . '">' . $option . '</option>';
					}
				echo '</select>';

			}else if($this->type == 'file'){

				$this->renderLabel();

				echo '<label class="file_upload ' . $this->invalidCssName() . '">';
					echo '<span class="file">Choose File</span>';
					echo '<div class="icon_box">';
						echo '<i class="icon icon-upload"></i>';
					echo '</div>';
					echo '<input type="file" name="' . $this->name . '" value="' . $this->value . '">';
				echo '</label>';

			}else if($this->type == 'calander'){

				$this->renderLabel();
				echo '<div class="appointment_inputs">';

				// loop

				if($this->value != ''){
					for($i=0; $i<sizeof($this->value);$i++) {
						$date = $this->value[$i]['date'];
						$time = $this->value[$i]['time'];
						echo '<input type="hidden" name="q_appointment_dates[' . $i . '][date]" value="' . $date . '" />';
						echo '<input type="hidden" name="q_appointment_dates[' . $i . '][time]" value="' . $time . '" />';
					}
				}

				echo '</div>';
				echo '<div id="datepicker"></div>';

			}else if($this->type == 'number'){

				$this->renderLabel();
				echo '<input type="' . $this->type . '" name="' . $this->name . '" placeholder="' . $this->placeholder . '" value="' . $this->value . '" class="form-control ' . $this->invalidCssName() . '" step="0.01" />';

			}else if($this->type == 'textarea'){

				$this->renderLabel();
				echo '<textarea rows="6" class="form-control ' . $this->invalidCssName() . '" name="' . $this->name . '">' . $this->value . '</textarea>';

			}else{

				$this->renderLabel();
				echo '<input type="' . $this->type . '" name="' . $this->name . '" placeholder="' . $this->placeholder . '" value="' . $this->value . '" class="form-control ' . $this->invalidCssName() . '" />';

			}

		}

		function invalidCssName(){

			// echo 'value: ' . $this->value;
			// echo $this->name . ' valid? = ' . $this->valid;

			if($this->valid){
				return '';
			}else{
				return 'invalid';
			}
		}

		function invalidate(){
			$this->valid = 0;
		}

		function invalidMessage(){
			if($this->message != NULL){
				return $this->message;
			}else {
				return 'Please complete all of the mandatory fields';
			}
		}

		function isValid(){

			$valid = 'valid';

			switch ($this->validation_type) {
				case '':

					if($this->value == ''){
						$valid = $this->invalidMessage();
					}

					break;

				case 'phone':

					if (!ctype_digit( str_replace(' ', '', $this->value) )) {
					    $valid = $this->invalidMessage();
					}

					break;
				case 'email':

					if(!filter_var($this->value, FILTER_VALIDATE_EMAIL)){
						$valid = $this->invalidMessage();
					}

					break;
				case 'robot_v3':

					$res = CurchodsGoogleCaptchaV3::validate($this->value);

					if(!$res) {
						$valid = 'Google thinks you are a robot';
					}

					break;
				case 'calander':

					if(empty($this->value)){
						$valid = $this->invalidMessage();
					}

					break;
				case 'none':
				default:
					break;
			}

			// echo $this->name . ' valid: ' . $valid . '<br>';

			return $valid;

		}

		function __construct($id, $arr){

			$this->id = $id;

			if(isset($arr['type']) && $arr['type'] === 'robot_v3'){
				$this->name = $id;
			}else{
				$this->name = 'q_' . $id;
			}

			// check label
			if(isset($arr['label'])){
				if($arr['label'] != 'none'){
					$this->label = $arr['label'];
				}
			}else{
				$this->label = ucwords(str_replace('_', ' ', $id));
			}

			// check type
			if(isset($arr['type'])){
				$this->type = $arr['type'];
			}

			// check placeholder
			if(isset($arr['placeholder'])){
				$this->placeholder = $arr['placeholder'];
			}else{
				$this->placeholder = ucwords(str_replace('_', ' ', $id)) . '...';
			}

			// check value
			if(isset($_POST[$this->name])){
				$this->value = LR_Helpers::sanitize($_POST[$this->name]);
			}

			// check validation type
			if(isset($arr['validation_type'])){
				$this->validation_type = $arr['validation_type'];
			}

			if(isset($arr['options'])){
				$this->options = $arr['options'];
			}

			if(isset($arr['message'])){
				$this->message = $arr['message'];
			}

		}

	}

	class LR_Form {

		var $formId;
		var $formItems = [];
		var $message = '';

		function addFormItem($id, $item){
			if(isset($formItems[$id])){
				print_r('Error: Form Id ' . $id . ' allready exists');
				die();
			}
			$this->formItems[$id] = new FormItem($id, $item);
		}

		function hasFormSubmited(){
			if(isset($_POST[$this->formId])){
				return 1;
			}
			return 0;
		}

		function displayMsg(){
			if($this->message != ''){
				echo '<p class="notification error">';
				echo $this->message;
				echo '</p>';
			}
		}

		function isValid(){

			$valid = 1;
			$this->message = '';

			foreach ($this->formItems as $item) {
				$validation = $item->isValid();
				if($validation != 'valid'){
					$item->invalidate();
					$this->message = $validation;
					$valid = 0;
				}
			}

			return $valid;

		}

		function printValues(){
			foreach ($this->formItems as $item) {
				echo '<p>' . $item->label . ' = ' . $item->value . '</p>';
			}
			die();
		}

		function __construct($formId){
			$this->formId = $formId;
		}

	}

?>

<?php
/**
 * Form.php
 *
 * The Form class is meant to simplify the task of keeping
 * track of errors in user submitted forms and the form
 * field values that were entered correctly.
 *
 * Cteated by: Carlos Pinto
 * Last Updated: February 19, 2014
 */

class Form
{
   var $values = array();  //Holds submitted form field values
   var $errors = array();  //Holds submitted form error messages
   var $num_errors;   //The number of errors in submitted form

   /* Class constructor */
   function Form(){
      /**
       * Get form value and error arrays, used when there
       * is an error with a user-submitted form.
       */

      if(isset($_SESSION['value_array']) && isset($_SESSION['error_array'])){
         $this->values = $_SESSION['value_array'];
         $this->errors = $_SESSION['error_array'];
         $this->num_errors = count($this->errors);

         unset($_SESSION['value_array']);
         unset($_SESSION['error_array']);
      }
      else{
         $this->num_errors = 0;
      }
   }


   /**
    * setValue - Records the value typed into the given
    * form field by the user.
    */
   function setValue($field, $value){
      $this->values[$field] = $value;
   }


   /**
    * setError - Records new form error given the form
    * field name and the error message attached to it.
    */
   function setError($field, $errmsg){
      $this->errors[$field] = $errmsg;
      $this->num_errors = count($this->errors);
   }


   /**
    * value - Returns the value attached to the given
    * field, if none exists, the empty string is returned.
    */

   function value($field){
      if(array_key_exists($field,$this->values)){
         return htmlspecialchars(stripslashes($this->values[$field]));
      }else{
         return "";
      }
   }


   /**
    * error - Returns the error message attached to the
    * given field, if none exists, the empty string is returned.
    */

	function error($field){
		if(array_key_exists($field,$this->errors)){
      #return "<span class=\"text-error\" >&nbsp;".$this->errors[$field]."</span>";
			return "".$this->errors[$field]."";
		}else{
			return "";
		}
	}


   function errorWithBr($field){
		if(array_key_exists($field,$this->errors)){
			return "<span class=\"text-error\" ><br>".$this->errors[$field]."</span>";
		}else{
			return "";
		}
   }


   /* getErrorArray - Returns the array of error messages */
   function getErrorArray(){
      return $this->errors;
   }

};
?>
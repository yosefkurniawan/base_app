<?php
/**
 *
 * Class Global Messages for CodeIgniter
 *
 * Author     : Jojo
 * Date       : 2015-02-08
 * Description: 
 * - This class is used for global messages handling
 *
 */

class Message {
  public $errorMsg    = array();
  public $warningMsg  = array();
  public $successMsg  = array();

  // add error msg
  function addError($msg) {
    $this->errorMsg[] = $msg;
  }

  // add warning msg
  function addWarning($msg) {
    $this->warningMsg[] = $msg;
  }

  // add success msg
  function addSuccess($msg) {
    $this->successMsg[] = $msg;
  }

  // render error msg
  function renderErrorMsg() {

    $output = '';

    if (!empty($this->errorMsg)) {
      foreach ($this->errorMsg as $msg) {
        $output .= '<div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <i class="fa fa-remove pr10"></i>
                  ' . $msg . '
                  </div>';
      }
    }

    return $output;
  }

  // render warning msg
  function renderWarningMsg() {

    $output = '';

    if (!empty($this->warningMsg)) {
      foreach ($this->errorMsg as $msg) {
        $output .= '<div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-remove pr10"></i>
                    ' . $msg . '
                    </div>';
      }
    }

    return $output;
  }

  // render success msg
  function renderSuccessMsg() {

    $output = '';

    if (!empty($this->successMsg)) {
      foreach ($this->successMsg as $msg) {
        $output .= '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-remove pr10"></i>
                    ' . $msg . '
                    </div>';
      }
    }

    return $output;
  }

  // render all msg
  // - messages will be rendered as flashdata
  // - they will be displayed on page refresh
  function render() {
    $output = '';
    $output .= $this->renderErrorMsg();
    $output .= $this->renderWarningMsg();
    $output .= $this->renderSuccessMsg();

    $CI =& get_instance();  
    return $CI->session->set_flashdata('messages',$output);
  }

  // render all msg as html
  // - this function return messages as html block
  // - can be used for ajax purpose
  function render_html() {
    $output = '';
    $output .= $this->renderErrorMsg();
    $output .= $this->renderWarningMsg();
    $output .= $this->renderSuccessMsg();

    return $output;
  }

}
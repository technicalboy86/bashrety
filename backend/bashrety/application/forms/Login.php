<?php

class Application_Form_Login extends Zend_Form
{
	public function init()
	{
		$this->setMethod(Zend_Form::METHOD_POST);
		$this->setAction('/auth/login');
		
		$this->addElement("text", "username", array(
			'filters'   => array('StringTrim', 'StringToLower'),
            'validators'=> array(
                array('StringLength', false, array(3, 200)),
            ),
            'required'  => true,
            'id' 		=> 'username',
            'class'		=> 'input-text',
						'placeholder'=>'Username'
		));
		
		$this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('Regex', false, array('pattern' => '/([a-zA-Z0-9_\-@#$%])/s')),
                array('StringLength', false, array(4, 20)),
            ),
            'required'   => true,
            'id' 		=> 'password',
            'class'		=> 'input-text',
						'placeholder'=>'Password'
        ));
        
        $this->addElement('checkbox', 'remember', array(
        	'id' => 'remember'
        ));
        
        $this->addElement('submit', 'login', array(
        	'class'		=> 'medium radius blue button right',
        	'style'		=> 'margin-bottom:10px;',
        	'label'		=> 'Login to Self Service'
       	));
	}
	
	public function loadDefaultDecorators()
	{
		$this->username->setDecorators(array('ViewHelper'));
		$this->password->setDecorators(array('ViewHelper'));
		$this->remember->setDecorators(array('ViewHelper'));
		$this->login->setDecorators(array('ViewHelper'));
	}
}


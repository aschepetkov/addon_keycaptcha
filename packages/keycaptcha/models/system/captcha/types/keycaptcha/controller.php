<?php     defined('C5_EXECUTE') or die(_("Access Denied."));

class KeycaptchaSystemCaptchaTypeController extends SystemCaptchaTypeController {
 
	public function __construct() {
		Loader::library("3rdparty/keycaptcha/keycaptcha", "keycaptcha");
        $pkg = Package::getByHandle("keycaptcha");

        $this->keycaptcha = new KeyCAPTCHA_CLASS($pkg->config("privateKey"));
    }
	/** 
	 * Display the captcha
	 */ 
	public function display() {
        echo '<input type="hidden" name="capcode" id="capcode" value="false" />';
        echo $this->keycaptcha->render_js();
	}

/** Displays the text input field that must be entered when used with a corresponding image. */
	public function showInput($args = false) { 

    }

	public function label() {
		$form = Loader::helper('form');
		print $form->label('keycaptcha', t('Solve the task.'));
	}

	/** 
	 * Print the captcha image. You usually don't have to call this method directly.
	 * It gets called by captcha.php from the tools 
	 */	 	
	public function displayCaptchaPicture() {

	}

    /** Save the KeyCaptcha options.
	* @param array $options
	*/
	public function saveOptions($options) {
		$co = new Config();
		$co->setPackageObject(Package::getByHandle('keycaptcha'));
        $name = 'privateKey';
        $value = isset($options[$name]) && is_string($options[$name]) ? trim($options[$name]) : '';
        
        if(strlen($value)) {
            $co->save($name, $value);
        }
        else {
            $co->clear($name);
        }
	}

	/** 
	 * Checks the captcha code the user has entered.
	 * @param string $fieldName Optional name of the field that contains the captcha code
	 * @return boolean true if the code was correct, false if not
	 */
	public function check() {
	   return $this->keycaptcha->check_result($_POST['capcode']);
	}
}
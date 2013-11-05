<?php    defined('C5_EXECUTE') or die('Access denied.');
    $form = Loader::helper('form');
    $co = new Config();
    $co->setPackageObject(Package::getByHandle('keycaptcha'));
    $privateKey = $co->get('privateKey');
    Loader::library('3rdparty/keycaptcha/keycaptcha', 'keycaptcha');

    $currentLocale = Localization::activeLocale();
    if ($currentLocale == 'ru_RU') {
        $keycaptchaUrl = "https://www.keycaptcha.ru/";
    }
    else {
        $keycaptchaUrl = "https://www.keycaptcha.com/";
    }
?>
<div class="clearfix">
	<?php     echo $form->label('privateKey', t('Private key'), array('class' => 'control-label')); ?>
	<div class="input">
		<?php     echo $form->text('privateKey', $privateKey, array('class' => 'span5')); ?>
	</div>
</div>
<div class="clearfix">
	<div class="input">
		<?php     echo $form->label('', t('You can get the private key from <a target="_blank" href="%s">Keycaptcha</a>.', $keycaptchaUrl)); ?>
	</div>
</div>

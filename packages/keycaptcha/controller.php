<?php     defined('C5_EXECUTE') or die(_("Access Denied."));

class KeycaptchaPackage extends Package{
    protected $pkgHandle = 'keycaptcha';
    protected $appVersionRequired = '5.5';
    protected $pkgVersion = '1.0';

    public function getPackageName() {
        return t('Keycaptcha');
    }

    public function getPackageDescription() {
        return t('Protect your site from spam with KeyCaptcha plugin');
    }

    public function install() {
        $pkg = parent::install();

        Loader::model('system/captcha/library');
        SystemCaptchaLibrary::add('keycaptcha', t('Keycaptcha'), $pkg);

    }

	public function uninstall() {
        Loader::model('system/captcha/library');
        $activeCaptcha = SystemCaptchaLibrary::getActive();

        if (($activeCaptcha) && ($activeCaptcha->getSystemCaptchaLibraryHandle() == 'keycaptcha')) {
            $dbs = Loader::db();
            $dbs->Execute('update SystemCaptchaLibraries set sclIsActive=1 where sclHandle = ?', 'securimage');
        }

        parent::uninstall();
	}
}
?>
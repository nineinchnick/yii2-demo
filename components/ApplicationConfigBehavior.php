<?php

namespace app\components;

use Yii;
use yii\base\Behavior;
use yii\base\Application;

class ApplicationConfigBehavior extends Behavior
{
    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => [$this, 'beforeRequest'],
            Application::EVENT_AFTER_REQUEST => [$this, 'afterRequest'],
        ];
    }

    public function processOption($property, $queryStringKey, $stateKey, $availableValues, $default = null)
    {
        if (isset($_GET) && isset($_GET[$queryStringKey])) {
            // if passed in the request, save value as state and optionally redirect back to remove param from url
            $value = $_GET[$queryStringKey];
            if (in_array($value, $availableValues)) {
                $this->owner->session->set($stateKey, $value);
                Yii::trace('Received and saved state value for application property '.$property.': '.$value, 'application.behavior.ApplicationConfigBehavior');
                if (isset($_GET['returnUrl']))
                    $this->owner->response->redirect($_GET['returnUrl']);
            }
        }
        if (($value = $this->owner->session->get($stateKey))) {
            // if state has been saved, use it's value
            $this->owner->$property = $value;
            Yii::trace('Application property '.$property.' has been set to value: '.$value, 'application.behavior.ApplicationConfigBehavior');
        } elseif ($default !== null) {
            // if not and there is a default, use it - default value could be dynamic
            if (in_array($default, $availableValues))
                $this->owner->$property = $default;
            Yii::trace('Application property '.$property.' has been set to default value: '.$default, 'application.behavior.ApplicationConfigBehavior');
        }
    }

    /**
     * Load configuration that cannot be put in config/main
     */
    public function beforeRequest()
    {
        $availableLanguages = \app\controllers\SiteController::getAvailableLanguages();
        //$availableThemes = \app\controllers\SiteController::getAvailableThemes();
        $this->processOption('language', 'language', 'applicationLanguage', array_keys($availableLanguages), Yii::$app->request->getPreferredLanguage());
        //$this->processOption('theme', 'theme', 'applicationTheme', array_keys($availableThemes));
        return true;
    }

    public function afterRequest()
    {
        return true;
    }
}

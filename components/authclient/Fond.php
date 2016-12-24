<?php
namespace fond\components\authclient;

use yii\authclient\OAuth2;

class Fond extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://www.fond.io/auth';
    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://www.fond.io/auth/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://www.fond.io/api';

    /**
     * 强制通过 header 传递Token,
     * @inheritdoc
     */
    public function applyAccessTokenToRequest($request, $accessToken)
    {
        $header = $request->getHeaders();
        $header['Authorization'] = "Bearer ". $accessToken->getToken();
        $request->setHeaders($header);
    }

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        $response = $this->api('user/info', 'GET');
        return $response['data'];
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'fond';
    }
    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Fond';
    }
}
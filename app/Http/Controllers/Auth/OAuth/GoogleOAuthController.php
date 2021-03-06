<?php

namespace App\Http\Controllers\Auth\OAuth;

use Illuminate\Http\Request;

class GoogleOAuthController extends BaseOAuthController
{
    public function __construct()
    {
        $this->authUrl = env('GOOGLE_AUTH_URL');
        $this->tokenUrl = env('GOOGLE_TOKEN_URL');
        $this->redirectUrl = env('GOOGLE_REDIRECT_URL');
        $this->userInfoUrl = env('GOOGLE_USER_INFO_URL');
        $this->clientId = env('GOOGLE_CLIENT_ID');
        $this->clientSecret = env('GOOGLE_CLIENT_SECRET');
        $this->serviceType = 1; //Google

        parent::__construct();
    }

    /**
     * Redirect user to Google to confirm signing in.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showGoogleAuthForm()
    {
        $params = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUrl,
            'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
            'response_type' => 'code',
            'include_granted_scopes' => 'true',
            'access_type' => 'offline'
        ];

        return $this->redirectToAuthService($params);
    }

    /**
     * Receive a special code in request from Google and go through auth flow.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authUser(Request $request)
    {
        $code = $request->get('code');

        $postParams = [
            'code' => $code,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUrl,
            'grant_type' => 'authorization_code',
        ];

        return $this->passAuthFlow($postParams);
    }
}

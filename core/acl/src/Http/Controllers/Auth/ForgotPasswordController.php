<?php

namespace Botble\ACL\Http\Controllers\Auth;

use Assets;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * @var BaseHttpResponse
     */
    protected $response;

    /**
     * Create a new controller instance.
     * @param BaseHttpResponse $response
     */
    public function __construct(BaseHttpResponse $response)
    {
        $this->middleware('guest');
        $this->response = $response;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Sang Nguyen
     */
    public function showLinkRequestForm()
    {
        page_title()->setTitle(trans('core.acl::auth.forgot_password.title'));

        Assets::addJavascript(['jquery-validation']);
        Assets::addAppModule(['login']);
        return view('core.acl::auth.forgot-password');
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  string $response
     * @return BaseHttpResponse
     */
    protected function sendResetLinkResponse($response)
    {
        return $this->response->setMessage(trans($response));
    }
}

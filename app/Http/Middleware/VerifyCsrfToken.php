<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'testupload', 'addads', 'addpost', 'profileupload', 'post_comment', 'requestlist', 'addredeem', 'latest_dashboard_post', 'dashboard_post', 'requestlist', 'morepostload', 'gmbrs', 'atom_payment', 'success', 'failed', 'e_atom_payment',
        'login', 'getregister', 'edit_profile', 'insert_user_address', 'update_user_address', 'insert_review', 'image-crop', 'confirm_checkout', 'save_affiliates', 'addpost2', 'post_video', 'editads','edit_post_comment'
    ];
}

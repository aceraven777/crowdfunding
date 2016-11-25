Click here to reset your password: <a href="{{ $link = url('backend/password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>

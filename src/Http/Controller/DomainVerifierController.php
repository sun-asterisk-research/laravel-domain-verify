<?php

namespace SunAsterisk\DomainVerifier\Http\Controller;

use Illuminate\Routing\Controller;
use SunAsterisk\DomainVerifier\Models\DomainVerification;
use SunAsterisk\DomainVerifier\VerifierFactoryFacade as VerifierFactory;
use Illuminate\Support\Facades\Log;

class DomainVerifierController extends Controller
{
    public function getHtmlFile($id)
    {
        $domainVerification = DomainVerification::findOrFail($id);
        $verificationName = config('domain_verifier.verification_name');
        $fileName = "$verificationName.html";

        $content = $domainVerification->token;

        $headers = [
            'Content-type' => 'text/plain',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
            'Content-Length' => strlen($content),
        ];

        return response()->make($content, 200, $headers);
    }

    public function verify($token)
    {
        $viewSucceeded = config('domain_verifier.page.verification_succeeded');
        $viewFailed = config('domain_verifier.page.verification_failed');

        $verifier = VerifierFactory::strategy('sending-mail');
        try {
            $result = $verifier->verifyByActivationToken($token);

            if ($result->isVerified()) {
                $verifiable = $result->getVerifiable();
                $record = $result->getRecord();

                return view($viewSucceeded);
            }

            return view($viewFailed);
        } catch (\Exception $exception) {
            Log::error($exception);
            return view($viewFailed);
        }
    }
}

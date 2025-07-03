<?php
namespace App\Traits;

use App\Models\CompanyProfile;
use App\Models\ContactInfo;
use App\Models\IdentityVerification;
use App\Models\User;
use App\Models\Verification;

trait UserVerificationStatusTraits
{
    public function countryImage($countryCode){
        $flagUrl = "https://flagcdn.com/w40/{$countryCode}.png";
        return $flagUrl;
    }
    public function userVerificationStatus($userId, $withUserDetails = false)
    {
        $user = User::find($userId);
        $contactInfo = ContactInfo::where('user_id', $userId)->first();
        $subscription = $user->subscription()->where('subscribe_expires_at', '>=', now());
        $isCompanyVerified = $user->companyProfile->verification()->where('verification_status', Verification::VERIFICATION_STATUS_APPROVED)->exists() ? 1 : 0;
        $isSubscriptionVerified = $subscription->exists() ? 1 : 0;
        $isIdentityVerified = $user->identityVerification()->where('verification_status', IdentityVerification::IDENTITY_VERIFICATION_STATUS_APPROVED)->exists() ? 1 : 0;

        $badgeIcon  = '';
        $badgeText  = '';
        $badgeColor = '';
        $countryImage = '';
        $countryName = '';
        if ($user->contactInfo->country) {
            $imageUrl = $this->countryImage($user->contactInfo->country->code);
            $countryImage = '<img src="'.$imageUrl.'" class="flag-style"  alt="'.$user->contactInfo->country->name.'">';
            $countryName = "<span class='text ms-2 fw-bold'>{$user->contactInfo->country->name}</span>" ;
        }
        elseif($user->companyProfile->country) {
            $imageUrl = $this->countryImage($user->companyProfile->country->code);
            $countryImage = '<img src="'.$imageUrl.'" class="flag-style" alt="'.$user->companyProfile->country->name.'">';
            $countryName = "<span class='text ms-2 fw-bold'>{$user->companyProfile->country->name}</span>" ;
        }
        if ($isSubscriptionVerified) {
            $badgeIcon  = 'alpe-icon-57 text_warning';
            $badgeText  = 'This account is trusted verified.';
            $badgeColor = 'text_warning';
        } elseif ($isIdentityVerified) {
            $badgeIcon  = 'alpe-icon-57 text_primary';
            $badgeText  = 'This account is identity verified.';
            $badgeColor = 'text_primary';
        } elseif ($isCompanyVerified) {
            $badgeIcon  = 'alpe-icon-57 text_primary';
            $badgeText  = 'This account is company verified.';
            $badgeColor = 'text_primary';
        } else {
            $badgeIcon  = 'alpe-icon-57 text_danger';
            $badgeText  = 'This account is not verified.';
            $badgeColor = 'text_danger';
        }
        
        if (!$withUserDetails)
            return $badgeText;

        $companyProfile = CompanyProfile::with('country','companyInformation', 'companyContactInfo')
        ->where('user_id', $userId)->first();
        $badgeHTML = '<span>
            <span class="text_dark fw-bold fs-6 me-2 fontSizing">'.$badgeText.'</span>
        </span>';
        return [
            'badgeHTML' => $badgeHTML,
            'badgeColor' => $badgeColor,
            'verificationStatus' => $badgeText,
            'contactInfo' => $contactInfo,
            'companyProfile' => $companyProfile,
            'badgeIcon' => $badgeIcon,
            'countryImage' => $countryImage,
            'countryName' => $countryName,
        ];
    }
}
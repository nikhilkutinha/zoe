<?php

namespace App\Jetstream;
use Laravel\Jetstream\HasProfilePhoto as ParentHasProfilePhoto;

trait HasProfilePhoto {
    use ParentHasProfilePhoto {
        defaultProfilePhotoUrl as parentDefaultProfilePhotoUrl;
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        return 'https://ui-avatars.com/api/?name='.urlencode($this->email).'&color=3B82F6&background=EFF6FF';
    }
}
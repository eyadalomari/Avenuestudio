<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;

class ProfileRepository
{
    public function saveProfile($validated)
    {
        // Remove null values
        $data = array_filter($validated, function ($value) {
            return !is_null($value);
        });

        if (isset($data['password'])) {
            $data['password'] = bcrypt(request()->get('password'));
        }

        // Handle image upload
        if (request()->hasFile('image')) {
            $data['image'] = upload_file(request()->file('image'), 'images/profiles');
        }

        $user = User::findOrFail(request()->user()->id);
        $user->update($data);
    }
}

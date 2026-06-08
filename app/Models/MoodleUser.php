<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodleUser extends Model
{
    protected $table = 'mdlhpdl_user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'username', 'password', 'firstname', 'lastname', 'email', 'confirmed',
        'deleted', 'suspended', 'mnethostid', 'auth', 'idnumber', 'phone1', 'phone2',
        'institution', 'department', 'address', 'city', 'country', 'lang', 'calendartype',
        'theme', 'timezone', 'firstaccess', 'lastaccess', 'lastlogin', 'currentlogin',
        'lastip', 'secret', 'picture', 'description', 'descriptionformat', 'mailformat',
        'maildigest', 'maildisplay', 'autosubscribe', 'trackforums', 'timecreated',
        'timemodified', 'trustbitmask', 'imagealt', 'lastnamephonetic', 'firstnamephonetic',
        'middlename', 'alternatename', 'moodlenetprofile'
    ];

    /**
     * Validate credentials against Moodle user table.
     *
     * @param string $username
     * @param string $password
     * @return \App\Models\MoodleUser|null
     */
    public static function validateCredentials($username, $password)
    {
        $user = self::where('username', $username)
            ->where('confirmed', 1)
            ->where('deleted', 0)
            ->where('suspended', 0)
            ->first();

        if (!$user) {
            return null;
        }

        // 1. Check for SHA-512 crypt ($6$ format) – your Moodle uses this
        if (str_starts_with($user->password, '$6$')) {
            $hashed = crypt($password, $user->password);
            if (hash_equals($user->password, $hashed)) {
                return $user;
            }
        }

        // 2. Check for bcrypt (modern Moodle, fallback)
        if (password_verify($password, $user->password)) {
            return $user;
        }

        return null;
    }
}

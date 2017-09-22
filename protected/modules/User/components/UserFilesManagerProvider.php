<?php /**
 * Class UserFilesManagerProvider
 */
class UserFilesManagerProvider
{

    const AVATARS_STORAGE = './storage/Avatar';
    const AVATARS_STORAGE_ID = 4;

    /**
     * @return user profile image.
     **/
    public static function getProfileImage($user_id, $dim = '24*24')
    {

        if (!preg_match('/^\d{1,3}\*\d{1,3}$/', trim($dim), $result))
            $dim = '24*24';
        $dim = explode('*', $dim);

        $user = User::model()->findByPk($user_id);
        if (is_null($user))
            return self::generateNullImage($dim[0], $dim[1]);

        $profile = !is_null($user) ? $user->profile : null;
        if (is_null($profile) || !isset($profile->id) || !is_numeric($profile->id))
            return self::generateNullImage($dim[0], $dim[1]);

        $gender = !is_null($profile) ? $profile->gender : null;
        if (is_null($gender))
            return self::generateNullImage($dim[0], $dim[1]);

        $try_file = self::getAvatarsFolder() . '/' . 'avatar_' . md5($profile->id);
        $profiles_files = glob("$try_file.*");
        if (!count($profiles_files))
            return self::generateNullImage($dim[0], $dim[1], $profile->gender);

        return CHtml::image(
            Yii::app()->getAssetManager()->publish($profiles_files[0]), $user->full_name,
            array('width' => $dim[0], 'height' => $dim[1])
        );
    }

    private static function generateNullImage($width = 24, $height = 24, $gender = 1)
    {
        $image_name = $gender == 2 ? 'no_user_female.jpg' : 'no_user_male.jpg';

        return CHtml::image(
            Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/../data/profile/' . $image_name), "NO IMAGE",
            array('width' => $width, 'height' => $height)
        );
    }

    public static function getAvatarsFolder()
    {
        $avatar_folder = Storage::model()->findByPk(self::AVATARS_STORAGE_ID);
        return is_null($avatar_folder) ? self::AVATARS_STORAGE : $avatar_folder->path;
    }
}

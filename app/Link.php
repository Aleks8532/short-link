<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * @property integer $id
 * @property string $linkFull
 * @property string $linkAlias
 * @property string $lifetime
 * @property boolean $isCommercial
 * @property int $visitColumn
 * @property string $created_at
 * @property string $updated_at
 */
class Link extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'linkFull',
        'linkAlias',
        'lifetime',
        'isCommercial',
        'visitColumn',
        'created_at',
        'updated_at'
    ];

    static public function shorteningLink(
        string $rawLink,
        string $aliasLink,
        int $lifetime = 60 * 60 * 24,
        bool $isCommercial = false
    ) {
        //FIXME добавить проверку на существование исходной ссылки, если alias не указан, отдавать существующую короткую
        // ссылку, иначе (изменять ее alias на указанный || отдавать существующий), если ссылка существует но срок жизни
        // истек - (продлить || добавить)
        if ($aliasLink) {
            $isExist = Link::where('linkAlias', $aliasLink)->first() ? 1 : 0;
            if ($isExist) {
                return
                    array(
                        'error' => 1,
                        'text' => 'link_exist'
                    );
            }
        } else {

            do {
                $aliasLink = Link::generateRandomString(12);
            } while (Link::where('linkAlias', $aliasLink)->first() ? 1 : 0);

        }
        $link = new Link;
        $link->linkFull = $rawLink;
        $link->linkAlias = $aliasLink;
        $link->lifetime = $lifetime;
        $link->isCommercial = $isCommercial;
        try {
            $link->save();
        } catch (\Exception $e) {
            return array(
                'error' => 1,
                'text' => 'unknown_error'
            );
        }
        return array(
            'error' => 0,
            'text' =>  request()->getHost() . "/$aliasLink"
        );

    }

    public function visitLog()
    {
        return $this->hasMany('App\VisitLog');
    }

    static public function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            ceil($length / strlen($x)))), 1, $length);
    }


}

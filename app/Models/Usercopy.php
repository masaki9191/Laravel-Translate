<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes, HasFactory, Notifiable, TwoFactorAuthenticatable, InteractsWithMedia;


    protected $appends = [
        'avatar'
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // 'avatar',
        'type',

        // basic information

        'surname',
        'lastname',
        'seiname',
        'meiname',
        'sex',
        'abroad',
        'country',
        'country_name',
        'skype_id',
        'prefecture',
        'prefecture_name',

        //career information

        'language',
        'category',
        'experience_year',
        'score',
        'performance',
        'overseas_experience',
        'good_genre',
        'other_point',
        'bilingual',

        //payment information
        'financial_institution_name',
        'financial_branch_name',
        'bank_name',
        'branch_name',
        'account_number',
        'account_holder',
        'stripe_id',

        //available
        'state',

        //agree
        'agree',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
    ];

    // public function getAvatarUrlAttribute()
    // {
    //     if ($this->avatar != null) :
    //         return asset($this->avatar);
    //     else :
    //         return 'https://ui-avatars.com/api/?name=' . str_replace(' ', '+', $this->name) . '&background=fff&color=6777ef&size=100';
    //     endif;
    // }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(325)->height(210);
    }

    public function getAvatarAttribute()
    {
        $avatar = $this->getMedia('avatar');
        if(count($avatar) == 0)
            return "";
        $url = $avatar[0]->getUrl();
        $url = str_replace(URL::to('/'),URL::to('/')."/public",$url);
        return $url;
    }

    public function messagesTo()
    {
        return $this->hasOne(Message::class, 'to_id')->latest();
    }

    public function messagesFrom()
    {
        return $this->hasOne(Message::class, 'from_id')->latest();
    }

    public function translateClient()
    {
        return $this->hasMany(Translate::class, 'order_id');
    }

    public function translateWorker()
    {
        return $this->hasMany(Translate::class, 'translator_id');
    }

}

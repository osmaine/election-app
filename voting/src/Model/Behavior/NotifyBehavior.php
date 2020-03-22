<?php

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Twilio\Rest\Client;

/**
 * Notify behavior
 */
class NotifyBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    // Your Acount SID
    protected $sid = "AC4a081de36f5c1043b94033262b43a0d4";

    // Your Acount Auth Token
    protected $token = "2ef06b908d564095991348aa44d0f9cb";

    // Your Notify Service SID
    protected $sSid = "MG1d782b4ace15acc0439c4d6a6489b3b4";

    /**
     * Constructor hook method.
     *
     * @param array $config The configuration settings provided to this behavior.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        // New Twilio Client Instance
        $this->Twilio = new Client($this->sid, $this->token);
    }


    /**
     * Bind a user to the Notify Service.
     *
     * @param EntityInterface $user User information
     * @return bool|JSON
     * @throws InvalidArgumentException
     */
    public function bindUser($user)
    {
        return $this->Twilio->notify->v1->services($this->sSid)
            ->bindings
            ->create($user->id, "sms", $user->phone);
    }


    /**
     * Send notification message to user.
     *
     * @param EntityInterface $user User information
     * @param string $msg SMS body.
     * @param bool $bound specify if user has been bound.
     * @return bool|JSON
     * @throws InvalidArgumentException
     */
    public function notifyUser($user, $msg, $bound = false)
    {

        if ($bound) {
            return $this->Twilio->notify->v1->services($this->sSid)
                ->notifications
                ->create(array(
                        "body" => $msg,
                        "identity" => $user->id
                    )
                );
        }

        return $this->Twilio->notify->v1->services($this->sSid)
            ->notifications
            ->create(array(
                    "body" => $msg,
                    "toBinding" => array(
                        "binding_type" => "sms",
                        "address" => $user->phone
                    ),
                    "identity" => array($user->id)
                )
            );
    }


}

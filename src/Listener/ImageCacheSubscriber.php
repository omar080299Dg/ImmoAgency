<?php

namespace App\Listener;

use App\Entity\Bien;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubscriber implements EventSubscriber
{

    /**
     * @var CacheManager
     */
    private $cacheManage;

    /**
     * @var UploaderHelper
     */
    private $helper;

    public function __construct(CacheManager $cacheManager,UploaderHelper $helper)
    {
        $this->cacheManage = $cacheManager;
        $this->helper = $helper;
    }

    public function getSubscribedEvents()
    {
        return [
            'preRemove',
            'preUpdate'
        ];
    }
    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if(!$entity instanceof Bien){
            return;
        }
        $this->cacheManage->remove($this->helper->asset($entity,'imageFile'));

    }
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if(!$entity instanceof Bien){
            return;
        }
        if($entity->getImageFile() instanceof UploadedFile){
            $this->cacheManage->remove($this->helper->asset($entity,'imageFile'));
        }
    }
}
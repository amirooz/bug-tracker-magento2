<?php

namespace Helix\BugTracker\Controller\Issue;

use Magento\Framework\App\Action\Context;
use Helix\BugTracker\Model\BugFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_bug;
    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;

    public function __construct(
        Context $context,
        BugFactory $bug,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem
    ) {
        $this->_bug = $bug;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
            try{
                $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'image']);
                $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $imageAdapter = $this->adapterFactory->create();
                $uploaderFactory->addValidateCallback('custom_image_upload',$imageAdapter,'validateUploadFile');
                $uploaderFactory->setAllowRenameFiles(true);
                $uploaderFactory->setFilesDispersion(true);
                $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $destinationPath = $mediaDirectory->getAbsolutePath('helix/bug');
                $result = $uploaderFactory->save($destinationPath);
                if (!$result) {
                    throw new LocalizedException(
                        __('File cannot be saved to path: $1', $destinationPath)
                    );
                }
                $imagePath = 'helix/bug'.$result['file'];
                $data['image'] = $imagePath;
            } catch (\Exception $e) {
            }
        }
        $bug = $this->_bug->create();
        $bug->setData($data);
        if($bug->save()){
            $this->messageManager->addSuccessMessage(__('You saved the data.'));
        }else{
            $this->messageManager->addErrorMessage(__('Data was not saved.'));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('issues');
        return $resultRedirect;
    }
}

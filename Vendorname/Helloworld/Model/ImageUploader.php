<?php

namespace Vendorname\Helloworld\Model;

/**
 * Class ImageUploader
 * @package Vendorname\Helloworld\Model
 */
class ImageUploader {

    /**
     * @var \Magento\MediaStorage\Helper\File\Storage\Database
     */
    private $coreFileStorageDatabase;

    /**
     * @var \Magento\Framework\Filesystem\Directory\WriteInterface
     */
	private $mediaDirectory;


    /**
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    private $uploaderFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    public $baseTmpPath;

    /**
     * @var string
     */
    public $basePath;

    /**
     * @var string[]
     */
    public $allowedExtensions;

    /**
     * ImageUploader constructor.
     * @param \Magento\MediaStorage\Helper\File\Storage\Database $coreFileStorageDatabase
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Psr\Log\LoggerInterface $logger
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(
		\Magento\MediaStorage\Helper\File\Storage\Database $coreFileStorageDatabase,
		\Magento\Framework\Filesystem $filesystem,
		\Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Psr\Log\LoggerInterface $logger
	) {
		$this->coreFileStorageDatabase = $coreFileStorageDatabase;
		$this->mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
		$this->uploaderFactory = $uploaderFactory;
		$this->storeManager = $storeManager;
		$this->logger = $logger;
		$this->baseTmpPath = "wysiwyg/helloworld/";
		$this->basePath = "wysiwyg/helloworld/";
		$this->allowedExtensions = ['jpg', 'jpeg', 'png'];
	}

    /**
     * @param $baseTmpPath
     */
    public function setBaseTmpPath($baseTmpPath) {
		$this->baseTmpPath = $baseTmpPath;
	}

    /**
     * @param $basePath
     */
    public function setBasePath($basePath) {
		$this->basePath = $basePath;
	}

    /**
     * @param $allowedExtensions
     */
    public function setAllowedExtensions($allowedExtensions) {
		$this->allowedExtensions = $allowedExtensions;
	}

    /**
     * @return string
     */
    public function getBaseTmpPath() {
		return $this->baseTmpPath;
	}

    /**
     * @return string
     */
    public function getBasePath() {
		return $this->basePath;
	}

    /**
     * @return string[]
     */
    public function getAllowedExtensions() {
		return $this->allowedExtensions;
	}

    /**
     * @param $path
     * @param $imageName
     * @return string
     */
    public function getFilePath($path, $imageName) {
		return rtrim($path, '/') . '/' . ltrim($imageName, '/');
	}

    /**
     * @param $imageName
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function moveFileFromTmp($imageName) {
		$baseTmpPath = $this->getBaseTmpPath();
		$basePath = $this->getBasePath();
		$baseImagePath = $this->getFilePath($basePath, $imageName);
		$baseTmpImagePath = $this->getFilePath($baseTmpPath, $imageName);
		try {
			$this->coreFileStorageDatabase->copyFile(
				$baseTmpImagePath,
				$baseImagePath
			);
			$this->mediaDirectory->renameFile(
				$baseTmpImagePath,
				$baseImagePath
			);
		} catch (\Exception $e) {
			throw new \Magento\Framework\Exception\LocalizedException(
				__('Something went wrong while saving the file(s).')
			);
		}
		return $imageName;
	}

    /**
     * @param $fileId
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function saveFileToTmpDir($fileId) {
		$baseTmpPath = $this->getBaseTmpPath();
		$uploader = $this->uploaderFactory->create(['fileId' => $fileId]);
		$uploader->setAllowedExtensions($this->getAllowedExtensions());
		$uploader->setAllowRenameFiles(true);
		$result = $uploader->save($this->mediaDirectory->getAbsolutePath($baseTmpPath));
		if (!$result) {
			throw new \Magento\Framework\Exception\LocalizedException(
				__('File can not be saved to the destination folder.')
			);
		}

		$result['tmp_name'] = str_replace('\\', '/', $result['tmp_name']);
		$result['path'] = str_replace('\\', '/', $result['path']);
		$result['url'] = $this->storeManager
			->getStore()
			->getBaseUrl(
				\Magento\Framework\UrlInterface::URL_TYPE_MEDIA
			) . $this->getFilePath($baseTmpPath, $result['file']);
		$result['name'] = $result['file'];
		if (isset($result['file'])) {
			try {
				$relativePath = rtrim($baseTmpPath, '/') . '/' . ltrim($result['file'], '/');
				$this->coreFileStorageDatabase->saveFile($relativePath);
			} catch (\Exception $e) {
				$this->logger->critical($e);
				throw new \Magento\Framework\Exception\LocalizedException(
					__('Something went wrong while saving the file(s).')
				);
			}
		}
		return $result;
	}

	public function saveMediaImage($imageName, $imagePath)
    {
        $baseTmpPath = $this->getBaseTmpPath();
        $basePath = $this->getBasePath();
        $baseImagePath = $this->getFilePath($basePath, $imageName);
        $mediaPath = substr($imagePath, 0, strpos($imagePath, "media"));
        $baseTmpImagePath = str_replace($mediaPath . "media/", "", $imagePath);
        if ($baseImagePath == $baseTmpImagePath) {
            return $imageName;
        }
        try
        {
            $this->mediaDirectory->copyFile(
                $baseTmpImagePath,
                $baseImagePath
            );
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Something went wrong while saving the file(s).')
            );
        }
        return $imageName;
    }
}

<?php
declare(strict_types=1);

namespace Valerii\Comment\Controller\Adminhtml\Comment;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class View extends Action implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'Valerii_Comment::management_view';

    /**
     * Edit Comment action.
     *
     * @return Page|ResultInterface
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Valerii_Comment::management_view');
        $resultPage->getConfig()->getTitle()->prepend(__('View Comment'));

        return $resultPage;
    }
}
